# ZeepCommerce API + Microservice

Sistema API de ZeepCommerce para la venta / visualización de artículos varios.
Será una API desacoplada del frontend `FrontApp` realizado en ReactJS.

# Instrucciones de Instalación

Este documento describe los pasos necesarios para configurar el entorno de desarrollo en la PC local bajo sistemas operativos Linux utilizando Docker.

### Pre instalación del Proyecto.

* Tener instalado Git.
* Tener instalado Composer.
* Tener instalado php-client php-mbstring.

### Clonar Repositorio de GitHub.

``` 
git@github.com:Los-nonos/Gryffindor.git
```

Al utilizar SSH realizar los siguientes pasos de configuración:

`https://help.github.com/articles/connecting-to-github-with-ssh/`

Una vez que ya tenemos clonado nuestro repositorio realizaremos los siguientes pasos.

## Si es la primera vez que clonás el repo
### Instalación de los contenedores de Docker.
* Primeramente tener `docker` y `docker-compose` instalados (utilizar las guías de Digital Ocean estan bien documentadas).

1. Entrar a la carpeta de docker del proyecto. (`gryffindor/zeepdocker/`)

2. Realizar un `docker-compose pull`

3. Realizar un `docker-compose up` (Al realizar este comando en un momento queda clavado el proceso porque ya termino, debemos cancelarlo al proceso con `Ctrl + C`)

4. Encender los contenedores con `docker-compose start`

5. Listo ya se encuentra levantado el servidor y la base de datos (MySQL).

### Asignación de los permisos de Laravel.
Es necesario para la correcta visualización y funcionamiento del proyecto que se asignar los permisos de Laravel:

1. Volver al directorio raíz del proyecto. (`gryffindor/`)

2. Ejecutar los siguientes comandos en la consola para asignar los permisos:
```
    sudo chown -R 1000:33 storage/
    sudo chmod -R g+w storage/
    sudo chown -R 1000:33 bootstrap/cache
    sudo chmod -R g+w bootstrap/cache
```

PD: Puede suceder que en momentos al crearse archivos de Logs nuevos tengamos que reasignar los permisos al storage/ (ver como solucionar esto, muchas veces al terminar la instalación del proyecto necesitamos asignar de nuevo estos permisos).
 
### Instalación de las dependencias.
1. Nos ubicamos en la carpeta de docker del proyecto (`zeepdocker/`)

2. Acceder al Lord Commander (Ricky Fort) ejecutando `./webapp` (basicamente es nuestro bash de nginx `docker-compose run --user=1000 phpnginx bash`)

3. Ejecutamos `./composer.phar install`

4. Esperar la instalación de dependencias de Laravel y compañía. <---- Puede tardar, dependiendo de la velocidad de conexión a internet.

### Crear archivo de Enviroment
1. En nuestro terminal ejecutar `cp .env.example .env`
2. Este archivo contiene las credenciales de las cuentas de los servicios utilizados.

### Configuración de la Base de Datos.
###### Ésto no es necesario, te puede traer problemas con el container mysql de zeepdocker. Pero para deployar lo vamos a necesitar, así que se deben realizar pruebas periódicas en entorno mysqlserver local y comparar resultados en workbench. Todo ésto cuando estemos en un punto avanzado del desarrollo. Me pareció importante dejarlo indicado en el readme para que se tenga en cuenta un requisito futuro que TODOS los desarrolladores involucrados en el proyecto DEBEMOS SABERLO.

1. Instalar mysql-client

2. Ejecutamos `docker exec -it doclacade_mysql_1 bash` (con esto ingresamos a mysql del docker)

4. Ejecutamos `mysql -u root -psecret`

5. Creamos la BD: `create database [ NOMBRE BDD ];`

6. Verificamos la creación de la misma con: `show databases;`

7. Salimos si la creamos con éxito.

