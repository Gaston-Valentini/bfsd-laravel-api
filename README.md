# README - 🕹️ Aplicación web LFG 🕹️
__<p align="center">Proyecto 6 - Full Stack Developer Bootcamp en GeeksHubs Academy </p>__

<p>
   <div align="center">
      <img src="./database/image/cabecera.jpg" width="35%">
   </div>    
</p>
<br></br>

### 📋 Contenido del Readme

- <a href="#🚀-descripción"><h4>🚀 Descripción</h4></a>
- <a href="#🎯-objetivo"><h4>🎯 Objetivo</h4></a>
- <a href="#🛠️-tecnologías-utilizadas"><h4>🛠️ Tecnologías utilizadas</h4></a>
- <a href="#📉-diagrama-de-la-base-de-datos"><h4>📉 Diagrama de la base de datos</h4></a>
- <a href="#💡endpoints"><h4>💡 Endpoints</h4></a>
- <a href="#⚙️-instrucciones-de-uso"><h4>⚙️ Instrucciones de uso</h4></a>
- <a href="#👏-agradecimientos"><h4>👏 Agradecimientos</h4></a>
- <a href="#🌟-mejoras"><h4>🌟 Mejoras</h4></a>
- <a href="#📧-contacto"><h4>📧 Contacto</h4></a>

<br></br>

## 🚀 Descripción

Este proyecto del Bootcamp Full Stack está enfocado en PHP, en él hemos puesto a prueba nuestros conocimientos en PHP y Laravel. Trabajando en equipo para crear una aplicación web LFG (Looking For Group).

Esta aplicación busca abordar la desconexión entre empleados que trabajan de forma remota, facilitando la formación de grupos para jugar videojuegos y disfrutar del tiempo libre después del trabajo.

## 🎯 Objetivo

Nuestro objetivo central es crear un backend completo, incluyendo la base de datos y la lógica en PHP con Laravel. Implementaremos funciones como registro y autenticación de usuarios, creación y búsqueda de partidas de videojuegos, gestión de usuarios en las partidas, chat común, administración de perfiles y cierre de sesión. Diseñaremos una API REST eficiente, aplicando prácticas sólidas de desarrollo, como el uso de middleware y servicios para optimizar los controladores. 


## 🛠️ Tecnologías Utilizadas

Para desarrollar este proyecto, hemos hecho uso de las siguientes tecnologías:

[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white&labelColor=101010)]()  [![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white&labelColor=101010)]()   [![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white&labelColor=101010)]() ![Postman](https://img.shields.io/badge/-Postman-000?&logo=Postman) ![GitHub](https://img.shields.io/badge/-GitHub-05122A?style=flat&logo=github)&nbsp;![Git](https://img.shields.io/badge/-Git-05122A?style=flat&logo=git)&nbsp;



</details>


## 📉 Diagrama de la base de datos

<p>
   <div align="center">
      <img src="./database/image/data_base.png" style="max-width: 100%">
   </div>    
</p>



## 💡Endpoints
<details>
<summary>Click para visualizar</summary>
<br>


  - USUARIOS

    - 1- Crear un usuario, registrarnos.
               Descripción: Crear un nuevo usuario, recuperando la información de los campos requeridos a través del body. Y, se genera un registro en la base de datos de un nuevo usuario con el rol de "user".

            POST http://127.0.0.1:8000/api/register
        body:
        ``` js
            {
               "name": "Zaira",
               "surname": "Guillem Perez",
               "nickname":"maguol",
               "email": "zaira@zaira.com",
               "password": " 123456"
            }
        ```
    - 2- Login.
            - Descripción: Al acceder, nos devuelve un token a través del body que utilizaremos más tarde en las rutas habilitadas para los usuarios.

            POST http://127.0.0.1:8000/api/login 
        body:
        ``` js
            {
                "email": "zaira@zaira.com",
                "password": "123456"
            }
        ```
    - 3- Obtener USER por Id.
            - Descripción: Con el token obtenido al hacer Login, podremos obtener los datos del user al que pertenece ese token.

            GET http://127.0.0.1:8000/api/user/{id}  
        
    - 4- Actualizar USER por Id.
            - Descripción: Con el token obtenido al hacer Login, el usuario podra editar sus datos.

            PUT http://127.0.0.1:8000/api/user/{id}

  - SuperAdmin

    - 5- ELiminar USER por Id.
            - Descripción: Al acceder como superAdmin, se obtendra el token con el suficiente acceso requerido para la eliminación de un usuario en concreto, especificanto su Id.

            DELETE http://127.0.0.1:8000/api/user/{id}          
       
    - 6- Obtener todos los USER`s
            - Descripción: Al acceder como superAdmin, se obtendra el token con acceso requerido para la obtencion de todos los usuarios.

            GET http://127.0.0.1:8000/api/user
     ...
</details>

## ⚙️ Instrucciones de uso

1. Clona este repositorio en tu máquina local usando el siguiente comando: `git clone [URL del repositorio]`.
2. A continuación instala todas las dependencias con el comando ` composer install `
3. Conectamos nuestro repositorio con la base de datos mediante las credenciales en el archivo con las variables de entorno que se encuentran en el archivo .env

    ``` 
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=

    ```  

4. Ejecutamos las migraciones mediante el comando `php artisan migration` 
5. Si estamos en desarrollo, lo hacemos funcionar y actualizarse en tiempo real mediante el comando `php artisan serve`
6. Usamos los endpoints almacenados en database/routes/api.php para usar las distintas funcionalidades que se han diseñado.


## 👏 Agradecimientos
Este proyecto es el reflejo de todos los conocimientos que hemos adquirido hasta la fecha en el BootCamp FullStack Developer.

## 🌟 Mejoras
<!-- TODO -->

## 📧 Contacto
Podéis contactar con nosotros a través de los siguientes medios de comunicación:

***Gaston Valentini***
[![Gmail](https://img.shields.io/badge/Gmail-C6362C?style=for-the-badge&logo=gmail&logoColor=white)](gastonvalentiniruiz@gmail.com) [![GitHub](https://img.shields.io/badge/github-%2324292e.svg?&style=for-the-badge&logo=github&logoColor=white)](https://github.com/Gaston-Valentini) [![LinkedIn](https://img.shields.io/badge/linkedin-%231E77B5.svg?&style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/gastonvalentini/)

 
***Marta Guillem***  
[![Gmail](https://img.shields.io/badge/Gmail-C6362C?style=for-the-badge&logo=gmail&logoColor=white)](martaguillem@outlook.es) [![GitHub](https://img.shields.io/badge/github-%2324292e.svg?&style=for-the-badge&logo=github&logoColor=white)](https://github.com/martaguillemolmos) [![LinkedIn](https://img.shields.io/badge/linkedin-%231E77B5.svg?&style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/marta-guillem-olmos-b26b9b293/)


***Antonio Insa*** 
[![Gmail](https://img.shields.io/badge/Gmail-C6362C?style=for-the-badge&logo=gmail&logoColor=white)](antonioinsa@tutanota.com) [![GitHub](https://img.shields.io/badge/github-%2324292e.svg?&style=for-the-badge&logo=github&logoColor=white)](https://github.com/antonioinsa) [![LinkedIn](https://img.shields.io/badge/linkedin-%231E77B5.svg?&style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/antonioinsa/)
