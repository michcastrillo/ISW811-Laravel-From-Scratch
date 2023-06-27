[< Volver al índice](/docs/readme.md)

# Find a Composer Package for Post Metadata
En este episodio se trabajan metadatos llamados Yaml Front Matter, con ayuda del composer. Se descarga los metadatos en nuestra maquina virtual de la siguiente manera: 

```bash
cd /vagrant/sites/lfts.isw811.xyz
composer require spatie/yaml-front-matter
```
Agregamos el siguiente encabezado a nuestros post individuales, este será el contenido de nuestros post, y será mas fácil acceder a ellos gracias a los metadatos. 
```bash
---
title: My first post
slug: my-first-post
excerpt:  Lorem ipsum dolor sit amet consectetur adipisicing elit.
date: 2023-06-20
---
```
En el modelo que habíamos creado del directorio App, llamamos la librería para poder usar los metadatos, y se crea un objeto con su respetivo constructor. 
```php
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post {

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug) {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }
}
```
Agregamos dos funciones más al modelo, donde se extrae la información de cada post para retornarlo a la vista, la ultima función buscar que el slug coincida con el parámetro.
```php
    public static function all()
    {
        return collect(File::files(resource_path("posts")))
        ->map(fn($file)=> YamlFrontMatter::parseFile($file))
        ->map(fn ($document) => new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug,
        ));
    }

    public static function find($slug)
    {
        return static::all()->firstWhere('slug',$slug);

    }
```
Cambiamos la vista posts por un foreach que nos devuelva todos los posts, y además un link que nos ayude a acceder a su contenido. 
```html
<!DOCTYPE html>
<title>My blog</title>
<link rel="stylesheet" href="/app.css">
<body>
    <?php foreach ($posts as $post) : ?>
    <article>
       <h1><a href="/posts/<?= $post->slug; ?>"><?= $post->title; ?></a></h1>
       <div>
            <?= $post->body; ?>
        </div>
    </article>
    <?php endforeach; ?>
</body>
```
En el contenido del post podemos agregar las variables que quisieramos mostrar en el blog.  
```html
<h1><?= $post->title; ?></h1>
<div>
    <?= $post->excerpt; ?>
</div>
```
Las rutas que vamos a necesitar son las que muestran todos los post, y la ultima es la que encuentra el slug, para buscar su respectiva vista.
```php
Route::get('/', function () {
    return view('posts', [
        'posts'=> Post::all()
    ]);
});

Route::get('posts/{post}', function ($slug) {

    return view('post', [
        'post'=> Post::find($slug)
    ]);

})->Where('post', '[A-z_\-]+');
```
Y así obtenemos una página dinámica: 
![image](./images/posts%20dinamicos%20ep12.png "posts")
![image](./images/post%20dinamico%20ep12.png "post")