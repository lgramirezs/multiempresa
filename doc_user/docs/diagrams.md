Los diagramas permiten visualizar de forma clara y estructurada cómo funciona el sistema KAVAC ERP a nivel arquitectónico, funcional y de interacción entre actores. Esta sección incluye los siguientes tipos:

## Diagrama de Arquitectura General

- Usuarios acceden al sistema a través de un portal central.
- Middleware identifica el tenant (empresa) por subdominio, token o cabecera.
- Se establece conexión a la base de datos correspondiente.
- Cada tenant tiene datos y configuraciones aisladas.
- Servicios externos pueden integrarse por tenant.

[Diagrama aquí – puede representarse como texto si no tienes herramienta gráfica]

Cliente ───► Frontend Vue/Blade ───► Middleware Tenant ───► Backend Laravel ───► DB por Tenant  


Middleware Tenant ───► Servicios API  
DB por Tenant  ───► Backup / Logs

## Diagrama de Flujo de Autenticación

1. Usuario accede con su correo y contraseña.
2. El sistema verifica en qué empresa(s) tiene acceso.
3. Si tiene acceso a una sola, se inicia sesión directamente.
4. Si tiene múltiples accesos, se muestra pantalla para seleccionar empresa activa.
5. Se crea la sesión con el contexto del tenant.

[Flujo representado como texto simple o pseudodiagrama]

Inicio Sesión  
   │  
Validar Credenciales  
   ├── Usuario tiene 1 tenant ──► Establecer sesión  
   └── Usuario tiene múltiples ──► Mostrar selector ──► Establecer sesión

## Diagrama de Casos de Uso

**Actores Principales:**
- Administrador del sistema
- Usuario de empresa
- Gerente de empresa
- API externa (facturación, pagos)

**Casos de uso clave:**
- Gestionar empresas
- Gestionar usuarios y roles
- Registrar compras/ventas
- Visualizar reportes
- Cambiar empresa activa
- Configurar parámetros por tenant

[Representación textual tipo lista, si no hay gráfico disponible]

Administrador:
- Crear/editar empresas
- Asignar usuarios a empresas
- Ver logs de auditoría

Usuario de empresa:
- Registrar compras/ventas
- Gestionar inventario
- Ver reportes

Gerente:
- Ver dashboard
- Descargar reportes financieros

API externa:
- Consultar datos
- Enviar documentos electrónicos


## Diagrama Entidad-Relación Simplificado

Tenant ──┬──► Empresa  
         ├──► Usuario (con roles por tenant)  
         ├──► Configuración  
         ├──► Inventario  
         ├──► Clientes / Proveedores  
         └──► Facturas / Compras / Ventas
