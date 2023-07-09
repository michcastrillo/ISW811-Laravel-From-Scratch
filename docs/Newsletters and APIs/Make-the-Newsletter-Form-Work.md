[< Volver al índice](/docs/readme.md)

# Make the Newsletter Form Work

Ahora que entendemos los conceptos básicos de cómo agregar una dirección de correo electrónico a una lista de Mailchimp, actualizaremos el formulario suscripción en `resources/views/components/layout.blade.php`, haciendo que el método del formulario sea POST para enviar los datos ingresados, además agregamos un mensaje de error en caso de que haya. 

```php
    <form method="POST" action="/newsletter" class="lg:flex text-sm">
        @csrf
        <div class="lg:py-3 lg:px-5 flex items-center">
            <label for="email" class="hidden lg:inline-block">
                <img src="./images/mailbox-icon.svg" alt="mailbox letter">
            </label>

            <input 
                id="email" 
                name="email"
                type="text" 
                placeholder="Your email address"
                class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">

            @error('email')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
        >
            Subscribe
        </button>
    </form>
```

En `routes/web.php` modificamos la ruta en la que habíamos enviado nuestros datos determinados, ahora los haremos de con los datos enviados del formulario de *layout*. 

```php
    Route::post('newsletter', function() {
        request()->validate(['email'=>'required|email']);

        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us12'
        ]);

        try{
            $response = $mailchimp->lists->addListMember('6f0c5f1e34', [
                'email_address'=> request('email'),
                'status'=>"subscribed"
            ]);
        }catch(\Exception $e){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email'=>'This email could not be added to our newsletter list'
            ]);
        }
            

        return redirect('/')
            ->with('success', 'You are now signed up for our newsletter');


    });
```

