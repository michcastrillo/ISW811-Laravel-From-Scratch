[< Volver al índice](/docs/readme.md)

# Collection Sorting and Caching Refresher
Cada publicación ahora incluye la fecha de publicación como parte de sus metadatos, sin embargo, el feed actualmente no está ordenado de acuerdo con esa fecha. Afortunadamente, debido a que estamos usando colecciones de Laravel.

Por tanto, debemos agregar el siguiente código al directorio app/Models/Post.php para ordenar los post de manera descendente por la fecha. 
```php
    public static function all()
    {
        return cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path("posts")))
                ->map(fn($file)=> YamlFrontMatter::parseFile($file))
                ->map(fn ($document) => new Post(
                        $document->title,
                        $document->excerpt,
                        $document->date,
                        $document->body(),
                        $document->slug,
                ))
                ->sortByDesc('date');
        });
    }
```