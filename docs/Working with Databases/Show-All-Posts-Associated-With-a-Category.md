[< Volver al índice](/docs/readme.md)

# Show All Posts Associated with a Category

Ahora que tenemos el concepto de Categoría en nuestra aplicación, haremos una nueva ruta que obtenga y cargue todas las publicaciones asociadas con la categoría dada.Para esto tenemos que tener un endpoint para esta nueva URL, en el directorio *routes/web.php*.
```php
use App\Models\Category;
Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts'=> $category->posts
    ]);
});
```
Una categoría puede pertenecer a muchos posts por tanto este método hace referencia a la relación "tine muchos" en el modelo Category, es decir que puede tener varios objetos post asociados.
```php
public function posts() 
{
    return $this->hasMany(Post::class);
}
```
Para que cambie la ruta en la url debemos agregar lo siguiente a los siguientes directorios. 

- *resources/views/post.blade.php*.
- *resources/views/posts.blade.php*.

```html
    <p>
        <a href="/categories/{{$post->category->slug}}">{{ $post->category->name}}</a>
    </p>
```
![image](./images/url%20by%20categories%20ep25.png "Nueva URL")