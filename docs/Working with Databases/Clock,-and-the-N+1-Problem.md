[< Volver al índice](/docs/readme.md)

# Clockwork, and the N+1 Problem

Había un problema de rendimiento en el último episodio que se conoce como el problema N+1, esto se debe a la carga diferida de Laravel, esto significa que potencialmente puede caer en una trampa en la que se ejecuta una consulta SQL adicional para cada elemento dentro de un bucle. Por ejemplo. si agregamos el siguiente endpoint a *routes/web.php*.

```php
Route::get('/', function () {
    \Illuminate\Support\Facades\DB::listen(function ($query){
        logger($query->sql);
    });

    return view('posts', [
        'posts'=> Post::all()
    ]);
});
```
Entonces, al cargar la página se hará una consulta por cada elemento que tengamos al depurarlas, y esto no es tan factible. Los logs aparecen en el siguiente directorio: *storage/logs*.
![image](./images/laravel%20logs%20ep26.png "Laravel logs")

Por tanto lo que utilizaremos es la dependecia de ClockWork y su extensión ya sea en [Chrome](https://chrome.google.com/webstore/detail/clockwork/dmggabnehkmmfmdffgajcflpdjlnoemp) o [Firefox](https://addons.mozilla.org/en-US/firefox/addon/clockwork-dev-tools/).

```bash
    composer require itsgoingd/clockwork
```
Para finalizar, se puede solucionar el problema N+1 al cargar las relaciones necesarias de forma eficiente, reduciendo el número de consultas en la base de datos en el directorio *routes/web.php*. 
```php
Route::get('/', function () {
    return view('posts', [
        'posts'=> Post::with('category')->get()
    ]);
});
```
Si todo salió correctamente, se observará la opción llamada "Clockwork" en las herramientas de desarrollo del navegador.

![image](./images/clockwork%20ep26.png "Clockwork")