[< Volver al índice](/docs/readme.md)

# Laravel Breeze Quick Peek

En este episodio se explica que es Laravel Breeze es una herramienta que proporciona una configuración básica para la autenticación de usuarios en aplicaciones web. Esta creado para facilitar la creación de un registro de usuarios, y login, además posee una funcionalidad para que los usuarios puedan restablecer su contraseña en caso de olvidarla, esto implica el envío de un correo electrónico con un enlace para restablecer la contraseña.Esta pensada para personalizar y ampliar según las necesidades del proyecto, como colocar el nombre de la empresa.

Si se quisiese desarrollar sobre esta herramienta se debe considerar ya tener instalado Laravel, y el proyecto listo, se puede realizar la instalación de Laravel Breeze con el siguiente comando:

```bash
    composer require laravel/breeze --dev
```

Para hacer la publicación de todos los elementos que nos proporciona Laravel Breeze, se debe digitar el siguiente comando:

```bash
    php artisan breeze:install
```

