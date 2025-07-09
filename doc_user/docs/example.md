## Crear un nuevo proyecto

Crear un nuevo proyecto utilizando el instalador de Laravel

        laravel new name-app

## Starter Kits

Se puede utilizar un Starter Kit deseado ejemplo:

        React
        Vue
        Livewire

Si utiliza alguno de los Starter Kit debe realizar la configuración pertinente para la gestión de rutas. 

## Iniciar el servidor de desarrollo local de Laravel

        cd name-app
        npm install && npm run build
        composer run dev

## Configuración del entorno

Para configurar el entorno de la aplicación se debe gestionar el archivo .env

Configurar base de datos

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=laravel
        DB_USERNAME=root
        DB_PASSWORD=

Si elige utilizar una base de datos que no sea SQLite, tendrá que crear la base de datos y ejecutar las migraciones de la base de datos de su aplicación:

        php artisan migrate

## Instalar tenancy for Laravel

        composer require stancl/tenancy
        php artisan tenancy:install
        php artisan migrate

Registrar el prestador de servicios en bootstrap/providers.php:

        return [
            App\Providers\AppServiceProvider::class,
            App\Providers\TenancyServiceProvider::class, // <-- here
        ];

Para personalizar y gestionar los requerimientos de nuestra aplicación, se requiere crear un modelo Tenant y configurar nuestro modelo con el siguiente contenido

            <?php

            namespace App\Models;

            use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
            use Stancl\Tenancy\Contracts\TenantWithDatabase;
            use Stancl\Tenancy\Database\Concerns\HasDatabase;
            use Stancl\Tenancy\Database\Concerns\HasDomains;

            class Tenant extends BaseTenant implements TenantWithDatabase
            {
                use HasDatabase, HasDomains;
            }

Como se ha personalizado el Modelo, es necesario realizar una configuración en el archivo **config/tenancy.php**

            'tenant_model' => \App\Models\Tenant::class,

**Configurar las rutas**

En el archivo de rutas realizamos un ajuste donde las rutas centrales estén registradas únicamente en dominios centrales.


            foreach (config('tenancy.central_domains') as $domain) {
                    Route::domain($domain)->group(function () {
                    // your actual routes
                });
            }

**Dominios centrales**

En el archivo de configuración **config/tenancy.php** se debe agregar el dominio central

        'central_domains' => [
            'saas.test', // Add the ones that you use. I use this one with Laravel Valet.
        ],

Los valores predeterminados son :

        'central_domains' => [
            '127.0.0.1',
            'localhost',
        ],

## Archivo de rutas de Tenants

En el directorio de archivos de Laravel se encuentra el directorio **routes/tenant.php** para la configuración de rutas de los tenants.

Por defecto tenemos la siguiente configuración 

        Route::middleware([
            'web',
            InitializeTenancyByDomain::class,
            PreventAccessFromCentralDomains::class,
        ])->group(function () {
            Route::get('/', function () {
                return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
            });
        });

Estas rutas solo serán accesibles en dominios de inquilinos (no centrales)

## Migraciones 

En el directorio de archivos de Laravel se incluye la carpeta de migraciones para los tenants, en el directorio **migrations/tenant**. 

En este directorio se deben incluir las migraciones que consideren pertinentes para los tenants. 

Para ejecutar las migraciones de los tenants ejecuta el siguiente comando:

        php artisan tenants:migrate

Para crear migraciones específicas para cada tenant ejecuta el siguiente comando : 

        php artisan make:migration create_table_name_for_tenant --path=database/migrations/tenant

Si necesitas migrar solo un tenant específico, puedes especificarlo con la opción --tenants, así:

        php artisan tenants:migrate --tenants=tenant_id

## Acceder al sistema 

Accede al sistema con el dominio de cada tenant deseado.

## Personalización de base de Datos 

