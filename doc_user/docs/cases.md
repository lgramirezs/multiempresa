(Ejemplo de caso de uso)

**Caso de Uso: Consultar información de una sucursal**

**Actor:** Administrador

**Precondiciones:** El usuario ha iniciado sesión en el sistema con sus credenciales válidas.  El usuario tiene los permisos necesarios para consultar la información de la sucursal.

**Postcondiciones:** El usuario ha visualizado la información solicitada de la sucursal.

**Flujo principal:**

1. El usuario selecciona la opción "Consultar sucursales" en el menú principal.

2. El sistema presenta una lista de sucursales, filtrable por empresa y otros criterios (nombre, ciudad, etc.).

3. El usuario selecciona la sucursal deseada.

4. El sistema muestra la información detallada de la sucursal, incluyendo:
    - Nombre de la sucursal
    - Dirección completa
    - Datos de contacto (teléfono, correo electrónico)
    - Gerente de la sucursal
    - Empresa a la que pertenece
    - Estado (activa/inactiva)
    - Fecha de creación
    - Otros datos relevantes (ej: número de empleados, ventas totales, etc.)

5. El usuario puede regresar al menú principal o realizar otras acciones.

**Flujos alternativos:**

- **Usuario sin permisos:** Si el usuario no tiene los permisos necesarios, el sistema muestra un mensaje de error y no permite acceder a la información.
- **Sucursal no encontrada:** Si la sucursal seleccionada no existe, el sistema muestra un mensaje de error.
- **Error de conexión a la base de datos:** Si ocurre un error al conectar con la base de datos, el sistema muestra un mensaje de error e intenta reconectar.

**Excepciones:**

- Ninguna.

**Requisitos no funcionales:**

- El sistema debe ser rápido y eficiente en la consulta de información.
- La interfaz de usuario debe ser intuitiva y fácil de usar.
- La información debe ser presentada de forma clara y organizada.
