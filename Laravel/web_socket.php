https://durlavkalita.medium.com/real-time-with-laravel-websockets-c9c4fc88ed1a
------------------------------- CONFIGUR SOCKET --------------------------------
1. composer create-project --prefer-dist laravel/laravel websockets
2. create your database
3. php artisan migrate

4. composer require beyondcode/laravel-websockets
4.1. php artisan vendor:publish 
        --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" 
        --tag="migrations”
4.2. php artisan migrate
4.3. php artisan vendor:publish 
        --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" 
        --tag="config"

5. Edit in .env file 
    BROADCAST_DRIVER=pusher
    PUSHER_APP_ID=local
    PUSHER_APP_KEY=local
    PUSHER_APP_SECRET=local
6. Check is it work??
    php artisan serve // serve localhost
    php artisan websockets:serve // http://localhost:8000/laravel-websockets

----------------------------------------=====================
7. composer require pusher/pusher-php-server
8. Edit --- config/brodcasting.php
        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'host' => '127.0.0.1',
                'port' => 6001,
                'scheme' => 'http'
            ],
        ],
        
----------------------------------------=====================
9. php artisan make:event NewEvent
10. Update your event for testing Like:- 
    class NewEvent implements ShouldBroadcast
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        public $msg;
        public function __construct($msg)
        {
            $this->msg = $msg;
        }
        public function broadcastOn()
        {
            return new Channel('home');
        }

        public function broadcastWith()
        {
            return ["name"=>"sandeep"];
        }
    }
    check is it work?? set route for testing and call it:- 
    Route::get('/abc', function () {

        broadcast(new Hello());
    });
    http://127.0.0.1:8000/abc

----------------------------------------=====================
In order to listen for the events we need laravel-echo. 
Also as we are using pusher for broadcasting we need pusher-js. Let’s install those.

11. npm install --save-dev laravel-echo pusher-js
    
    (configure laravel-echo in resources/js/bootstrap.js)
    
    import Echo from 'laravel-echo';
    window.Pusher = require('pusher-js');
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        forceTLS: false,
        wsHost: window.location.hostname,
        wsPort: 6001,
        disableStats:true
    });
12. npm run dev

13. <script src="{{ asset('js/app.js') }}"></script>
    <script>
    Echo.channel('home').listen('NewEvent', (e) => {
        console.log(e.msg);
    })
    ------------------- OR ---------------------
    window.Echo.channel('home').listen('NewEvent', (e) => {
        console.log(e.msg);
    });
    </script>
