# XRPHP - XRP Ledger Library

This is a PHP 7.1+ wrapper for communication with the rippled (XRP Ledger) API.

The intention is to provide PHP developers with an easy way to interact/explore
with the [rippled API](https://developers.ripple.com/rippled-api.html).

The [Ripple Developer Portal](https://developers.ripple.com/) is a great resource
to use along side this project to study basic and advanced concepts of the XRP ledger.

## Dependencies

This project uses [HTTPLUG](http://docs.php-http.org/en/latest/index.html) which builds
on top of [PSR-7](https://www.php-fig.org/psr/psr-7/) so the developer can select the
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

## Instantiating With Connection Data

You can either instantiate the client with a string, or an array.

Create a `Client` object with a uri:
```
$client = new \XRPHP\Connection('https://s1.ripple.com:51234');
```

Create a `Client` object with an array:
```
$client = new \XRPHP\Connection([
    'scheme' => 'https',
    'host' => 's1.ripple.com',
    'port' => 51234
]);
```

## Sending Commands

These example calls the `account_info` command. You can see a full
list of commands available in the [rippled api](https://developers.ripple.com/rippled-api.html)
documentation.

### Simple API Communication

A convenient way to test the API is to use the `post()` method of a `Client` object.

```
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

## Development Plan

Phases 1 through 3 apply to the public API only.

- [x] Phase 1: Provide an API wrapper which returns the raw data. (`$client->post('method', $params)`)
- [ ] Phase 2: Provide classes for each section with methods which take arguments, instead of a `$params` array.
- [ ] Phase 3: Model data objects, such as accounts and transactions, and integrate them into the method arguments and returned data.
- [ ] Phase 4: Provide support for the Administrative API.

## Phase 2 Development Status

Note: This just applies to Phase 2 architecture. You can call any method with 
`$client->post('method_name', $params)`.

- account
  - [x] channels
  - [x] currencies
  - [x] info
  - [x] lines
  - [x] objects
  - [x] offers
  - [x] tx
  - [x] gatewayBalances
  - [x] norippleCheck
- ledger
  - [ ] ledger
  - [ ] closed
  - [ ] current
  - [ ] data
  - [ ] entry
- transaction
  - [ ] sign
  - [ ] signFor
  - [ ] submit
  - [ ] submitMultisigned
  - [ ] entry
  - [ ] tx
  - [ ] txHistory
- path
  - [ ] find
  - [ ] rippleFind
- book
  - [ ] offers
- channel
  - [ ] authorize
  - [ ] verify
- subscription
  - [ ] subscribe
  - [ ] unsubscribe
- server
  - [ ] fee
  - [ ] info
  - [ ] state
- util
  - [ ] json
  - [ ] ping
  - [ ] random

## Contribute

PRs, New Issues, and Tips are all welcome!

XRP address: `rwSZu5vAgPEdoDpYx9qZtqtHRDcFwCooqw`
