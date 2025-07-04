## Gestión de Empresas

??? success "Descripción del requerimiento"
    **Objetivo General**

    El objetivo de este requerimiento es desarrollar un sistema centralizado que permita a los administradores gestionar de manera eficiente las empresas registradas. Esto incluye la capacidad de **crear**, **editar**, **eliminar** y **listar** empresas, garantizando que cada una tenga su propia configuración y parámetros específicos.

    **Funcionalidades clave**

    1. **Crear Empresas**

        - **Descripción**: Permitir a los administradores registrar nuevas empresas en el sistema.
        - **Detalles**:
            - El sistema debe presentar un formulario donde se ingresen datos esenciales como:
              - **Nombre de la empresa**
              - **Dirección**
              - **Datos de contacto** (teléfono, correo electrónico)
              - **Información fiscal**
              - **Otros datos relevantes** (número de empleados, sector de actividad, etc.)
            - Validación de datos para asegurar que la información ingresada sea correcta y completa.
            - Configuración inicial de la empresa con valores predeterminados.

    2. **Editar Empresas**

        - **Descripción**: Permitir a los administradores modificar la información de empresas existentes.
        - **Detalles**:
            - El sistema debe permitir seleccionar una empresa de la lista y presentar un formulario pre-llenado con la información actual.
            - Los administradores pueden realizar cambios en los campos necesarios.
            - Validación de los datos modificados antes de guardar los cambios.
            - Confirmación de que los cambios se han realizado con éxito.

    3. **Eliminar Empresas**

        - **Descripción**: Permitir a los administradores eliminar empresas del sistema.
        - **Detalles**:
            - El sistema debe solicitar confirmación antes de proceder con la eliminación para evitar borrados accidentales.
            - Una vez confirmada la eliminación, la empresa debe ser eliminada de la base de datos y ya no aparecer en la lista de empresas.
            - Mensaje de confirmación de que la empresa ha sido eliminada exitosamente.

    4. **Listar Empresas**

        - **Descripción**: Proporcionar una vista de todas las empresas registradas en el sistema.
        - **Detalles**:
            - El sistema debe mostrar una lista que incluya al menos el **nombre** y el **ID** de cada empresa.
            - Funcionalidades de filtrado y ordenamiento para facilitar la búsqueda de empresas específicas.
            - Opción para seleccionar una empresa de la lista para ver más detalles o realizar acciones adicionales (editar o eliminar).

    **Requisitos No Funcionales**

    - **Usabilidad**: La interfaz debe ser intuitiva y fácil de usar, permitiendo a los administradores realizar acciones sin complicaciones.
    - **Rendimiento**: El sistema debe ser rápido y eficiente, especialmente al listar empresas y realizar búsquedas.
    - **Seguridad**: Debe garantizarse la seguridad de los datos, asegurando que solo los usuarios autorizados puedan realizar cambios en la información de las empresas.
    - **Escalabilidad**: El sistema debe ser capaz de manejar un número creciente de empresas sin degradar el rendimiento.

