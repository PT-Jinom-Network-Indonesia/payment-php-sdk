# Jinom Payment API Utils

## Installation

```bash
composer require jinomdeveloper/payment-php-sdk
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