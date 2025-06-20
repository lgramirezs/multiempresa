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

## Repositorio



## Como accerder a un tenant desde la app central 

// Consulto el tenant al cual quiero acceder
$tenant = Tenant::first()

// Le indico a laravel a través del helper que quiero acceder a ese tenant
tenancy()->initialize($tenant);

Ejemplo: 

La consulta $user = \App\Models\User::first() ahora devolverá el usuario del tenant al que accedí.

Si queremos finalizar la conexión lo podemos hacer de la siguiente manera:

tenancy()->end();
// Finalizo la conexión al tenant
// Ahora las consultas volverán a ser sobre el tenant central


Viceversa
// Acceder desde un tenant a la app central

// Lo hago a través de una function anonima 

tenancy()->central(function () {
    // Aquí dentro las consultas serán sobre el tenant central
    $user = \App\Models\User::first();
});