??? info "Caso de uso del requerimiento"
    **Actor:** Administrador

    **Precondiciones:**

    *   El usuario ha iniciado sesión en el sistema con sus credenciales válidas.
    *   El usuario tiene los permisos necesarios para gestionar empresas.

    **Postcondiciones:**

    *   Se ha realizado la operación solicitada (crear, editar, eliminar o listar empresas) con éxito.
    *   El sistema refleja los cambios realizados.

    **Flujo Principal (Listar Empresas):**

    1.  El usuario selecciona la opción "Gestionar Empresas" en el menú principal.
    2.  El sistema presenta una lista de empresas, mostrando al menos el nombre y el ID de cada una.
    3.  El usuario puede filtrar la lista por nombre, ID o cualquier otro criterio relevante.
    4.  El usuario puede ordenar la lista por cualquier columna.
    5.  El usuario puede seleccionar una empresa para editarla o eliminarla.
    6.  El usuario puede volver al menú principal.

    **Flujo Principal (Crear Empresa):**

    1.  El usuario selecciona la opción "Crear Empresa" en el menú de gestión de empresas.
    2.  El sistema presenta un formulario para ingresar los datos de la nueva empresa (nombre, dirección, etc.).
    3.  El usuario completa el formulario con la información requerida.
    4.  El sistema valida los datos ingresados.
    5.  Si los datos son válidos, el sistema crea la nueva empresa y la guarda en la base de datos.
    6.  El sistema muestra un mensaje de confirmación.
    7.  El usuario puede ver la nueva empresa en la lista de empresas.
    8.  El usuario puede regresar al menú principal.

    **Flujo Principal (Editar Empresa):**

    1.  El usuario selecciona una empresa de la lista para editar.
    2.  El sistema presenta un formulario pre-llenado con los datos de la empresa.
    3.  El usuario edita los datos de la empresa.
    4.  El sistema valida los datos ingresados.
    5.  Si los datos son válidos, el sistema actualiza los datos de la empresa en la base de datos.
    6.  El sistema muestra un mensaje de confirmación.
    7.  El usuario puede ver los cambios en la lista de empresas.
    8.  El usuario puede regresar al menú principal.

    **Flujo Principal (Eliminar Empresa):**

    1.  El usuario selecciona una empresa de la lista para eliminar.
    2.  El sistema solicita confirmación antes de eliminar la empresa.
    3.  Si el usuario confirma, el sistema elimina la empresa de la base de datos.
    4.  El sistema muestra un mensaje de confirmación.
    5.  La empresa ya no aparece en la lista de empresas.
    6.  El usuario puede regresar al menú principal.

    **Flujos Alternativos:**

    *   **Datos inválidos:** El sistema muestra mensajes de error indicando qué datos son inválidos y solicita corregirlos.
    *   **Error de conexión a la base de datos:** El sistema muestra un mensaje de error e intenta reconectar. Si la reconexión falla, muestra un mensaje indicando que la operación no pudo ser completada.
    *   **Permisos insuficientes:** Si el usuario no tiene los permisos necesarios, se le niega el acceso a la funcionalidad.

    **Excepciones:**

    *   Ninguna.

    **Requisitos no funcionales:**

    *   El sistema debe ser rápido y eficiente.
    *   La interfaz de usuario debe ser intuitiva y fácil de usar.
    *   La información debe ser presentada de forma clara y organizada.
    *   La seguridad de los datos debe estar garantizada.

## Aislamiento de Datos por Empresa

??? success "Descripción del requerimiento"
    **Objetivo General**

    Garantizar que cada empresa registrada como sucursal visualice exclusivamente su propia información en todos los módulos del sistema, preservando la confidencialidad y la integridad de los datos entre distintas empresas.

    **Funcionalidades clave**

    1. **Crear Empresas**

        -   **Descripción**: Limitar el acceso a la información solo a los datos correspondientes a la empresa del usuario autenticado.
        -   **Detalles**:

            - El usuario debe iniciar sesión a través de una url unica perteneciente a la empresa a la que pertenece.

            - Toda consulta, visualización o modificación de datos debe estar filtrada automáticamente por el ID de la empresa.

            - En todos los módulos, los datos mostrados estarán exclusivamente vinculados a la empresa correspondiente.

            - No se deben permitir mecanismos para cambiar manualmente el identificador de empresa desde la interfaz.

            - Validaciones en backend para evitar intentos de acceso cruzado mediante modificación de URLs o peticiones manipuladas.

    2. **Seguridad y validación de sesiones**

        -   **Descripción**: Asegurar que el contexto de empresa del usuario se mantenga durante toda la sesión.
        -   **Detalles**:

            -  El sistema debe mantener el contexto de empresa a nivel de sesión.

            -  En cada petición, se debe verificar que la empresa del recurso coincida con la del usuario autenticado.

            -  El sistema debe registrar cualquier intento de acceso indebido en los logs de seguridad.

    **Requisitos No Funcionales**

    - **Seguridad**: Se deben aplicar controles estrictos de validación en backend para prevenir accesos no autorizados entre empresas.

    - **Escalabilidad**: El sistema debe mantener este control de acceso incluso con cientos o miles de empresas activas.

    - **Rendimiento**: Las restricciones por empresa no deben impactar negativamente en el tiempo de respuesta del sistema.

    - **Usabilidad**: El usuario no debe notar las restricciones; debe ver solo lo que le corresponde de manera natural e intuitiva

