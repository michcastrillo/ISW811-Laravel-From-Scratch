[< Volver al índice](/docs/readme.md)

# Blade Components and CSS Grids

A continuación, se ingresarán grids al diseño de la pagina. Pero primero vamos a agregar todas las configuraciones que ya habíamos hecho sobre post, por tanto solo van a salir datos de nuestra base de datos. 

- Directorio: *resources/views/components/post-card.blade.php*.

```html
    @props(['post'])
    <article {{$attributes->
        merge(['class'=>'transition-colors duration-300 hover:bg-gray-100 border
        border-black border-opacity-0 hover:border-opacity-5 rounded-xl'])}}>
        <div class="py-6 px-5">
            <div>
                <img
                    src="/images/illustration-3.png"
                    alt="Blog Post illustration"
                    class="rounded-xl"
                />
            </div>

            <div class="mt-8 flex flex-col justify-between">
                <header>
                    <div class="space-x-2">
                        <a
                            href="/categories/{{$post->category->slug}}"
                            class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                            style="font-size: 10px"
                            >{{ $post->category->name}}</a
                        >
                    </div>

                    <div class="mt-4">
                        <h1 class="text-3xl">
                            <a href="/posts/{{$post->slug}}"> {{$post->title}} </a>
                        </h1>

                        <span class="mt-2 block text-gray-400 text-xs">
                            Published <time>1 day ago</time>
                        </span>
                    </div>
                </header>

                <div class="text-sm mt-4">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                        do eiusmod tempor incididunt ut labore et dolore magna
                        aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                        ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>

                    <p class="mt-4">
                        Duis aute irure dolor in reprehenderit in voluptate velit
                        esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                </div>

                <footer class="flex justify-between items-center mt-8">
                    <div class="flex items-center text-sm">
                        <img src="/images/lary-avatar.svg" alt="Lary avatar" />
                        <div class="ml-3">
                            <h5 class="font-bold">Lary Laracore</h5>
                            <h6>Mascot at Laracasts</h6>
                        </div>
                    </div>

                    <div>
                        <a
                            href="#"
                            class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                            >Read More</a
                        >
                    </div>
                </footer>
            </div>
        </div>
    </article>
```
- Directorio: *resources/views/components/post-featured.blade.php*.

```html
    @props(['post'])
    <article
        class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl"
    >
        <div class="py-6 px-5 lg:flex">
            <div class="flex-1 lg:mr-8">
                <img
                    src="/images/illustration-1.png"
                    alt="Blog Post illustration"
                    class="rounded-xl"
                />
            </div>

            <div class="flex-1 flex flex-col justify-between">
                <header class="mt-8 lg:mt-0">
                    <div class="space-x-2">
                        <a
                            href="/categories/{{$post->category->slug}}"
                            class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                            style="font-size: 10px"
                            >{{$post->category->name}}</a
                        >
                    </div>

                    <div class="mt-4">
                        <h1 class="text-3xl">
                            <a href="/posts/{{$post->slug}}">
                                {{ $post->title }}
                            </a>
                        </h1>

                        <span class="mt-2 block text-gray-400 text-xs">
                            Published
                            <time>{{$post->created_at->diffForHumans()}}</time>
                        </span>
                    </div>
                </header>

                <div class="text-sm mt-2">
                    <p>{{$post->excerpt}}</p>
                </div>

                <footer class="flex justify-between items-center mt-8">
                    <div class="flex items-center text-sm">
                        <img src="/images/lary-avatar.svg" alt="Lary avatar" />
                        <div class="ml-3">
                            <h5 class="font-bold">{{$post->author->name}}</h5>
                            <h6>Mascot at Laracasts</h6>
                        </div>
                    </div>

                    <div class="hidden lg:block">
                        <a
                            href="/posts/{{$post->slug}}"
                            class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                            >Read More</a
                        >
                    </div>
                </footer>
            </div>
        </div>
    </article>
```
Ahora ya realizadas las configuraciones, de agregar los datos de los post, crearemos un archivo en *resources/views/components* llamado *posts-grid.blade.php* el cual acomodará los posts en columnas.

```php
    @props(['posts'])

    <x-post-featured-card :post="$posts[0]" />

    @if ($posts->count() > 1)
    <div class="lg:grid lg:grid-cols-6">
        @foreach ($posts->skip(1) as $post)
        <x-post-card
            :post="$post"
            class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}"
        />
        @endforeach
    </div>
    @endif
```
Por ultimo, en *resources/views/posts.blade.php* verifica existen posts.

```php
<x-layout>
    @include('_posts-header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count())
            <x-posts-grid :posts="$posts" />
        @else
            <p class="text-center">Not posts yet. Please check back later.</p>
        @endif
    </main>
</x-layout>
```
![image](./images/grid%20on%20web.png "Grid on web")