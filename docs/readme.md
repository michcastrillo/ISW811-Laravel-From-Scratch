## Curso de Laravel from Scratch

# Modulo 2 - Episodio 5 - How a Route Loads a View
A continuación se muestra como se manejan las rutas asociadas a una URL en Laravel: 
 ```php
   Route::get('/', function () {
    return view('welcome');
});
```
Si una ruta que no esta especificada o un se escribe un endpoint incorrecto se da un error 404, lo que significa que el enlace no esta habilitado. 
![image](./images/without%20route.png "without a route")
Es importante mencionar que las rutas pueden retornar un json, una vista HTML, un texto, entre otros. En este caso, nuestro endpoint es /example. 
 ```php
   Route::get('/example', function () {
    return [['id'=>' 0 ','name' =>'ashley'],['id'=>' 1','name' =>'michelle']]; 

});
```
![image](./images/example%20route%20json.png "json file")