??? info "Caso de uso del requerimiento"
    **Actor:** Usuario autenticado (Rol: Administrador o empleado de sucursal)

    **Precondiciones:**

    *   El usuario ha iniciado sesión correctamente.

    *   El sistema ha identificado a qué empresa pertenece el usuario.

    *   El módulo solicitado es accesible por el rol del usuario.

    **Postcondiciones:**

    *   El usuario ha visualizado únicamente la información correspondiente a su empresa.

    *   El sistema ha impedido cualquier intento de acceso a datos de otras empresas.

    **Flujo principal:**

    1.  El usuario inicia sesión en el sistema.

    2.  El sistema identifica la empresa a la que pertenece el usuario.

    3.  El usuario navega a un módulo del sistema (ej. Talento Humano, Inventario).

    4.  El sistema filtra automáticamente todos los datos a mostrar por el identificador de empresa del usuario.

    5.  El usuario visualiza los datos correspondientes a su empresa.

    **Flujos alternativos:**

    -   **Intento de acceso no autorizado:** Si el usuario intenta modificar una URL o petición para ver información de otra empresa, el sistema bloquea la acción, muestra un mensaje de error y registra el intento.

    -   **Empresa no identificada en la sesión:** Si por error no se puede determinar la empresa del usuario, el sistema cierra la sesión e informa al usuario.

    **Excepciones:**

    -   **Error en la base de datos:** Si ocurre un problema al obtener los datos filtrados, el sistema informa del error y permite reintentar.

    **Requisitos no funcionales:**

    -   El sistema debe mantener la restricción de empresa en todo momento, incluso en entornos distribuidos o multiusuario.

    -   Debe auditarse cada intento de visualización de datos con trazabilidad de usuario, fecha y empresa.

## Consultar información de una sucursal

??? success "Descripción del requerimiento"
    **Objetivo General**

    Permitir que usuarios con permisos especiales puedan consultar información específica de una sucursal determinada desde el sistema central, sin necesidad de iniciar sesión directamente en la instancia de la sucursal, garantizando un acceso controlado y seguro.

    **Funcionalidades clave**

    1. **Consulta centralizada de información de sucursales**

        -   **Descripción:** Permitir a usuarios con permisos especiales acceder a información de una sucursal específica desde el sistema central.

        -   **Detalles:**
            - El usuario debe contar con un rol o permiso específico configurado por el administrador del sistema.
            - El sistema debe presentar un listado de sucursales accesibles al usuario según sus permisos.
            - El usuario puede seleccionar una sucursal y visualizar la información permitida, que puede incluir:
              - Datos generales (nombre, ubicación, estado)
              - Información operativa (ventas, personal, inventario, etc.) según lo autorizado
            - Toda la información debe estar en modo de solo lectura, a menos que el usuario tenga permisos adicionales.

    2. **Gestión de permisos especiales por sucursal**
        -   **Descripción:** Configurar y gestionar los permisos de los usuarios para que puedan consultar información de ciertas sucursales.

        -   **Detalles:**
            - El administrador podrá asignar permisos especiales a usuarios para una o varias sucursales específicas.
            - Los permisos deben estar claramente delimitados para evitar accesos indebidos.
            - El sistema debe validar en cada acceso si el usuario tiene los permisos requeridos.

    **Requisitos No Funcionales**

    - **Seguridad:** Los accesos deben estar autenticados, registrados y auditados.
    - **Usabilidad:** La interfaz debe mostrar claramente qué sucursales y datos están disponibles según los permisos del usuario.
    - **Rendimiento:** Las consultas deben ser rápidas, incluso si se accede a información de múltiples sucursales.
    - **Trazabilidad:** Toda consulta debe dejar un registro con fecha, hora, usuario y sucursal accedida.

??? info "Caso de uso del requerimiento"
    **Actor:** Usuario con permisos especiales (ej. supervisor regional, auditor)

    **Precondiciones:**
    - El usuario ha iniciado sesión en el sistema central con credenciales válidas.
    - El usuario cuenta con permisos especiales asignados para consultar una o más sucursales.

    **Postcondiciones:**
    - El usuario ha visualizado la información permitida de la sucursal seleccionada.
    - Se ha registrado el acceso en los logs del sistema.

    **Flujo principal:**

    1. El usuario inicia sesión en el sistema central.
    2. El sistema identifica los permisos especiales del usuario y muestra las sucursales autorizadas.
    3. El usuario selecciona una sucursal desde el listado disponible.
    4. El sistema muestra la información correspondiente de la sucursal, filtrada según el nivel de acceso del usuario.
    5. El usuario puede regresar al listado o realizar otra consulta autorizada.

    **Flujos alternativos:**

    - **Sin permisos suficientes:** Si el usuario intenta acceder a una sucursal para la cual no tiene permiso, el sistema bloquea el acceso y muestra un mensaje de error.
    - **Sucursal deshabilitada:** Si la sucursal está inactiva o deshabilitada, el sistema muestra un mensaje indicando que no es posible acceder a su información.
    - **Permisos modificados durante la sesión:** Si los permisos del usuario han sido modificados por un administrador durante su sesión, se requiere cierre y reingreso al sistema para actualizar el contexto de acceso.

    **Excepciones:**

    - **Fallo en la conexión a la base de datos:** El sistema muestra un mensaje de error e informa que no se puede consultar la información en ese momento.

    **Requisitos no funcionales:**

    - El sistema debe validar permisos antes de mostrar cualquier información.
    - Toda acción de consulta debe registrarse para fines de auditoría.
    - La interfaz debe ser clara y evitar ambigüedad en cuanto al alcance de la información visible.

