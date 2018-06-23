# Working with the API

This document covers using the [Client](../src/Client.php) class to communicate with the remote API.

Technically you can use the `Transaction` API methods, however this library provides a 
[Transaction](../src/Api/Transaction.php) class to make them much easier to work with.

See the [Transactions Documentation](Transactions.md) for more on Transactions.


## Instantiating the API Client

You can either instantiate the client with a string, or an array.

Create a `Client` object with a uri:
```php
<?php

use FOXRP\Rippled\Client;

$client = new Client('https://s1.ripple.com:51234');
```

Create a `Client` object with an array:
```php
<?php

use FOXRP\Rippled\Client;

$client = new Client([
    'scheme' => 'https',
    'host' => 's1.ripple.com',
    'port' => 51234
]);
```

## Sending Requests

The [API documentation](https://developers.ripple.com/rippled-api.html) clearly defines method name and supported 
parameters, along with `JSON-RPC` examples for request and responses.

Use the documentation to craft your parameters and pass them in as an associative array.

```php
<?php
use FOXRP\Rippled\Client;

$client = new Client('https://s1.ripple.com:51234');

$response = $client->send('account_info', [
    'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn'
]);

if ($response->isSuccess()) {
    // getResult() returns the associative array defined as the result in the API documentation.
    $data = $response->getResult();
}
```

## Other Ways to Send Requests

If you need more control, you may create requests separately.


Example: Retrieve a request object from the Client.
```php
<?php

use FOXRP\Rippled\Client;

$client = new Client('https://s1.ripple.com:51234');

$request = $client->request('account_info', [
    'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn'
]);

// Now send the request to retrieve a response.
$response = $request->send();
```

```php
<?php

use FOXRP\Rippled\Api\Request;
use FOXRP\Rippled\Client;

$client = new Client('https://s1.ripple.com:51234');

// Or instantiate Request directly.
$request = new Request('account_info', [
   'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn'
], $client);

// Now send the request to retrieve a response.
$response = $request->send();
```

## Exception Handling

Catch `InvalidParameterException` for messages specific to missing or invalid parameters.
```php
<?php

use FOXRP\Rippled\Client;
use FOXRP\Rippled\Exception\InvalidParameterException;
use FOXRP\Rippled\Exception\ResponseErrorException;

$client = new Client('https://s1.ripple.com:51234');

$balance = null;

try {
    $response = $client->send('account_info', [
        'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn'
    ]);
    
    // Set balance if successful.
    if ($response->isSuccess()) {
        $data = $response->getResult();
        $balance = $data['account_data']['Balance'];
    }
    
} catch (InvalidParameterException $e) {
    // Catch validation errors that occur before the request is sent.
    // i.e. missing required params, unrecognized params, etc.
    $error = $e->getMessage();
} catch (ResponseErrorException $e) {
    // Catch errors sent back from the API.
    $error = $e->getMessage();
}
```

`InvalidParameterException` is thrown when the library detects an issue with the parameters, before sending the request
to the server. This includes errors such as:
- Require parameters that are missing
- Unrecognized parameters
- Range issues such as when a value exceeds the maximum allowed

`ResponseErrorException` is thrown after the request is sent, as part of the response from the server. These errors may
include [Universal Errors](https://developers.ripple.com/error-formatting.html#universal-errors) or errors which are
method specific.

## The Response Object

The library converts the raw response into a `FOXRP/Rippled/Api/Response` object with the following process.

- Parses JSON
- Sets the `success` property. i.e. `$response->isSuccess()`
- Adds error info and throws exception when the API call is not successful
- Adds the successful result to the `result` property. i.e. `$response->getResult()`

```php
<?php



```

## Direct Posting to the API

You can use the following method to access the API. It simply wraps the API without validating
parameters or normalizing the response.

```php
// Instantiate the client.
$client = new \FOXRP\Rippled\Client('https://s1.ripple.com:51234');

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
