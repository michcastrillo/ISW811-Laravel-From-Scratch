[< Volver al índice](/docs/readme.md)

# Eager Load Relationships on an Existing Model

Como se vió en los episodios pasados, N+1 es un problema común en los sistemas.Afortunadamente, Laravel proporciona una forma inteligente de superar los problemas de N+1. Podemos mitigar tales problemas mediante el uso de eager loading, esto significa que solo se utilizará una instrucción SELECT.

Para esto vamos a cargar las relaciones directamente desde el modelo. En nuestro caso se encuentra en *app/models/post.php* la relación category->author. 
```bash
    protected $with = ['category','author'];
```