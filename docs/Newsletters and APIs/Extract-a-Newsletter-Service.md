[< Volver al índice](/docs/readme.md)

# Extract a Newsletter Service

Ya que tenemos nuestro formulario de suscripción de forma dinámica, debemos renderizar el código. En primer lugar, vamos a poner el id de la lista de suscripciones de Mailchimp en el `.env`.

```bash
    MAILCHIMP_LIST_SUBSCRIBERS=6f0c5f1e34
```

Luego, vamos a crear una clase en el nuevo directorio `app/Services/Newsletter.php`, en el cual haremos dos métodos, *subscribe()*, que se extrae el id de la lista de MailChimp del *.env*, y agrega el usuario. El otro método *client()*, es un método conexión, extraemos del *.env* en el cual obtenemos la clave API, y también agregamos nuestro servidor. 

```php
    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers'); //id de lista

        return $this->client()->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

    protected function client()
    {
        return (new ApiClient())->setConfig([
            'apiKey' => config('services.mailchimp.key'),//método de extracción 
            'server' => 'us12'
        ]);
    }
```

Las rutas deben ser cortas y precisas, y todo funcionalidad de código deber+ia de ir en los controladores, en relación a esto, crearemos un controlador para newsletter con el siguiente comando:

```bash
    php artisan make:controller NewsletterController
```

Esto creará un controlador en la ruta `app/Http/Controllers/NewsletterController.php` en la cual tenemos un método *invoke*, el cual se utiliza cuando solo hay un método en el controlador, validamos que haya un correo electrónico, enviamos los datos a la clase newsletter si los datos son correctos. sino se retorna un error, en caso de que la suscripción del usuario sea exitoso se le retorna un mensaje de éxito. 

```php
    public function __invoke(Newsletter $newsletter) 
    {
        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')
            ->with('success', 'You are now signed up for our newsletter!');
    }
```

Ya que hemos renderizado nuestro código, nuestra ruta en `routes/web.php` quedaría de la siguiente manera: 

```php
    use App\Http\Controllers\NewsletterController;
```
```php
    Route::post('newsletter', NewsletterController::class);
```