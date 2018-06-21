<?php

namespace XRPHP\Tests\Api;

use XRPHP\Exception\InvalidParameterException;

class SignMethodTestCase extends MethodTestCase
{
    public $method;

    public function testValidateMissingTxJsonThrowsException()
    {
        $params = [
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/tx_json/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSecretKeyTypeThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'secret' => 'test',
            'key_type' => 'thisparamnotallowedwithsecret'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/secret/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSecretSeedThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'secret' => 'test',
            'seed' => 'thisparamnotallowedwithsecret'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/seed/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSecretSeedHexThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'secret' => 'test',
            'seed_hex' => 'thisparamnotallowedwithsecret'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/seed_hex/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSecretPassphraseThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'secret' => 'test',
            'passphrase' => 'thisparamnotallowedwithsecret'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/passphrase/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSeedNoKeyTypeThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'seed' => 'test'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/key_type/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSeedSecretThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'seed' => 'test',
            'key_type' => 'test',
            'secret' => 'thisparamnotallowedwithsecret'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/secret/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSeedSeedHexThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'seed' => 'test',
            'key_type' => 'test',
            'seed_hex' => 'thisparamnotallowedwithsecret'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/seed_hex/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSeedPassphraseThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'seed' => 'test',
            'key_type' => 'test',
            'passphrase' => 'thisparamnotallowedwithsecret'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/passphrase/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSeedHexNoKeyTypeThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'seed_hex' => 'test'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/key_type/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSeedHexSecretThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'key_type' => 'test',
            'seed_hex' => 'test',
            'secret' => 'thisparamnotallowedwithsecret'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/secret/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSeedHexSeedThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'key_type' => 'test',
            'seed_hex' => 'test',
            'seed' => 'thisparamnotallowedwithsecret'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/seed/');
        $this->client->method($this->method, $params);
    }

    public function testValidateSeedHexPassphraseThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'key_type' => 'test',
            'seed_hex' => 'test',
            'passphrase' => 'thisparamnotallowedwithsecret'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/passphrase/');
        $this->client->method($this->method, $params);
    }

    public function testValidatePassphraseNoKeyTypeThrowsException()
    {
        $params = [
            'tx_json' => 'test',
            'passphrase' => 'test'
        ];

        if ($this->method === 'sign_for') {
            $params['account'] = 'r12345';
        }

        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/key_type/');
        $this->client->method($this->method, $params);
    }

}
