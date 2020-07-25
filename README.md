# Validation

Standalone library to use Illuminate\\Validation package outside the Laravel framework.


## Install Validation:
- execute  
```bash
composer require ggbear/validation
```
## Usage
```php

require_once __DIR__ . '\..\vendor\autoload.php';
/** @var Factory $validatorFactory */
$validatorFactory = new ValidatorFactory();

$number = '123456789012a';
$id = 123;
$string = 'string value';
$channel = 'UNKNOWN';

$input = [
    'number' => $number,
    'id' => $id,
    'string' => $string,
    'channel' => $channel
];
$rules = [
    'number' => 'required|integer|digits_between:11,12',
    'id' => 'required|integer',
    'string' => 'required|string',
    'channel' => 'required|string|in:WEB,API,SOCKET',
];
$validator = $validatorFactory->make($input, $rules);
```
This will return an instance of `Illuminate\Validation\Validator::class`.

<br>
<br>

```php
if ($validator->fails()) {
    print_r($validator->errors()->toArray());
} else {
    echo 'Validaton passed.' . PHP_EOL;
}
```
You can learn more about the *Laravel Validator* in the [official documentation website](https://laravel.com/docs/7.x/validation).

### About validation rules
- https://laravel.com/docs/7.x/validation#available-validation-rules

### 