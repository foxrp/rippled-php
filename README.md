# XRPHP

[![Build Status](https://travis-ci.org/foxrp/xrphp.svg?branch=master)](https://travis-ci.org/foxrp/xrphp)
[![Coverage Status](https://coveralls.io/repos/github/foxrp/xrphp/badge.svg?branch=master)](https://coveralls.io/github/foxrp/xrphp?branch=master)
[![Latest Stable Version](https://poser.pugx.org/matthiasnoback/badges/v/stable.png)](https://packagist.org/packages/matthiasnoback/badges)
[![Latest Unstable Version](https://poser.pugx.org/matthiasnoback/badges/v/unstable.png)](https://packagist.org/packages/matthiasnoback/badges)

#### Warning: This is under heavy development. It should be usable by early July, 2018.

This is a PHP library for communicating with the XRP Ledger.

In addition wrapping the API, it validates method/transaction parameters normalizes the API responses.

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
composer require foxrp/xrphp
```

## QuickStart

```php
// Instantiate the API Client.
$client = new \XRPHP\Client('https://s1.ripple.com:51234');

// Retrieve account info.
$response = $client->send('account_info', [
    'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn'
]);

// Extract the result into its own associative array variable.
$result = $response->getResult();

// Do something with the account sequence.
$balance = $result['account_data']['Balance'];

...

```

## Documentation

Please see the documentation for information and examples on accessing the API, building transactions, and handling
exceptions.

- [API Requests](docs/API.md)
- [Transactions](docs/Transactions.md)
- [Handling Exceptions](docs/Exceptions.md)

## Unit Testing

Run the unit test suite:

```
make test
```

Run test coverage:

```
make cov
```

Once you run the coverage command, open `tests/coverage/index.html` to view the report.

## Functional Testing

Functional tests run code against a live server. Of course this should be run against a test server.

If you don't already have test accounts, create 2 and note the account id and secret for each.

https://developers.ripple.com/xrp-test-net-faucet.html

The functional test suite loads endpoint and account info from `.env.test`.

If you haven't already, copy `.env.test.dist` to `.env.test` and add your account info.

`FOXRP_ACCT_1_ID` requires `100` XRP for the tests.

Use the following command to run the functional test suite.

```
make testf
```

## Contribute

PRs, New Issues, and Tips are all welcome!

XRP address: `rwSZu5vAgPEdoDpYx9qZtqtHRDcFwCooqw`
