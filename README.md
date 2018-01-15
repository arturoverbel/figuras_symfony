Fig
===

# Workspace Figures

Proyecto de spacios de varios y diferentes figuras.

## Instalacion

Descomprimir en la caprta

Seguir las instrucciones de http://symfony.com/doc/3.4/setup.html para la instalación de symfony.

## Enlace

```
<route-dir>/web/app_dev.php
```
## Database

Los parámetros de la base de datos se realizan en:

```
<route-dir>/app/config/parameters.yml
```

Luego ejecuta el comando en la carpeta del servidor:
```
php bin/console doctrine:schema:update --force
```

O bien actualizar la base de datos con el esquema de la base de datos en el mismo proyecto, link:

https://github.com/arturoverbel/figuras_symfony/blob/master/data/fig.sql


