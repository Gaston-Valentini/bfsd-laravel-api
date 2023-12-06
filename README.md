# README - 🕹️ Aplicación web LFG 🕹️
__<p align="center">Proyecto 6 - Full Stack Developer Bootcamp en GeeksHubs Academy </p>__

<p>
   <div align="center">
      <img src="./database/image/cabecera.jpg">
   </div>    
</p>


## 📋 Contenido del Readme

- ### 🚀 [Descripción](#descripcion)
- ### 🎯 [Objectivo](#objectivo)
- ### 🛠️ [Tecnologías Utilizadas](#tecnologías-utilizadas)
- ### 📉 [Diagrama de la Base de Datos](#diagrama-de-la-base-de-datos)
- ### 💡 [Endpoints](#endpoints)
- ### ⚙️ [Instrucciones de uso](#instrucciones-de-uso)
- ### 👏 [Agradecimientos](#agradecimientos)
- ### 🌟 [Mejoras](#mejoras)
- ### 📧 [Contacto](#contacto)


# 🚀 Descripción

Este proyecto del Bootcamp Full Stack está enfocado en PHP, en él hemos puesto a prueba nuestros conocimientos en PHP y Laravel. Trabajando en equipo para crear una aplicación web LFG (Looking For Group).

Esta aplicación busca abordar la desconexión entre empleados que trabajan de forma remota, facilitando la formación de grupos para jugar videojuegos y disfrutar del tiempo libre después del trabajo.

# 🎯 Objetivo

Nuestro objetivo central es crear un backend completo, incluyendo la base de datos y la lógica en PHP con Laravel. Implementaremos funciones como registro y autenticación de usuarios, creación y búsqueda de partidas de videojuegos, gestión de usuarios en las partidas, chat común, administración de perfiles y cierre de sesión. Diseñaremos una API REST eficiente, aplicando prácticas sólidas de desarrollo, como el uso de middleware y servicios para optimizar los controladores. 


# 🛠️ Tecnologías Utilizadas

Para desarrollar este proyecto, hemos hecho uso de las siguientes tecnologías:

[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white&labelColor=101010)]()  [![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white&labelColor=101010)]()   [![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white&labelColor=101010)]()


</details>


# 📉 Diagrama de la base de datos

<p>
   <div align="center">
      <img src="./database/image/data_base.png" style="max-width: 100%">
   </div>    
</p>



