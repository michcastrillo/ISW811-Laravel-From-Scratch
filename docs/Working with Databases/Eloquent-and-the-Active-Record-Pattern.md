[< Volver al índice](/docs/readme.md)

# Eloquent and the Active Record Pattern

Pasemos ahora a Eloquent, que es la implementación de Active Record de Laravel. En la maquina virtual, en el directorio de nuestra aplicación, corremos el siguiente comando generar un registro en la base de datos con un objeto Eloquent: 

```bash
php artisan tinker
$user = new App\Models\User;
```

Ingresamos las credenciales de nuestro usuario, en este caso utilizamos *bcrypt()* para encriptar la contraseña. El comando *$User->save();* lo utilizamos para guardar los cambios realizados. 
![image](./images/creacion%20de%20usuario%20ep19.png "Creación de usuario")

En la base de datos se puede apreciar de la siguiente manera lo nuevos datos ingresados. 

![image](./images/base%20de%20datos%20ep19.png "TablesPlus")

- Los siguientes comandos son usados para: 

    - Encontrar un usuario por su id: 
        ```bash
        User::find();
        user[0];
        ```
    - Devuelve el valor de la llave que se le solicita:
        ```bash
            $user->pluck('name')
        ```
    - Para ver todos los datos de la base de datos *User*:
        ```bash
        User::all();
        ```