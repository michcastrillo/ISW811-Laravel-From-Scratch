[< Volver al índice](/docs/readme.md)

# Migrations: The Absolute Basics
En Laravel, las migraciones son una forma de administrar y aplicar cambios al esquema de su base de datos. Por tanto, existen varios comandos: 

- **php artisan migrate**  Para migrar su base de datos. También genera una tabla en la base de datos.
- **php artisan migrate:rollback** Revierte las migraciones.
- **php artisan migrate:fresh** NO se utiliza si la tabla esta en producción borrará su base de datos antes de migrar.

Después de haber migrado se crean unos archivos en el directorio *database/migrations*.
![image](./images/migration%20file.png "Migration file")
\
Uno de los archivos que se crean *create_users_table* el cual contiene código para crear usuarios.
```php
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
```
El método *up()* es usado para agregar nuevas tablas a la base de datos, mientras el método *down()* revierte las operaciones ejecutadas por el método *up()*.
```php
 public function down()
    {
        Schema::dropIfExists('users');
    }
```
