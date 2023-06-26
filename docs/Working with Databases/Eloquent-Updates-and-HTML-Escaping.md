[< Volver al índice](/docs/readme.md)

# Eloquent Updates and HTML Escaping 

En esta lección, discutiremos brevemente cómo actualizar los registros de la base de datos usando Eloquent y como agregar etiquetas HTML, para esto debemos ingresar los siguientes comandos. 

```bash 
php artisan tinker;
$post = App\Models\Post;
$post->body;
$post->body = '<p>' . $post->body . '</p>';
$post->save();
```
Esto actualizará el cuerpo de nuestro post con etiquetas HTML, sin embargo si no queremos que estas etiquetas se muestren en la vista debemos hacer lo siguiente para que el contenido de nuestro *body* no se escape, y así evitamos la inserción de código malicioso. 

```bash
 {!! $post->body; !!}
```