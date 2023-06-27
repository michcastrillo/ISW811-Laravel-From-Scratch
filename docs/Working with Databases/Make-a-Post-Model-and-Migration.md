[< Volver al índice](/docs/readme.md)

# Make a Post Model and Migration

En este episodio crearemos un modelo Post Eloquent. Pero para empezar necesitaremos una migración para crear un Post table, ingresamos a la maquina virtual el siguiente comando: 

```bash
php artisan make:migration create_posts_table
```
Esto creará un documento en el directorio *Database/migrations* llamado *create_post_table* en el cual ingresaremos el siguiente código en la función *up()*, es importante recordar que esta función crea la estructura de la base de datos. 
```bash
Schema::create('posts', function (Blueprint $table) {
     $table->id();
     $table->string('title');
     $table->text('excerpt');
     $table->text('body');
     $table->timestamps();
     $table->timestamp('published_at')->nullable();
});
```
Debemos realizar la migración con el siguiente comando para que los datos se almacenen de forma correcta. Antes de realizar la migración debemos asegurarnos que tenemos encendida la maquina virtual de la base de datos. 
```bash
php artisan migrate
```

![image](./images/post%20table%20created%20ep20.png "Post table")

A continuación, creamos nuestro modelo Post con el siguiente comando. 
```bash
php artisan make:model Post
```
Desde la maquina virtual ingresamos datos a nuestra tabla Post. 
```bash
php artisan tinker
$post = new App\Models\Post;
$post->title = 'My First Post';
$post->excerpt = 'Lorem ipsum dolar sit amet.';
$post->body = 'This is the body of the Post :)';
$post->save();
```
Por ultimo, nuestro post ya no se buscarán por el slug sino por el id, por tanto debemos cambiar su ruta en el directorio *routes/web.php*.
```bash
![image](./images/contenido%20posts%20ep20.png "Post table")
Route::get('posts/{post}', function ($id) {
    return view('post', [
        'post'=> Post::findOrFail($id)
    ]);
});
```
También cambiar su vista en el directorio *resources/views/posts.blade.php*.
```bash
<a href="/posts/{{$post->id; }}">{{ $post->title; }}</a>
```

![image](./images/my%20first%20post%20web%20ep20.png "Web posts")