[< Volver al índice](/docs/readme.md)

# Search (The Cleaner Way)

Ahora que nuestro formulario de búsqueda está funcionando, vamos refactorizar el código en algo más reutilizable. Para esto vamos a pasar todo el código del input de búsqueda al controlador. 

Pero primero, con el siguiente se comando se crea el controlador: 

```bash
    php artisan make:controller PostController
```
Esto va a crear un archivo en *app/Http/Controllers*, en el cual exportaremos los modelos correspondientes, para que el controlador retorne la vista de todos los posts, categorías, y los post que coincidan con lo que el usuario digite en el input.  

```php
    use App\Models\Category;
    use App\Models\Post;

    class PostController extends Controller
    {
        public function index(){
            return view('posts', [
                'posts' => Post::latest()->filter(request(['search']))->get(),
                'categories' => Category::all()
            ]);
        
        }

        public function show(Post $post)
        {
            return view('post', [
                'post' => $post
            ]);
        }
    }
```

Entonces las rutas en *routes/web.php* quedarían de la siguiente manera: 
```php
    use App\Http\Controllers\PostController;

    Route::get('/', [PostController::class, 'index'])->name('home');

    Route::get('posts/{post:slug}', [PostController::class, 'show']);
```

En *app/Models/Post.php* haremos el filtro de búsqueda de la palabra que digite el usuario con los posts que hayan en la base de datos. Tiene que coincidir con el titulo o el body. 
```php
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%'));
    }
```

De esta manera nuestro código queda mas limpia y asi la misma funcionalidad de búsqueda que el episodio pasado. 