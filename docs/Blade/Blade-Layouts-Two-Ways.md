[< Volver al índice](/docs/readme.md)

# Blade Layouts Two Ways
El siguiente problema que debemos resolver se relaciona con el hecho de que cada una de nuestras vistas contiene la estructura HTML completa. En su lugar, podemos buscar archivos de diseño para reducir la duplicación. 

Primero debemos crear una carpeta *Components* y un archivo *layout.blade.php* en el directorio de *resources/views*. Y colocamos el contenido del layout, el cual funcionará como una plantilla para los demás archivos.

![image](./images/component%20file%20and%20layout.png "layout")

En este caso el que utilizará esta plantilla será *posts.blade.php* del directorio Resources/Views. El cual es un archivo Blade heredando de un archivo de diseño (layout).
```php
    <x-layout>
        @foreach ($posts as $post)
        <article>
            <h1>
                <a href="/posts/{{$post->slug; }}">
                    {{ $post->title; }}
                </a>
            </h1>
        
            <div>
                {{ $post->excerpt; }}
            </div>
        </article>
        @endforeach
    </x-layout>
```