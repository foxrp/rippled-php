# XRPHP

[![Build Status](https://travis-ci.com/foxrp/xrphp.svg?branch=master)](https://travis-ci.com/foxrp/xrphp)
[![Coverage Status](https://coveralls.io/repos/github/foxrp/xrphp/badge.svg?branch=master)](https://coveralls.io/github/foxrp/xrphp?branch=master)
[![Latest Stable Version](https://poser.pugx.org/matthiasnoback/badges/v/stable.png)](https://packagist.org/packages/matthiasnoback/badges)
[![Latest Unstable Version](https://poser.pugx.org/matthiasnoback/badges/v/unstable.png)](https://packagist.org/packages/matthiasnoback/badges)

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
composer require mikemilano/xrphp
```

## QuickStart

```php
// Instantiate the API Client.
$client = new \XRPHP\Client('https://s1.ripple.com:51234');

// Retrieve account info.
$response = $client->method('account_info', ['account' => ''])->execute();

// Extract the result into its own associative array variable.
$result = $response->getResult();

// Do something with the account sequence.
$sequence = $result['account_data']['Sequence'];

...

```

## Documentation

Please see the documentation for information and examples on accessing the API, building transactions, and handling
exceptions.

- [Using the API Client](docs/API.md)
- [Building, Signing, and Submitting Transactions](docs/Transactions.md)
- [Handling Exceptions](docs/Exceptions.md)

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
