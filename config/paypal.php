<?php
return array(

    'client_id' => env('PAYPAL_CLIENT_ID'),

    'secret' => env('PAYPAL_SECRET'),

    'settings' => array(

        'mode' => 'sandbox',

        'http.ConnectionTimeOut' => 30,

        'log.LogEnabled' => false,

        'log.FileName' => storage_path() . '/logs/paypal.log',

        'log.LogLevel' => 'FINE'

    ),
);