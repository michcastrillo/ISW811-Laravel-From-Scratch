[< Volver al índice](/docs/readme.md)

# Merge Category and Search Queries

Vamos a actualizar el código del menú de de categorías y el input de búsqueda para que al buscar una categoría no se elimine la búsqueda que ya habíamos hecho y viceversa. Para esto vamos a cambiar el código `resources/views/posts/_header.blade.php` en la sección search verificamos si tenemos una solicitud del menu desplegable se oculta el método. 

```html
    <!-- Search -->
    <div
        class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2"
    >
        <form method="GET" action="/">
            @if (request('category'))
            <input
                type="hidden"
                name="category"
                value="{{ request('category') }}"
            />
            @endif
            <input
                type="text"
                name="search"
                placeholder="Find something"
                class="bg-transparent placeholder-black font-semibold text-sm"
                value="{{ request('search') }}"
            />
        </form>
    </div>
```

Luego en `resources/views/components/category-dropdown.blade.php` en nuestro menú desplegable. Se utiliza http_build_query() para construir una cadena de consulta con respecto a los parámetros de la solicitudes actuales, con excepción de 'category' y 'page'.

```php
    @foreach ($categories as $category)
        <x-dropdown-item
            href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"
            :active='request()->is("categories/{$category->slug}")'
            >{{ ucwords($category->name) }}
        </x-dropdown-item>
    @endforeach
```

De esta manera los parámetros se mantienen al hacer búsquedas de categorías o palabras. 