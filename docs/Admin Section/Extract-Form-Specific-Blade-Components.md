[< Volver al índice](/docs/readme.md)

# Extract Form-Specific Blade Components

En este episodio, renderizaremos el HTML del formulario para crear posts mediante la extracción de métodos reutilizables que se pueden usar para construir cada sección con componentes Blade. 

Primero creamos un nuevo directorio `resources/views/components/form`en el cual vamos partiendo el formulario. 


- Vamos a crear un archivo para un contenedor `field.blade.php`.

    ```html
        <div class="mt-6">
            {{ $slot }}
        </div>
    ```

- Crearemos un archivo para los títulos del formulario `label.blade.php`.

    ```html
        @props(['name'])

        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="{{ $name }}">
            {{ ucwords($name) }}
        </label>
    ```

- Crearemos un archivo para los errores `error.blade.php`, el cual reciba el nombre de nuestro dato.

    ```html
        @props(['name'])

        @error($name)
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
    ```

- Crearemos un archivo para los inputs el cual reciba el nombre y el tipo de este `input.blade.php`. Es importante que estos campos sean obligatorios. 

    ```html
        @props(['name', 'type' => 'text'])

        <x-form.field>
            <x-form.label name="{{ $name }}"/>

            <input class="border border-gray-400 p-2 w-full" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}" required>

            <x-form.error name="{{ $name }}"/>
        </x-form.field>
    ```

- Crearemos un archivo para textos largos como el *body* o el *excerpt*; `textarea.blade.php`.


    ```html
        @props(['name'])

        <x-form.field>
            <x-form.label name="{{ $name }}" />

            <textarea
                class="border border-gray-400 p-2 w-full"
                name="{{ $name }}"
                id="{{ $name }}"
                required
            >{{ old($name) }}</textarea>

            <x-form.error name="{{ $name }}" />
        </x-form.field>
    ```

- Nuestro ultimo archivo de este directorio, será `resources/views/componentes/submit-button.blade.php` que moveremos a la carpeta de *forms* y le cambiaremos el nombre a `button.blade.php`. 

Por tanto, al cambiar nuestro formulario `resources/views/posts/create.blade.php` con componentes Blade, quedaría de la siguiente manera: 

```html
    <x-layout>
        <section class="py-8 max-w-md mx-auto">

            <h1 class="text-lg font-bold mb-4">
                Publish New Post
            </h1>

            <x-panel>
                <form method="POST" action="/admin/posts" enctype="multipart/form-data">
                    @csrf

                        <x-form.input name="title" />
                        <x-form.input name="slug" />
                        <x-form.input name="thumbnail" type="file" />

                        <x-form.textarea name="excerpt" />
                        <x-form.textarea name="body" />

                        <x-form.field>
                            <x-form.label name="category" />
                            <select name="category_id" id="category_id">
                                @foreach (\App\Models\Category::all() as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                                    >{{ ucwords($category->name) }}</option>
                                @endforeach
                            </select>
                            <x-form.error name="category" />
                        </x-form.field>

                        <x-form.button>Publish</x-form.button>

                </form>
            </x-panel>
        </section>
    </x-layout>
```


