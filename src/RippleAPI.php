<?php

namespace XRPhp;

class RippleAPI
{
    /** @var string */
    private $authorization;

    /** @var string */
    private $certificate;

    /** @var int */
    private $feeCushion;

    /** @var string */
    private $key;

    /** @var string */
    private $passphrase;

    /** @var string */
    private $proxy;

    /** @var string */
    private $proxyAuthorization;

    /** @var string */
    private $server;

    /** @var int */
    private $timeout;

    /** @var bool */
    private $trace;

    /** @var string */
    private $trustedCertificates;

    public function __construct(array $params)
    {

    }

}