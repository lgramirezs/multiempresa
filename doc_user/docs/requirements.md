## Requerimientos Funcionales

| ID     | Nombre del Requerimiento              | Descripción                                                                                                                                      | Módulo            | Prioridad | Dependencias     |
|--------|----------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------|-------------------|-----------|------------------|
| RF-01  | Gestión de Empresas (Tenants)         | Permitir crear, editar, eliminar y listar empresas dentro del sistema, cada una con su configuración independiente.                             | Aplicación Base    | Alta      | Ninguna          |
| RF-02  | Aislamiento de Datos por Empresa      | Garantizar que cada empresa visualice solo su propia información en todos los módulos.                                                          | Todos             | Alta      | RF-01            |
| RF-03  | Switch de Empresa Activa              | Permitir que un usuario con acceso a múltiples empresas desde la aplicación base pueda cambiar de empresa activa desde la interfaz.                                       | Aplicación Base       | Alta      | RF-01, RF-02     |
| RF-04  | Registro de Usuarios Multitenant      | Permitir asignación automática de permisos del administrador de la instancia central a las nuevas empresas creadas.                                                 | Aplicación Base         | Alta      | RF-01            |
| RF-05  | Control de Roles y Permisos por Empresa | Gestionar roles y permisos para cada empresa de forma independiente.                                                       | Aplicación Base         | Alta      | RF-04            |



####

| ID     | Nombre del Requerimiento              | Descripción                                                                                                                                      | Módulo            | Prioridad | Dependencias     |
|--------|----------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------|-------------------|-----------|------------------|
| RF-06  | Asignación de permisos       | Permitir la asignación de permisos a usuarios desde la instancia central a cada uno de las empresas.                                           | Aplicación Base           | Alta     | RF-01, RF-04     |
| RF-07  | Registro de Ventas por Empresa        | Registrar operaciones de ventas por empresa, aisladas de otras empresas.                                                                        | Ventas            | Media     | RF-01, RF-02     |
| RF-08  | Reportes Filtrados por Empresa        | Generar reportes de compras, ventas, inventario, contabilidad, etc., filtrados por empresa.                                                     | Reportes          | Alta      | RF-06, RF-07     |
| RF-09  | Gestión de Inventario por Empresa     | Manejar inventarios separados por empresa, con control individual de almacenes, productos y existencias.                                       | Inventario        | Alta      | RF-01, RF-02     |
 RF-10  | Auditoría por Tenant                  | Registrar logs de acciones realizadas en el sistema, identificando usuario, acción y empresa correspondiente.                                   | Seguridad         | Alta      | Todos            |




####

| ID     | Nombre del Requerimiento              | Descripción                                                                                                                                      | Módulo            | Prioridad | Dependencias     |
|--------|----------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------|-------------------|-----------|------------------|
| RF-11  | Configuración de Parámetros por Empresa | Permitir a cada empresa definir sus propios parámetros operativos: moneda, impuestos, unidades, etc.                                       | Configuración  | Alta      | RF-01            |
| RF-12  | Gestión de Sucursales                  | Posibilidad de que cada empresa tenga múltiples sucursales con inventario, personal y operaciones separadas.                               | Administración | Media     | RF-01            |
| RF-13  | Módulo de Facturación por Empresa      | Emitir facturas fiscales, electrónicas o manuales para cada empresa, con su propio formato, numeración y control.                          | Facturación    | Alta      | RF-01, RF-07     |
| RF-14  | Gestión de Proveedores por Empresa     | Registrar, consultar y administrar proveedores de forma independiente por empresa.                                                         | Compras        | Media     | RF-01            |
| RF-15  | Gestión de Clientes por Empresa        | Registrar, consultar y administrar clientes de forma aislada por empresa.                                                                  | Ventas         | Media     | RF-01            |


####
| ID     | Nombre del Requerimiento              | Descripción                                                                                                                                      | Módulo            | Prioridad | Dependencias     |
|--------|----------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------|-------------------|-----------|------------------|
| RF-16  | Control de Accesos por Módulo          | Definir a qué módulos puede acceder cada usuario según su empresa y rol asignado.                                                          | Seguridad      | Alta      | RF-04, RF-05     |
| RF-17  | Multilenguaje                          | Posibilidad de visualizar la interfaz en distintos idiomas configurables por usuario o empresa.                                            | UI General     | Baja      | RF-11            |
| RF-18  | Integración con API Externa por Empresa| Integrar servicios externos (facturación, pago, logística) de forma específica para cada empresa, con sus claves y endpoints propios.      | Integraciones  | Media     | RF-01            |
| RF-19  | Exportación de Datos por Empresa       | Permitir exportar información en formatos CSV, Excel o PDF, con datos únicamente de la empresa activa.                                     | Reportes       | Alta      | RF-08            |
| RF-20  | Dashboard Personalizado por Empresa    | Cada empresa debe poder visualizar su propio tablero de control con indicadores y KPIs relevantes.                                         | Reportes/UI    | Alta      | RF-02, RF-08     |

## Requerimientos No Funcionales

| ID     | Nombre del Requerimiento          | Descripción                                                                                              | Prioridad |
|--------|-----------------------------------|----------------------------------------------------------------------------------------------------------|-----------|
| RNF-01 | Escalabilidad Horizontal           | El sistema debe permitir escalar horizontalmente para soportar múltiples empresas sin afectar el rendimiento. | Alta      |
| RNF-02 | Seguridad en el Aislamiento de Datos | Debe garantizarse el aislamiento total de datos entre empresas, evitando accesos cruzados no autorizados. | Alta      |
| RNF-03 | Disponibilidad                     | El sistema debe estar disponible al menos el 99.5% del tiempo mensual.                                    | Alta      |
| RNF-04 | Soporte Multinavegador             | El sistema debe funcionar correctamente en los navegadores modernos: Chrome, Firefox, Edge y Safari.     | Media     |
| RNF-05 | Tiempos de Carga                   | Las páginas principales deben cargar en menos de 3 segundos bajo condiciones normales de uso.            | Alta      |
| RNF-06 | Compatibilidad Móvil               | El sistema debe ser accesible desde dispositivos móviles con una interfaz responsiva.                    | Media     |
| RNF-07 | Logs Centralizados                 | Toda actividad crítica debe quedar registrada en un sistema de logs centralizado con trazabilidad por empresa. | Alta      |
| RNF-08 | Backup Diario                      | Se debe realizar una copia de seguridad completa de los datos diariamente y por cada empresa.            | Alta      |
| RNF-09 | Configurabilidad                   | El sistema debe permitir parametrizar ciertos comportamientos por empresa (moneda, idioma, zona horaria).| Media     |
| RNF-10 | Cumplimiento Legal                 | El sistema debe cumplir con la legislación vigente en materia de protección de datos (ej. GDPR, LOPD).   | Alta      |
