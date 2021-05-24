<?php

return [
    'rabbit' => [
        'request' => env('RABBIT_REQUEST_QUEUE', 'request_server'),
        'mail' => env('RABBIT_MAIL_QUEUE', 'sender'),
        'sms' => env('RABBIT_SMS_QUEUE', 'sender'),
    ],
];
