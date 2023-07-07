[< Volver al índice](/docs/readme.md)

# Some Light Chapter Clean Up

Antes de pasar a la siguiente sección, extraeremos un par de componentes de Blade, para refactorizar código, primeramente vamos a crear un componente en `resources/views/posts/_add-comment-form.blade.php` en el cual vamos a poner el panel de comentarios, y vamos agregar un posible error, si el usuario intenta comentar un texto vacío. 

```html
    @auth
        <x-panel>
            <form method="POST" action="/posts/{{ $post->slug }}/comments">
                @csrf

                <header class="flex items-center">
                    <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="40" height="40" class="rounded-full">
                    <h2 class="ml-4">Want to participate?</h2>
                </header>

                <div class="mt-6">
                    <textarea name="body" class="w-full text-sm focus:outline-none focus:ring" rows="5" placeholder="Quick, thing of something to say!" required></textarea>

                    @error('body')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                    <x-submit-button>Post</x-submit-button>
                </div>
            </form>
        </x-panel>
    @else
        <p class="font-semibold">
            <a href="/register" class="hover:underline">Register</a> or
            <a href="/login" class="hover:underline">log in</a> to leave a comment.
        </p>
    @endauth
```

Por tanto, en `resources/views/posts/show.blade.php` solo vamos a llamar el componente:

```php
    <section class="col-span-8 col-start-5 mt-10 space-y-6">
        @include ('posts._add-comment-form')
        @foreach ($post->comments as $comment)
            <x-post-comment :comment="$comment" />
        @endforeach
    </section>
```

Y el componente del botón que se llama en `_add-comment-form.blade.php` se crea en el directorio  `resources/views/components/submit-button.blade.php`, el cual tiene el código del botón del formulario:

```php
    <button type="submit" class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">
        {{ $slot }}
    </button>
```
