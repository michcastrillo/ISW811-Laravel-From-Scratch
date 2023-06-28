[< Volver al índice](/docs/readme.md)

# Database Seeding Saves Time

En esta lección, asociaremos una publicación de blog con un autor o usuario en particular. Para esto debemos agregar una nueva columna en *database/migrations/create_posts_table.php*.

```php
$table->foreignId('user_id');
```
Hacemos de manera única estas columnas de categoría para que no se repitan. Directorio: *database/migrations/create_categories_table.php*.
```php    
$table->string('name')->unique();
$table->string('slug')->unique();
```
En *database/seeders/DatabaseSeeder.php* pondremos lo necesario para generar datos en usuarios, categorías, y posts. Primero importamos los modelos. 
```php  
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
```
- El método *truncate()* de cada modelo, se utiliza para eliminar los registros de la tablas con respecto a su modelo.
- *User::factory()->create()* se utiliza a crear un usuario con datos aleatorios. 

```php   
 public function run()
    {
        User::truncate();
        Post::truncate();
        Category::truncate();

        $user = User::factory()->create();

        $personal = Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        $family = Category::create([
            'name' => 'Family',
            'slug' => 'family',
        ]);

        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work',
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My Family Post',
            'slug' => 'my-family-post',
            'excerpt' => 'Lorem ipsum dolor sit amet',
            'body' => '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde alias animi distinctio vel officiis maiores, sed officia sint incidunt, porro eos veniam accusantium aspernatur eius excepturi neque impedit numquam nemo!</p>',
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $work->id,
            'title' => 'My Work Post',
            'slug' => 'my-work-post',
            'excerpt' => 'Lorem ipsum dolor sit amet',
            'body' => '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde alias animi distinctio vel officiis maiores, sed officia sint incidunt, porro eos veniam accusantium aspernatur eius excepturi neque impedit numquam nemo!</p>',
        ]);
    }
```
Para que los usuarios se relacionen con cada post utilizaremos belongsTo() en *app/models/post.php*.
```php   
public function user()
{
    return $this->belongsTo(User::class);
}
```
Y como un usuario puede pertenecer a muchos post utilizamos hasMany() en *app/models/user.php*.
```php   
public function posts() 
{
    return $this->hasMany(Post::class);
}

```
Al final utilizaremos el siguiente comando para borrar nuestros datos, y agregar los nuevos cambios. 

```bash 
php artisan migrate:fresh --seed
```
Al final para que se muestre el usuario debemos agregarlo en *resources/views/posts.blade.php*.
```html
<p>
    By <a href="#">{{ $post->user->name}}</a> in <a href="/categories/{{$post->category->slug}}">{{ $post->category->name}}</a>
</p>
```

![image](./images/Usuario%20por%20post%20ep27.png "Usuario por post")