# Jinom Payment API Utils

## Installation

```bash
composer require jinomdeveloper/payment-php-sdk
```

## Environment

U can set ``SERVER_KEY`` and Is it Production to ``JinomPayment`` class

example

```php
$jinom_payment = new \Jinom\Payment\JinomPayment('YOUR SERVER_KEY', 'IS PRODUCTION');
```

or

if you using ``Laravel`` please use this config and save it as ``jinompay.php``

```php
<?php

return [

    "server_key" => env("JINOM_PAYMENT_KEY", ""),

    "is_production" => env("JINOM_PAYMENT_IS_PRODUCTION", false),

    "base_url" => env("JINOM_PAYMENT_IS_PRODUCTION", false) ? "https://payment.jinom.net" : "https://va.sandbox.jinom.net",
];  
```

don't forget to add it to the ``.env``.

```
JINOM_PAYMENT_KEY=
JINOM_PAYMENT_IS_PRODUCTION=
JINOM_PAYMENT_IS_PRODUCTION=
```

### Implement the configuration

```php
$jinom_payment = new \Jinom\Payment\JinomPayment(config('jinompay.server_key'), config('jinompay.is_production'));
```


## Usage

```php
<?php
...
use Jinom\Payment\JinomPayment;
use Jinom\Payment\Transaction;
... 

class TransactionController extends Controller {
  ...
  public function topUp(Request $request)
  {
      $nominal = 350000;
      $jinom_payment = new JinomPayment('YOUR SERVER_KEY', 'IS PRODUCTION');

      // Automatic Generate Order ID with Time combination
      $order_id = $jinom_payment->generate_order_id("TOPUP"); 

      $transaction = new Transaction();
      $transaction->setTransactionDetails(
          $transaction->createTransactionDetail($order_id, $nominal)
      );

      $transaction->setCustomerDetails($transaction->createCustomerDetail("John Doe", "john@doe.com", "083119030777"));

      $items = [];

      // Item name, price, quantity
      $items[] = $transaction->createItemDetail("Apple", 350000, 1);

      $transaction->setItemDetails($items);

      $charge = $jinom_payment->charge($transaction, [
          'payment_type' => 'bank_transfer',
          'bank_transfer' => [
            'bank' => 'bri', // required |  It can be bri, bni, bca
            'va_number' => '88888888' // optional
          ]
      ]);

      return response()->json([
          'charge' => $charge
      ]);
  }
}

...

```