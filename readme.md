# Proyecto CSS

Un proyecto de Laravel

## Instalación

Antes de empezar, prepare su entorno local siguiendo los pasos de la seccion "Setup en Windows" del [Manual técnico](https://drive.google.com/file/d/1IZVgoWFxZt6QJlOz0aYdzYGASiSFe7nF/view?usp=sharing).

En la raíz del proyecto...

Descargue el [.env](https://drive.google.com/file/d/1KDadONcbgew-xVdBYi7r-6hWYgwqy2Af/view?usp=sharing).

Acto seguido, ejecute los siguientes comandos:

```bash
# Instalación de composer
composer install

# Instalación de las dependencias de npm
npm install

# Migraciones
php artisan migrate
```

## Desarrollo

Antes de empezar sus sesiones de codificación debe ejecutar el siguiente comando, el cual es necesario para que se vean reflejados los cambios de fornt-end en el sitio:

```bash
npm run watch
```
En caso de que los cambios no se vean reflejados, presionar Ctrl+F5, esto recarga el sitio web sin cache.

Finalmente el sitio será accesible en el siguiente link [http://uca-css.test/css-proyecto/public](http://uca-css.test/css-proyecto/public).

## Producción

Al momento de hacer el último commit antes de implementar los nuevos cambios en el servidor, ejecute el siguiente comando para activar el modo producción:

```bash
npm run production
```
