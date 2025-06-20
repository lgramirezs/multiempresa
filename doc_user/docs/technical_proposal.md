## Arquitectura multitenant

Multitenant es un modelo de **arquitectura de software** que permite que una única instancia de una aplicación atienda a múltiples clientes. En otras palabras, un solo conjunto de código puede atender a varios usuarios, manteniendo la información confidencial de cada uno aislada y accesible únicamente por ellos.

Cada cliente del servicio se considera un tenant, lo que posibilita la personalización de ciertos elementos de la aplicación, como los colores de la interfaz, aunque no se modifica el código en sí. Es relevante destacar que, en esta arquitectura, un cliente no tiene que ser un único usuario, sino que puede representar a un grupo de usuarios. Por ejemplo, algunos servicios operan con equipos o grupos, donde un cliente puede disponer de un subdominio para acceder a la aplicación, permitiendo que múltiples usuarios visualicen la información asociada a ese cliente.

### Ventajas

- Economía en desarrollo y mantenimiento, ya que los costos son distribuidos entre todos los clientes.

- Fácil actualización, ya que es necesario solo actualizar una sola instancia.

- Seguridad de la información de cada cliente, ya que cuenta con un schema separado para cada uno.

- Optimiza el uso de recursos de los servidores.

### Desventajas

-  Dificulta el desarrollo de características específicas para un cliente.
-  Único punto de falla: si la aplicación tiene un error o falla, fallará para todos los clientes.

## Gestión de bases de datos.

Arquitecturas en las bases de datos.

En Postgres un Schema actúa como un nombre de espacio, lo que permite una organización/separación a la base de datos.
(Base de datos -> Schema -> Tabla)


### Compartida (Shared)

**Una Base de Datos - Un Schema**

Esta arquitectura es la que se usa por defecto en la mayoría de aplicaciones, se separa los usuarios de la aplicación por una relación con la tabla de usuarios.

Ventajas

-   La capa de datos es fácil de construir (crear las tablas de la base de datos).
-   Todos los usuarios usan el mismo dominio de la aplicación.

Desventajas

-   Es costoso (Tamaño y cantidad de peticiones a la base de datos).

### Separada (Isolated)

**Cada cliente (tenant) tiene su propia base de datos**

Esta arquitectura permite usar cualquier motor de base de datos, se puede relacionar como el proceso de virtualización en el que cada instancia se implementa para el nuevo cliente.

Ventajas

- Mayor seguridad.
- Fácil recuperación en caso de daño en la base de datos
- Bajo consumo de recursos de procesamiento

Desventajas

- Dificultad para escalar.
- Costoso en recursos de almacenamiento (se necesitan muchas bases de datos).
- Dificultad para compartir información entre clientes.
- Dificultad de actualización (hay que hacer el proceso por cada base de datos).

### Híbrida (Semi - Isolated)

**Una base de datos - Multiples Schemas**

Esta arquitectura usa lo mejor de las dos anteriores y es posible usarla en PostgreSQL. Esto permite, por ejemplo, que cada uno de los clientes tenga usuarios y sus datos estén separados por cada schema.

Ventajas

- Facilmente escalable.
- Reducción de costos en almacenamiento y procesamiento.
- Seguro (cada cliente tiene su información separada en el schema).
- Compartir información entre clientes (hay tablas que se pueden acceder por todos los clientes).

Desventajas

- El proceso de recuperación de datos de un schema es más complejo.
- Es menos seguro que las bases de datos separadas.