### Ejecución de las migraciones (Laravel)
0. Primeramente actualizar el archivo `.env` con los datos correspondientes de la BD:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=apizeep
DB_USERNAME=test
DB_PASSWORD=test
```

1. Entramos al `bash nginx` del Lord Commander ubicados en `Gryffindor/` ejecutar: `./webapp`.

##### Los comandos deben ser tirados siempre dentro del bash del comandante.

2. Ejecutar para tener el `.env` completo y correcto `php artisan key:generate` y `php artisan jwt:secret`. 

3. Una vez obtenidas las keys, debemos correr las migraciones con `php artisan migrate` y `php artisan doctrine:schema:create`.

4. Una vez terminada la ejecución ya tendremos las tablas correspondientes en nuestra base de datos `apizeep`.

5. Listo ya podemos salir del comandante.

### Ultimos pasos.
1. Ya podemos entrar al sitio `localhost`

2. Deberíamos visualizar correctamente el sitio de bienvenida (O algun Health Check en el caso de ser API).


# Arquitectura del Sistema

Respecto a la organización de capas lógicas se encuentra basado en Arquitectura Hexagonal / Ports and Adapter / Onion Architecture:

![Arquitectura Software](https://user-images.githubusercontent.com/22304957/63598334-b6d93d00-c595-11e9-958a-8f5ff090993f.png)

### API/Presentation:
Esta es la capa propia del patrón MVC, esta es la capa correspondiente para acoplarnos al Framework, en nuestro caso *Laravel*

Estructura de directorios:

- Controllers / Actions : Puede orientarse a acciones directamente donde poseen todas las operaciones correspondientes como: Crear - Leer - Actualizar - Eliminar. Son los encargados de comunicarse con la capa de `Aplicacion` mediante los contratos correspondientes (Commands/Queries). Estan acoplados al framework y al protocolo HTTP en este caso GET/POST/PUT/PATCH/DELETE.

Es importante para evitar el acoplamiento a nivel interno que no se envíen a los servicios directamente la Request completa, para eso existen los contratos (Commands/Queries) que son los que nos permiten según el caso de uso ver que datos son necesarios a nivel de Aplicación para lograr comunicarnos y realizar una acción determinada.

- Routes: Lugar donde colocaremos los diferentes endpoints de nuestra API y donde Laravel hace un match entre el path especificado y el Action correspondiente.

### APPLICATION
- Commands: Serán los puntos de entrada a nuestra capa de aplicación, son las interfaces que conoce la capa superior (API/Presentation) para comunicarse a traves de nuestro dominio del sistema.

- Services/Handlers: Son los que orquestaran los casos de usos correspondientes al sistema, estos son los encargados de manejar los casos de uso utilizando los elementos de su misma capa o utilizando elementos del dominio correspondiente como los repositorios (contratos), entidades, servicios de dominio, Value Objects, Enums, etc.

### DOMAIN
Esta capa es Framework Agnostic, al igual que debería serlo la capa anterior, se caracteriza por contener toda la lógica de nuestro negocio, mediante entidades / servicios de dominio / value objects. Representa los conceptos del negocio de nuestro cliente

- Entities: Son los objetos con identidad correspondientes a nuestro dominio por ejemplo: Usuario, Producto, Reservas, etc.

- Repositorios (Contratos): Se almacenaran los contratos / interfaces correspondientes al dominio de nuestra app, pudiendo entrar aquí para desacoplar la persistencia, las interfaces de la capa de repositorios.

- Value Objects

- Enums

...

### INFRASTRUCTURE

#### PERSISTENCE

Es la capa encargada de persistir nuestras entidades de dominio.

- Repositories: Para manejar las consultas de las entidades y la persistencia de las mismas, esta capa es la implementación de los contratos declarados en el dominio del sistema.
- Migrations: Para el correcto versionado de las tablas y que todos los devs tengamos una mayor consistencia de nuestra base de datos, ya que ejecutando estas mismas nos aseguramos que todos poseemos la misma BD.
- Seeders: Para rellenar las bases con sus tablas correspondientes.
- Mappings: Archivos para desacoplar el dominio de la persistencia, aca realizamos el mapeo que dice que tablas se manejan con que atributos del sistema. (En caso de utilizar Doctrine)

#### Fuentes de consulta para estas Arquitecturas, Conceptos, Buenas prácticas:

https://martinfowler.com/eaaCatalog/ (Conceptos para el ORM DataMapper vs ActiveRecord)

https://domainlanguage.com/ddd/ (Conceptos DDD como: Entidades / Value Objects / Servicios / Commands / Shared-Kernel / Repositorios)

Ese libro azul principal tiene todos los conceptos correspondientes utilizados aquí como las mejores prácticas para orientarse al dominio y crear sistemas lo más desacoplados y correctos posibles.

Un resumen de este gratuito es:

http://domainlanguage.com/wp-content/uploads/2016/05/DDD_Reference_2015-03.pdf

### Inyección Dependencias / Inversión de Control
Para mantenernos sin acoplamientos y poder cumplir bien con la arquitectura se necesita de la inyección de dependencias y en general de un IoC para inversión de control, como lo nombran los Principios SOLID. Esto nos ayuda a utilizar interfaces / contratos, que quien los inyecta es alguien de infrastructra transversal que resuelve por nosotros las dependencias necesarias.
