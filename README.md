# XRPHP - XRP Ledger Library

[![Build Status](https://travis-ci.com/mikemilano/xrphp.svg?branch=master)](https://travis-ci.com/mikemilano/xrphp)
[![Coverage Status](https://coveralls.io/repos/github/mikemilano/xrphp/badge.svg?branch=master)](https://coveralls.io/github/mikemilano/xrphp?branch=master)
[![Latest Stable Version](https://poser.pugx.org/matthiasnoback/badges/v/stable.png)](https://packagist.org/packages/matthiasnoback/badges)
[![Latest Unstable Version](https://poser.pugx.org/matthiasnoback/badges/v/unstable.png)](https://packagist.org/packages/matthiasnoback/badges)

This is a PHP library for communicating with the XRP Ledger.

Refer to the [API Documentation](https://developers.ripple.com/rippled-api.html)
in the [Ripple Developer Portal](https://developers.ripple.com/) for methods, parameters, and expected responses.

## Dependencies

This project implements [PSR-7](https://www.php-fig.org/psr/psr-7/) via the use of
[HTTPLUG](http://docs.php-http.org/en/latest/index.html) so the developer can select the
[HTTP Client](http://docs.php-http.org/en/latest/clients.html) best suited for their
architecture.

If you do not have a preference, simply run the command below and proceed to the
installation section.

```
composer require php-http/guzzle6-adapter php-http/message
```

## Installation

```
composer require mikemilano/xrphp
```

## Instantiating the Client

You can either instantiate the client with a string, or an array.

Create a `Client` object with a uri:
```php
$client = new \XRPHP\Client('https://s1.ripple.com:51234');
```

Create a `Client` object with an array:
```php
$client = new \XRPHP\Client([
    'scheme' => 'https',
    'host' => 's1.ripple.com',
    'port' => 51234
]);
```

## Sending a Request

The [API documentation](https://developers.ripple.com/rippled-api.html)
clearly defines `method` and `params` for each method, along with `JSON-RPC` examples 
and an explanation for each parameter.

Simply pass the `method`, followed by an associative array of 
`params` into the client.

```php
$res = $client->method('account_info', [
    'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn'
])->execute();

if ($res->isSuccess()) {
    $data = $res->getResult();
    // do something with $data
}
```

Catch `InvalidParameterException` for messages specific to missing or invalid parameters.
```php
use XRPHP\Exception\InvalidParameterException;
...
try {
    $res = $client->method('account_info', [
        'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn'
    ])->execute();
} catch (InvalidParameterException $e) {
    $param_error = $e->getMessage();
}
```

Exceptions will be thrown when calling a method with invalid, or missing
parameters are included in a request, at the time the method
is instantiated.

## Response Object

The API provides responses in a JSON format. The `result` property
of the of the JSON object contains the data you are looking for.

XRPHP takes care of the mundane by validating the response received
 from the API, decoding the JSON, and arranging the data in a friendlier
 format.
 
It does this with the `MethodResponse` object, which is returned
when you call `->execute()` on a client method.

### $res->getResult(): 

The `result` property of a response contains the data returned
in in the `result` property of the JSON.

### $res->isSuccess():

The API provides a `status` property which indicates a successful
call when the value is `success`. While it is accessible in
`$res->result['status']`, XRPHP makes this available as a property.

You can check if the response was successful with: `$res->isSuccess()`.

## Payment Transaction Example

```php
$params = [
    'tx_json' => [
        'TransactionType' => 'Payment',
        'Account' => 'rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9',
        'Destination' => 'rnQ1WgToG2RL9Fjmofif9ixYVgJTi6BLas',
        'Amount' => '1000000'
    ],
    'secret' => 'sxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'
];

$res =$client->method('submit', $params)->execute();

print_r($res->getResult());
```

Output from the code above:
```
(
    [engine_result] => tesSUCCESS
    [engine_result_code] => 0
    [engine_result_message] => The transaction was applied. Only final in a validated ledger.
    [status] => success
    [tx_blob] => 120000228000000024000000016140000000000F424068400000000000000A732102F9637154C55935861AF4DF4FF1D0E9A21351D8436DD4C7792356DB2BA55B93E474473045022100E8E2012E2421AAB69E30F96A0FDBD408164F471F6C533DAB207F933C8ABC2716022072496D12ACB698E8C977E23F85923FB2F68667E067C0B650D63B04E4902DBA4E8114FE32962E71441A81FB4FD80EE33E288A84FF5AB0831430643C3E4CCE37DD18F8AE238B7756A8CEC83FC5
    [tx_json] => Array
        (
            [Account] => rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9
            [Amount] => 1000000
            [Destination] => rnQ1WgToG2RL9Fjmofif9ixYVgJTi6BLas
            [Fee] => 10
            [Flags] => 2147483648
            [Sequence] => 1
            [SigningPubKey] => 02F9637154C55935861AF4DF4FF1D0E9A21351D8436DD4C7792356DB2BA55B93E4
            [TransactionType] => Payment
            [TxnSignature] => 3045022100E8E2012E2421AAB69E30F96A0FDBD408164F471F6C533DAB207F933C8ABC2716022072496D12ACB698E8C977E23F85923FB2F68667E067C0B650D63B04E4902DBA4E
            [hash] => 5FFA62DB8A8E630741235B554A9335F938D00A309A0BB1F9714448EAFBDF843B
        )

)
```


## Direct Posting to the API

You can use the following method to access the API. It simply wraps the API without validating
parameters or normalizing the response.

```php
// Instantiate the client.
$client = new \XRPHP\Client('https://s1.ripple.com:51234');

// Retrieve the info.
$res = $client->post('account_info', ['account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn']);
```

Response data is the result of `json_decode($json, true)`, so the entire structure
has been converted to an associative array.

Output of `print_r($res)`:
```
(
    [result] => Array
        (
            [account_data] => Array
                (
                    [Account] => rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn
                    [Balance] => 6
                    [Flags] => 65536
                    [LedgerEntryType] => AccountRoot
                    [OwnerCount] => 0
                    [PreviousTxnID] => E9A2BAA7B310BA3C52FDFBDEC404D1339E7547E8CD769D6CD40AD0EFABF337F8
                    [PreviousTxnLgrSeq] => 36405347
                    [RegularKey] => rU4DpLWAzs3ECf8SVkeJGeLt9KBRGhxpQg
                    [Sequence] => 192218
                    [index] => 92FA6A9FC8EA6018D5D16532D7795C91BFB0831355BDFDA177E86C8BF997985F
                )

            [ledger_current_index] => 38726789
            [queue_data] => Array
                (
                    [txn_count] => 0
                )

            [status] => success
            [validated] => 
        )
)
```

## Testing

As of now, only unit tests exists which mock the API so requests are not actually made.

Run the test suite:

```
make test
```

Run test coverage:

```
make cov
```

Once you run the coverage command, open `tests/coverage/index.html` to view the report.

## Contribute

PRs, New Issues, and Tips are all welcome!

XRP address: `rwSZu5vAgPEdoDpYx9qZtqtHRDcFwCooqw`