## Asignación automática de permisos para administrador central

??? success "Descripción del requerimiento"
    **Objetivo General**

    Automatizar la asignación de permisos al administrador del sistema central para que pueda consultar la información de cualquier nueva sucursal que sea registrada, garantizando así un control centralizado desde el momento de la creación de cada sucursal.

    **Funcionalidades clave**

    1.  **Asignación automática de permisos al administrador central**

        -   **Descripción:** El sistema debe asignar automáticamente permisos de consulta al administrador central para todas las sucursales nuevas.

        -   **Detalles:**
        
            - Cada vez que se crea una nueva sucursal en el sistema, el administrador central debe recibir permisos de consulta de forma automática.
            - Estos permisos deben incluir acceso a información clave de la sucursal, como datos generales, estado, personal, operaciones, etc.
            - La asignación no debe requerir intervención manual.
            - El sistema debe validar que estos permisos existan antes de permitir el acceso.
    
    2.  **Consulta centralizada de nuevas sucursales**

        -   **Descripción:** Permitir al administrador central consultar información de cualquier sucursal nueva sin necesidad de configuración adicional.

        -   **Detalles:**

            - Al acceder al módulo de sucursales, el administrador central debe visualizar todas las sucursales, incluyendo las recién creadas.
            - El acceso debe estar en modo de solo lectura, salvo que el rol tenga otros privilegios.
            - El sistema debe garantizar que esta capacidad no se vea afectada por errores de configuración o sincronización.

    **Requisitos No Funcionales**

    - **Seguridad:** Solo administradores centrales deben recibir este tipo de permiso automático.
    - **Fiabilidad:** La asignación debe ejecutarse correctamente en todos los casos, incluso ante múltiples creaciones simultáneas.
    - **Auditoría:** Toda asignación automática debe registrarse para control y trazabilidad.
    - **Escalabilidad:** El sistema debe seguir funcionando eficientemente incluso si se crean muchas sucursales nuevas simultáneamente.

??? info "Caso de uso del requerimiento"
    **Actor:** Sistema (proceso automático), Administrador central

    **Precondiciones:**
    
    - El administrador central ya está registrado en el sistema.
    - El usuario que crea la sucursal tiene permisos válidos para hacerlo.

    **Postcondiciones:**

    - El administrador central tiene permisos activos para consultar la información de la nueva sucursal sin intervención manual.

    **Flujo principal:**

    1. Un usuario con permisos crea una nueva sucursal en el sistema.
    2. El sistema registra la nueva sucursal en la base de datos.
    3. Automáticamente, el sistema asigna al administrador central los permisos necesarios para consultar la información de esta nueva sucursal.
    4. El administrador central accede al módulo de sucursales y visualiza la nueva entrada junto con las existentes.
    5. El sistema registra la asignación automática en los logs de auditoría.

    **Flujos alternativos:**

    - **Error en asignación automática:** Si el sistema falla al asignar los permisos, se genera un log de error y se notifica al administrador para revisión manual.
    - **Administrador central no registrado:** Si el administrador central no está registrado en el sistema al momento de la creación de la sucursal, se omite la asignación y se registra el incidente.

    **Excepciones:**

    - **Fallo en la base de datos:** Si hay un error al guardar la sucursal o asignar los permisos, el sistema revierte la operación y muestra un mensaje de error al usuario creador.

    **Requisitos no funcionales:**

    - La asignación debe ejecutarse de forma automática e inmediata tras la creación de la sucursal.
    - El sistema debe garantizar la consistencia de permisos para el administrador central.
    - Deben existir registros que permitan auditar cada asignación de permisos generada por el sistema.
