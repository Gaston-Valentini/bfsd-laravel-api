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
<!-- TODO -->
<details>
<summary><h4>/user</h4></summary>

<h5> 1- Crear un usuario, registrarnos </h5>
- Descripción: Crear un nuevo usuario, recuperando la información de los campos requeridos a través del body. Y, se genera un registro en la base de datos de un nuevo usuario con el rol de "user".

        http
        POST http://127.0.0.1:8000/api/register
        
        
        json
        {
            "name": "Marta",
            "surname": "Guillem Olmos",
            "nickname":"maguol",
            "email": "martaguillem@gmail.com",
            "password": " 123456"
        }
        
<h5> 2- Login </h5>
- Descripción: Al acceder, nos devuelve un token a través del body que utilizaremos más tarde en las rutas habilitadas para los usuarios.


        http
        POST http://127.0.0.1:8000/api/login
        
        
        json
        {
     
            "email": "martaguillem@gmail.com",
            "password": " 123456"
        }
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
