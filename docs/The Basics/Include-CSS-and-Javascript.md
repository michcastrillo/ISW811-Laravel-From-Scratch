[< Volver al índice](/docs/readme.md)

# Include CSS and Javascript

En este episodio se muestra como incluir js(funcionalidad) y css (estilos) al HTML.
 ```php
<!DOCTYPE html>
<title>My blog</title>
<link rel="stylesheet" href="/app.css">
<script src="/app.js"></script>
<body>
    <h1>Hello world</h1>
</body>
```
Se creó un archivo app.css en la carpeta public, dandole estilo al cuerpo del html. , Es importante destacar que todos los archivos tipo css o js van en la carpeta public para un mejor enrutamiento de Laravel. 
 ```css
body{
    background: navy;
    color: white;
}
```
![image](./images/hello%20world.png "css added")

Se creó un archivo app.js en la carpeta public para darle una pequeña funcionalidad a la página, en este caso una ventana emergente.  
```js
alert('Im here');
```
![image](./images/alert.png "js added")