**ejemplo:**
        
        Route::get('prueba', function() {
        	$tenant1 = \App\Models\Tenant::create([
        		'id' => 'id_tenant',
        		'tenancy_db_name' => 'tenantname',
        		'tenancy_db_username' => 'tenant1',
        		'tenancy_db_password' => 'password',
        		'tenancy_db_connection' => 'sqlite'	
        	])
        
        	$tenant1->domains()->create(['domain' => 'foo.localhost']);
        })

## Como acceder a un tenant desde la app central 

El método **tenancy()->initialize($tenant)** es fundamental para activar el contexto multi-inquilino (multi-tenant) en una aplicación. 

!!! question "¿Qué hace tenancy()->initialize($tenant)?"
    Este método inicializa el contexto del inquilino en la aplicación. Esto significa que:

    1. Activa los recursos, configuraciones y servicios específicos del inquilino.

    2. Cambia el contexto de ejecución desde el entorno global al del inquilino.

    3. Lanza una serie de eventos (TenancyInitialized, etc.) que permiten configurar dinámicamente cosas como:

        - Conexión a base de datos del inquilino

        - Configuraciones personalizadas (como rutas, archivos, cache, etc.)

        - Cargas condicionales de servicios

**Características Técnicas**

| Característica          | Descripción                                                                 |
|-------------------------|-----------------------------------------------------------------------------|
| **Aislamiento**         | Cambia conexiones y configuraciones al contexto del inquilino               |
| **Personalización**     | Usa settings únicos por tenant (DB, rutas, archivos, etc.)                 |
| **Eventos**             | Dispara eventos como `TenancyInitialized`, `TenancyInitializing`           |
| **Reversibilidad**      | Se puede volver al contexto global con `tenancy()->end()`                   |
| **Flexible**            | Funciona con distintos tipos de tenant (subdominio, ruta, etc.)             |
| **Útil en scripts**     | Permite correr comandos Artisan o procesos manuales por tenant              |

**Ejemplo de uso** 

        use App\Models\Tenant;
        use Tenancy\Facades\Tenancy;

        $tenant = Tenant::find(1);

        tenancy()->initialize($tenant);

        // A partir de aquí, todo lo que hagas será dentro del tenant
        User::create(['name' => 'Juan']); // Se guardará en la DB del tenant

        tenancy()->end(); // Vuelves al contexto global


**Casos de uso típicos**

-   Ejecutar migraciones o seeders dentro del contexto de un tenant específico.

-   Procesar tareas en cola (jobs) con lógica aislada por tenant.

-   Crear una interfaz administrativa global donde un super admin pueda "entrar" al tenant.

-   Desarrollar un comando Artisan para mantenimiento/operaciones por tenant.

**Consideraciones**

-   **No es idempotente:** Llamarlo varias veces no "reinicia" el contexto; debes llamar tenancy()->end() antes de volver a inicializar otro tenant.

-   **Debe usarse antes de ejecutar lógica tenant-aware** (como acceso a modelos).

-   **Eventos personalizados** pueden ayudarte a extender su comportamiento (ej. configurar dinámicamente servicios de terceros).


**Recomendaciones**

-   Usa tenancy()->initialize() solo cuando estás fuera de un request HTTP (por ejemplo, en comandos o procesos manuales). Para peticiones normales, el middleware InitializeTenancyBy... se encarga automáticamente.

-   Si haces pruebas (tests), asegúrate de llamar tenancy()->end() para limpiar entre tests.

-   Escucha los eventos como TenancyInitialized para agregar lógica condicional, por ejemplo:

        Event::listen(TenancyInitialized::class, function ($event) {
            config(['app.name' => $event->tenant->name]);
        });

Para realizar un acción desde cualquier tenant al tenant central 

        // A través de una function anonima 

        tenancy()->central(function () {
            // Aquí dentro las consultas serán sobre el tenant central
            $user = \App\Models\User::first();
        });

        //Finaliza la conexión 
        tenancy()->end();
