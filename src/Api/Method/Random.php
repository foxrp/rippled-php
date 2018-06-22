<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * Random Method Class
 *
 * The random command provides a random number to be used as a source of entropy for random number generation by
 * clients.
 *
 * @link https://developers.ripple.com/random.html Random method documentation.
 */
class Random extends AbstractMethod
{
    /**
     * {@inheritDoc}
     *
     * @throws \XRPHP\Exception\FieldException
     */
    public function setFields(): void
    {
        parent::setFields();

        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        // END GENERATED

    }
}
