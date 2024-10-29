<?php
/*
    - Events in Laravel are a way to implement the event-driven programming paradigm, 
    where actions and communication between different components of your application are orchestrated through events and event listeners. 
    Events act as hooks/trigger.

# Events and Listeners
    app/Events/Event1.php, Event2.php
    app/Listeners/Listener1.php, Listener2.php, Listener5.php

# Register Event and Listener
    app/Providers/EventServiceProvider.php
    {
        protected $listen = [
                Event1::class => [
                    Listener1::class,
                    Listener2::class
                ],
                Event2::class => [
                    Listener5::class,
                    Listener2::class
                ],
        ];
    }


    Flow:- 
    1. Use event and pass data

    event( new Event1( $data ) );

    Event1::__cunstructor( $data ) 

    Listener1::handle( Event1 $event ){
        $x = $event→data;
        ( Do what ever you want with this data, like store in table, throw email )
    }
        
*/