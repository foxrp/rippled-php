Exceptions
==========

All exceptions extend from [RippledException](../src/Exception/RippledException.php), which extends from PHP's base
Exception.

If you're not interested in exactly what exception is being thrown, add a single catch for `RippledException`.

On the other hand, there are several other exceptions so you may elegantly handle them separately.

## API Example

The most likely exceptions you may be interested in catching and forwarding the message for are the 
`InvalidParameterException` and the `ResponseErrorException` as these may be due to invalid user input.

Other exceptions thrown are most likely an indication of a developer error, or an issue communicating with the remote
rippled server.

In this example, the 2 exceptions above are caught, with a catch-all of `RippledException` which covers everything else.

```php
<?php

use FOXRP\Rippled\Client;
use FOXRP\Rippled\Exception\InvalidParameterException;
use FOXRP\Rippled\Exception\ResponseErrorException;
use FOXRP\Rippled\Exception\RippledException;

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
} catch (RippledException $e) {
    // Catch all other exceptions which may be thrown by the library.
    $error = $e->getMessage();
}
```

You can find a list of all exceptions in [src/Exception](../src/Exception/RippledException.php).
