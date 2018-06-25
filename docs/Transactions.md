# Transactions

You will want to work closely with the 
[Transaction Formats Documentation](https://developers.ripple.com/transaction-formats.html) when building Transactions. 
Each [Transaction Type](https://developers.ripple.com/transaction-types.html) is defined there along with `required` and
auto-fillable` fields.

Transactions can be submitted as any other [API](API.md) method, however the [Transaction](../src/Api/Transaction.php) class
provides additional utility for building and submitting transactions including:

- Validation of required Transaction parameters
- Transaction specific error handling
- Local signing via FoXRP's [xrpsign-cli](https://github.com/foxrp/xrpsign-cli) project
- Auto sequencing for locally signed transactions

## Local Signing Dependency

The XRP Ledger API has methods to [Sign](https://developers.ripple.com/sign.html) or 
[Sign-and-Submit](https://developers.ripple.com/submit.html) however that requires submitting secrets (Regular Keys)
over the internet.

There's currently no native PHP solution for local signing, so we chose to build a nodejs executable which PHP executes.

As of now, [npm](https://www.npmjs.com/) is a dependency if local signing is required.

Install the utility with the command below:

```
npm install -g xrpsign-cli
```

Once installed properly, a `xrpsign` command will be available on the system which takes 2 parameters; A JSON
representation of a transaction, and the source account secret. i.e. `xrpsign '{"TransactionType":"Payment"...' 'sxxxxxxxxx...'`

If anyone is interested in helping with a native PHP 7 solution for local signing, please let us know!


## Building a Transaction

Building a transaction is as simple as defining transaction parameters in an associative array, then instantiating
a `Transaction` object.

If you are going to be submitting a transaction, instantiate the Transaction object by passing a `Client` object in
addition to the parameters. The `Client` object however is not required if you are just building, and not submitting
a transaction.

```php
$client = new \FOXRP\Rippled\Client('https://s1.ripple.com:51234');

$txParams = [
    'TransactionType' => 'Payment',
    'Account' => 'rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9',
    'Destination' => 'rnQ1WgToG2RL9Fjmofif9ixYVgJTi6BLas',
    'Amount' => '1000000',
    'Fee' => '000012'
];

$transaction = new \FOXRP\Rippled\Api\Transaction($txParams, $client);
```

## Submitting a Transaction

Building on from the examples above, it is now time to submit a transaction.

By default, the second argument to submit, `signLocal`, is set to true.

### Sign local and submit

Note: `xrpsign-cli` is required for local signing.

```php
$secret = 'sxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$response = $transaction->submit($secret);
```

### Submit to sign remotely

```php
$secret = 'sxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$response = $transaction->submit($secret, false);
```

## Submitted Transaction Response

If successful, `$response->getResult()` will contain something similar to the output below:

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

## Signing Transactions before Submitting (Optional)

As a precaution to avoid unintentional remote signing, local signing must be performed in this separate step.

Remote signing can be achieved either separately, or along with the `submit` method.
 
Taking the above section as a starting point, locally signing a transaction is done with one more call.

### Locally Signing

This is just an example in case you needed to sign in a separate step.
 
You typically won't need this step as it will be attempted with the `submit()` method. See "Submitting a Transaction"
above.

```php
$secret = 'sxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$transaction->signLocal($secret);

// Access the signed transaction data if needed.
$txData = $transaction->getTx();
```

Remember, for local signing, the NPM package `xrpsign-cli` must be installed and available in the system path.

Note the [API documentation](https://developers.ripple.com/transaction-common-fields.html#auto-fillable-fields) states 
that `auto-fillable` parameters must be set before a transaction can be signed. For a `Payment` transaction, these
are the `Fee` and `Sequence` fields.

The `signLocal` method will populate `Sequence` if it doesn't exist by calling the `account_info` method. You will still 
be required to set the `Fee` for now.

See the [transaction costs](https://developers.ripple.com/transaction-cost.html) documentation for how to calculate
minimum fees.

### Remote Signing

```php
$secret = 'sxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$transaction->signRemote($secret);

// Access the signed transaction data if needed.
$txData = $transaction->getTx();
```

As mentioned above, remote signing can be done in the next step via the `submit` method. You may only want to use the 
`signRemote` method if you need access to the signed transaction before submitting it.
