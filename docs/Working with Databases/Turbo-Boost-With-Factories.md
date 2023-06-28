[< Volver al índice](/docs/readme.md)

# Turbo Boost With Factories

En este episodio integraremos fábricas de modelos para generar sin problemas cualquier número de registros de bases de datos.

Para eso tenemos que ingresar el siguiente comando en nuestra maquina virtual para crear la fabrica de Post. 
```bash
php artisan make:factory PostFactory
``` 
Eso generará un archivo en el directorio *database/factories* en el cual vamos a ingresar exportar los modelos y luego crear una función que pueda crear la estructura del Post. 

```php
use App\Models\Category;
use App\Models\User;
``` 
```php
public function definition()
{
    return [
        'user_id' => User::factory(),
        'category_id' => Category::factory(),
        'title' => $this->faker->sentence,
        'slug' => $this->faker->slug,
        'excerpt' => $this->faker->sentence,
        'body' => $this->faker->paragraph()
    ];
}
``` 
Para poder generar un Post se necesita una fabrica categoría por tanto vamos a ingresare el siguiente código a nuestra máquina virtual. 
```bash
php artisan make:factory CategoryFactory
``` 
Eso generará un archivo en el directorio *database/factories* en el cual vamos a ingresaremos el siguiente código. 
```php
public function definition()
{
    return [
        'name' => $this->faker->word,
        'slug' => $this->faker->slug
    ];
}
```
- Podemos generar datos de las siguientes dos formas: 

    - Para poder generar con las fabricas podemos hacerlo de la siguiente manera, y esto generará datos en nuestra base de datos: 
        ```bash
            php artisan tinker
            App\Models\Post::factory()->create();
        ```

    - Para poder generar categorías, usuarios, y posts aleatorios con un número especifico, colocamos esto en *database/seeders/DatabaseSeeder.php*
        ```php
        public function run()
            {

                Post::factory(2)->create();

            }
        ```
        Y refrescamos datos
        ```bash
            php artisan migrate:fresh --seed
        ```
        
![image](./images/Post%20and%20Category%20Factory%20ep28.png "Post y Categoría Fabrica")