# 💡Endpoints
<details>
<summary>/auth</summary>
<br>


    - 1- Crear un usuario, registro.
               Descripción: Crear un nuevo usuario, recuperando la información de los campos requeridos a través del body. Y, se genera un registro en la base de datos de un nuevo usuario con el rol de "user".

            POST http://127.0.0.1:8000/api/register

        Body:
        ``` JSON
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

        Body:
        ``` JSON
            {
                "email": "zaira@zaira.com",
                "password": "123456"
            }
        ```
    
</details>
<summary>/usuario</summary>
<br>
    - 1- Obtener un usuario por Id.
        - Descripción: Obtener un usuario por el id, si el id enviado corresponde con el id del token que hemos obtenido con el Login.
            GET http://127.0.0.1:8000/api/user/{id}  

            Auth : User 
            Barer token : Token
 
        
    - 2- Actualizar un usuario por Id.
        - Descripción: Con el token obtenido al hacer Login, el usuario podra editar sus datos.

            PUT http://127.0.0.1:8000/api/user/{id}

            Auth : User 
            Barer token : Token


    - 3- Eliminar un usuario por el Id.
        - Descripción: Eliminar un usuario por el id.

            DELETE http://127.0.0.1:8000/api/user/{id}          

            Auth : Admin
            Barer token : Token
       
    - 4- Obtener todos los usuarios.
        - Descripción: Obtener los datos de todos los usuarios.

            GET http://127.0.0.1:8000/api/user

             Auth : User 
            Barer token : Token
    
</details>

<details>
<summary>/games</summary>
<br>
    - 1- Crear un juego.
            - Descripción: Crear un juego.
                    POST http://127.0.0.1:8000/api/createGame

                    Auth : User 
                    Barer token : Token

                Body:
                ``` JSON
                    {
                    "name": "GTA",
                    "description": "Un videojuego",
                    "image": "https://image.api.playstation.com/vulcan/ap/rnd/202202/2816/mYn2ETBKFct26V9mJnZi4aSS.png"
                    }

    - 2- Obtener todos los juegos.
            - Descripción: Obtener todos los juegos.
                GET http://127.0.0.1:8000/api/games

                Auth : User 
                Barer token : Token

    
                ```
    - 3- Actualizar un juego por el Id.
            - Descripción: Actualizar un juego por el Id, siempre que el usuario que está intentando modificarlo sea el creador del mismo.
                POST http://127.0.0.1:8000/api/updateGameById/{id}

                Auth : User 
                Barer token : Token
            
                ```
                 Body:
                ``` JSON:
                    {
                    "name": "GTA",
                    "description": "El mejor videojuego",
                    "image": "https://image.api.playstation.com/vulcan/ap/rnd/202202/2816/mYn2ETBKFct26V9mJnZi4aSS.png"
                    }

     - 4- Recuperar un juego por el Id.
            - Descripción: Recuperar un juego por el Id.
                GET http://127.0.0.1:8000/api/getGameById/{id}

                Auth : User 
                Barer token : Token
            
                ```

    - 5- Eliminar un juego por el Id.
            - Descripción: Eliminar un juego por el Id.
                POST http://127.0.0.1:8000/api/deleteGame/{id}

                Auth : User 
                Barer token : Token
            
                ```
                     
</details>

<details>
<summary>/room</summary>
<br>
    - 1- Crear una sala.
            - Descripción: Crear una sala.
                    POST http://127.0.0.1:8000/api/room

                    Auth : User 
                    Barer token : Token

                Body:
                ``` JSON
                    {
                    "game_id": 3,
                    "name":"Escuadrón GTA"
                    }

    - 2- Obtener todas las salas.
            - Descripción: Obtener todos las salas.
                GET http://127.0.0.1:8000/api/room

                Auth : User 
                Barer token : Token

    
                ```
    - 3- Actualizar una sala por el Id.
            - Descripción: Actualizar una sala por el Id, siempre que el usuario que está intentando modificarlo sea el creador del mismo.
                PUT http://127.0.0.1:8000/api/room/{id}

                Auth : User 
                Barer token : Token
            
                ```
                 Body:
                ``` JSON:
                    {
                    "name": "Malos GTA"
                    }
            NOTA: El usuario puede modificar cualquiera de los siguientes campos y, para realizar la actualización no es necesario introducir todos los campos.
                
                'game_id', 'name','image_url','is_active'
                
     - 4- Recuperar una sala por el Id.
            - Descripción: Recuperar una sala por el Id.
                GET http://127.0.0.1:8000/api/room/{id}
                Auth : User 
                Barer token : Token
            
                ```
     - 4- Recuperar todas las salas que sean activas.
            - Descripción: Recuperar una sala por el Id.
                GET http://127.0.0.1:8000/api/room/active
                Auth : User 
                Barer token : Token
            
                ```

    - 5- Eliminar una sala por el Id.
            - Descripción: Eliminar una sala por el Id.
                POST http://127.0.0.1:8000/api/room/{id}

                Auth : User 
                Barer token : Token
            
                ```       
</details>

# ⚙️ Instrucciones de uso

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

4. Ejecutamos las migraciones mediante el comando `php artisan migrate` 
5. Si estamos en desarrollo, lo hacemos funcionar y actualizarse en tiempo real mediante el comando `php artisan serve`
6. Usamos los endpoints almacenados en database/routes/api.php para usar las distintas funcionalidades que se han diseñado.


# 👏 Agradecimientos
Este proyecto es el reflejo de todos los conocimientos que hemos adquirido hasta la fecha en el BootCamp FullStack Developer.

# 🌟 Mejoras
<!-- TODO -->

# 📧 Contacto
Podéis contactar con nosotros a través de los siguientes medios de comunicación:

- ***Gaston Valentini***  
Contacta conmigo por correo electrónico [gastonvalentiniruiz@gmail.com](mailto:gastonvalentiniruiz@gmail.com). Además, puedes en seguirme en [GitHub]((https://github.com/Gaston-Valentini))   | [LinkedIn](https://www.linkedin.com/in/gastonvalentini/)


- ***Marta Guillem***  
Contacta conmigo por correo electrónico [martaguillem@outlook.es](mailto:martaguillem@outlook.es). Además, puedes en seguirme en [GitHub]((https://github.com/martaguillemolmos))   | [LinkedIn](https://www.linkedin.com/in/marta-guillem-olmos-b26b9b293/)


- ***Antonio Ainsa***  
Contacta conmigo por correo electrónico [antonioinsa@tutanota.com](mailto:antonioinsa@tutanota.com). Además, puedes en seguirme en [GitHub]((https://github.com/antonioinsa))   | [LinkedIn](https://www.linkedin.com/in/antonioinsa/)
