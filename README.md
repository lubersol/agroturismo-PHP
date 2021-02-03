# PROYECTO AGROTURISMO CREADO CON PHP+LARAVEL+MYSQL :four_leaf_clover:

![Screenshot](public/treboles.gif)


API REST creada en backend con PHP, Laravel y MySQL para nutrir a una website de agroturismo "Varitx Paradise", destinada a hacer reservas para pasar vacaciones en una finca de agroturismo situada en el norte de Mallorca. 


## DESCRIPCIÓN :open_book:

Hay dos roles en la API: cliente y administrador.

Como *cliente* puedes registrarte, hacer login, solicitar, ver y eliminar reservas.

Como *administrador*, puedes ver las reservas de todos los usuarios.


## TECNOLOGÍAS :gear:

:large_blue_circle: PHP 8.

:large_blue_circle: Laravel 6.

:large_blue_circle: PHP MyAdmin.

:large_blue_circle: Composer.

:large_blue_circle: Passport.

:large_blue_circle: GIT.

:large_blue_circle: Git Flow.

:large_blue_circle: Postman.

:large_blue_circle: Eloquent.


## ENDPOINTS :link:

### Clientes: :bust_in_silhouette: 

:round_pushpin: POST localhost:8000/api/auth/register (añade un nuevo usuario).

:round_pushpin: POST localhost:8000/api/auth/login (el usuario introduce su email y la contraseña para entrar).

:round_pushpin: GET localhost:8000/api/auth/logout (el usuario sale de su cuenta).


### Reservas: :date:

:round_pushpin: POST localhost:8000/api/auth/rent/create (añade una nueva reserva).

:round_pushpin: DELETE localhost:8000/api/auth/rent/cancel/{id} (cancela la reserva de un usuario).

:round_pushpin: GET localhost:8000/api/auth/rent/show/{id} (el usuario puede ver sus reservas).

:round_pushpin: GET localhost:8000/api/auth/rent/showAll (el administrador puede ver todas las reservas de los usuarios). 

## DIAGRAMA TABLAS PHP MYADMIN :bulb:

![Screenshot](public/diagrama.png)

## Enlace a Heroku del frontend de REACT :link:

https://varitxparadise.herokuapp.com/

## Instalacion :hammer_and_wrench:

:gear: composer update

:gear: php artisan migrate

:gear: php artisan passport:install

:gear:php artisan serve (levantar el servidor)