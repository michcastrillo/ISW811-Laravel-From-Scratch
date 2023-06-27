[< Volver al índice](/docs/readme.md)

# Your First Eloquent Relationship

Nuestro próximo trabajo es descubrir cómo asignar una categoría a cada post. Para permitir esto, necesitaremos crear un nuevo modelo Eloquent y una migración para representar una Categoría, para esto, ingresamos el siguiente comando: 

```bash
php artisan make:model Category -m
```
La estructura de nuestra base de datos categoría será de la siguiente manera, en el cual esta en el directorio *database/migrations/create_categories_table*.
```php
 Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug');
    $table->timestamps();
});
```
Ya que debemos asociar cada post a una categoría debemos agregar una nueva columna con el id de una categoría(foreign-key) al esquema en el cual tenemos en el directorio *database/migrations/create_post_table.php*.
```php
 $table->foreignId('category_id');
```
Para que los cambios se realicen correctamente debemos 'refrescar' nuestra base de datos, esto incluye también que se borren sus datos, por esto vamos agregar una nueva categoría y post. 
```bash
    php artisan migrate:fresh
    $ php artisan tinker;
    use App\Models\Category;
    $c = new Category;
    $c->name = 'Personal';
    $c->slug = 'personal';
    $c->save();
```
Antes de agregar un nuevo post debemos recordar que en *app/models/post.php* tenemos un *$fillable* el cual solo permite que se ingresen las key que contenga, y la función categoría permite acceder a la categoría asociada a un post utilizando la sintaxis $post->category. 

```php
    protected $fillable = ['category_id','slug','title', 'excerpt', 'body'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
```
Ahora, ya hechas las configuraciones se puede agregar un nuevo post. 

```bash
    Post::create(['category_id' => 1,'slug' => 'my-family-post','title' => 'My Family Post', 'excerpt' => 'Excerpt for my post', 'body' => 'Lorem ipsum dolar sit amet.']);
```
Para que se muestre en la vista la relación post->categoria debemos agregar lo siguiente a *resources/views/post.blade.php*.

```html
    <p>
        <a href="#">{{$post->category->name}}</a>
    </p>
```
![image](./images/post%20with%20category%20ep24.png "Post with category")