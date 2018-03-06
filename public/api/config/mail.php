<?php
return [
    
    'username' => env('6c169aac-d64d-4a92-9b26-cb36159e1ca4'),
    'password' => env('6c169aac-d64d-4a92-9b26-cb36159e1ca4'),
    
    'host' => env('MAIL_HOST', 'smtp.postmarkapp.com'),
    
    // Optionally, set "smtp" to "log" if you want to trap emails during testing.
    'driver' => env('MAIL_DRIVER', 'smtp'), 
    
    'port' => env('MAIL_PORT', 587),
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    
    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all e-mails sent by your application to be sent from
    | the same address. Here, you may specify a name and address that is
    | used globally for all e-mails that are sent by your application.
    |
    | It is also OK to not set this from address here and specify it on each message.
    |
    | Remember, when using Postmark, the sending address must be a valid 
    | Sender Signature that you have already configured.
    */
    'from' => ['address' => null, 'name' => null],
];