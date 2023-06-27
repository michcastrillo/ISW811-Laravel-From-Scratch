[< Volver al índice](/docs/readme.md)

# How a Route Loads a View
A continuación se muestra como se manejan las rutas asociadas a una URL en Laravel, en nuestro caso se manejan en el directorio *routes/web.php*

 ```php
   Route::get('/', function () {
    return view('welcome');
});
```
Si una ruta que no esta especificada o se escribe un endpoint incorrecto se da un error 404, lo que significa que el enlace no esta habilitado. 

![image](./images/error%20404.png "without a route")

Es importante mencionar que las rutas pueden retornar un JSON, una vista HTML, un texto, entre otros. En este caso, nuestro endpoint es /example y retorna un JSON. 

 ```php
   Route::get('/example', function () {
    return [['id'=>' 0 ','name' =>'ashley'],['id'=>' 1','name' =>'michelle']]; 

});
```
![image](./images/example%20route%20json.png "json file")