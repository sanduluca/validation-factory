<?php

use GGBear\Validation\ValidatorFactory;
use Illuminate\Validation\Factory;

require_once __DIR__ . '\..\vendor\autoload.php';



/** @var Factory */
$validatorFactory = new ValidatorFactory();

$msisdn = '123456789012a';
$serviceId = 123;
$channel = null;
$input = [
    'msisdn' => $msisdn,
    'service_id' => $serviceId,
    'channel' => $channel
];
$rules = [
    'msisdn' => 'required|integer|digits_between:11,12',
    'service_id' => 'required|integer',
    'channel' => 'required|string',
];

$validator = $validatorFactory->make($input, $rules);
if ($validator->fails()) {
    print_r($validator->errors()->toArray());
} else {
    echo 'Validaton passed.' . PHP_EOL;
}
