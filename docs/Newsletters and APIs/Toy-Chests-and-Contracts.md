[< Volver al índice](/docs/readme.md)

# Toy Chests and Contracts

En este episodio utilizaremos los contenedores de servicios, los proveedores de servicio. En primer lugar, vamos a cambiar el nombre de la clase antes llamada *Newsletter* que ahora será `MailchimpNewsletter`.

Crearemos dos archivos en el directorio `app/Services`, una interfaz `Newsletter.php`. 

```php 
    <?php

    namespace App\Services;

    interface Newsletter
    {
        public function subscribe(string $email, string $list = null);
    }
```

Y `ConvertKitNewsletter.php` el cual suscribe al usuario y realiza las solicitudes API por miedo de él. 

```php 
    <?php

    namespace App\Services;

    class ConvertKitNewsletter implements Newsletter
    {
        public function subscribe(string $email, string $list = null)
        {
            //
        }

    }
```

En `MailchimpNewsletter` implementamos la interfaz a la clase y le creamos un constructor, el cual prepara todas las dependencias necesarias para el API.

```php 
    class MailchimpNewsletter implements Newsletter
    {
        protected ApiClient $client;
        public function __construct(ApiClient $client)
        {
            $this->client = $client;
        }

        public function subscribe(string $email, string $list = null)
        {
            $list ??= config('services.mailchimp.lists.subscribers');

            return $this->client->lists->addListMember($list, [
                'email_address' => $email,
                'status' => 'subscribed'
            ]);
        }
    }
```

En `app/Providers/AppServiceProvider.php` estará nuestra conexión a la API. 

```php 
    use App\Services\Newsletter;
    use App\Services\MailchimpNewsletter;
    use MailchimpMarketing\ApiClient;
```
```php 
    public function register()
    {
        app()->bind(Newsletter::class, function () {
            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us12'
            ]);

            return new MailchimpNewsletter($client);
        });
    }
```
