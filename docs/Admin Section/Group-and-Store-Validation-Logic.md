[< Volver al índice](/docs/readme.md)

# Group and Store Validation Logic

En `app/Http/Controllers/AdminPostController.php` hay una lógica de validación duplicada, la extraeremos y la convertiremos en un método reutilizable. 

La función para crear los posts quedaría de esta manera en la cual enlazamos los usuarios e imágenes con el post. 
```php
    public function store()
    {
        Post::create(array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/');
    }
```

La función para actualizar verificaremos si el usuario ingresa una imagen, y actualizamos. 

```php
    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

```

*ValidatePost()* será nuestro método reutilizable para verificar los datos ingresados por el usuario. 

```php
    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
```

