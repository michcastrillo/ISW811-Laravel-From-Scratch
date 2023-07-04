[< Volver al índice](/docs/readme.md)

# Fix a Confusing Eloquent Query Bug

Tenemos un error en nuestro filtro ya que al ingresar una palabra en nuestro input de categoría lo busca, mas, si lo queremos filtrar por categoría aun siguen apareciendo todos aquellos post que coincidan con la palabra de búsqueda sin importar la categoría, por tanto esto se soluciona en nuestro *query* en `app/Models/Post.php` para que se consideran nuestras dos condiciones y no solo una. 

```php
    $query->when($filters['search'] ?? false, fn($query, $search) =>
        $query->where(fn($query)=> 
            $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%')
        )
    );
```

Con esto nuestro filtro de categorías y búsquedas esta correctamente implementado. 