# Plugin App Installer for CakePHP 3+

Install your CakePHP 3.0+ plugins in plugins folder inside your App

La consola Bake de CakePHP genera plugins en la carpeta /plugins del sitio;
pero cuando se instalan a través de composer, los aloja en la carpeta /vendor.

Este plugin instala cualquier plugin que tenga asignado
el tipo "cakephp-app-plugin" en la carpeta /plugins del sitio.

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require cakephp-extended/plugin-app-installer
```

Incluye en el archivo composer.json del plugin el siguiente fragmento:
```
{
  "type": "cakephp-app-plugin"
}
```

## Authors

- **Fernando Pita** - initial work

## License

This project is licensed under the MIT License
