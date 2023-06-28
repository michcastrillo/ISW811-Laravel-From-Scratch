[< Volver al índice](/docs/readme.md)

# A Small JavaScript Dropdown Detour

A continuación, se hará un menú desplegable "Categorías" en la página de inicio con JavaScript. Primero, demos importar la librería Alpine para darle estilo a nuestra pagina para esto vamos a pegar el siguiente *script* en *resources/views/components/layout.blade.php*.

```html
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
```

Debemos cambiar la sección "category" en *resources/views/_post-header.blade.php* que es donde se encontrará nuestro menú desplegable. Algunos datos a resaltar: 

- Show verifica si se ha clicleado el botón de categorías, si es dado el caso, entonces se muestra elementos que hay dentro del dropdown.
- En el foreach se llaman todas las categorías que tengamos en nuestra base de datos. Y se le dan estilos al posicionarme por encima del elemento. 

```html
        <!--  Category -->
       <div class="relative lg:inline-flex bg-gray-100 rounded-xl">

            <div x-data="{ show: false }" @click.away="show = false">

                <button 
                    @click="show = ! show"
                    class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
                    
                    {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}

                    <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22"
                        height="22" viewBox="0 0 22 22">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z"></path>
                            <path fill="#222"
                                d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                        </g>
                    </svg>
                </button>

                <div x-show="show" class="py-2 absolute bg-gray-100 mt-2 rounded-xl w-full z-50" style="display: none">
                    <a href="/"
                            class="block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white">
                            All</a>
                    @foreach ($categories as $category)
                        <a href="/categories/{{ $category->slug }}"
                            class="block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white
                            {{ isset($currentCategory) && $currentCategory->is($category) ? 'bg-blue-500 hover:text-white focus:text-white' : ''}}">
                            {{ ucwords($category->name) }}</a>
                    @endforeach
                </div>
            </div>
        </div>
```

Luego cambiamos las rutas para que al dirigirnos a una categoría solo aparezcan los posts pertenecientes a ella en *routes/web.php*.

```php
Route::get('/', function () {
    return view('posts', [
        'posts'=> Post::latest()->with(['category', 'author'])->get(),
        'categories' => Category::all()
    ]);
});

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts'=> $category->posts,
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
});

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [
        'posts'=> $author->posts,
        'categories' => Category::all()
    ]);
});
```
![image](./images/Dropdown%20ep34.png "Dropdown")