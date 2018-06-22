<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * SubmitMultisigned Method Class
 *
 * The submit_multisigned command applies a multi-signed transaction and sends it to the network to be included in
 * future ledgers. (You can also submit multi-signed transactions in binary form using the submit command in submit-only
 * mode.)
 *
 * @link https://developers.ripple.com/submit_multisigned.html SubmitMultisigned method documentation.
 */
class SubmitMultisigned extends AbstractMethod
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
        $this->addField(new Field([
            'name' => 'tx_json',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'fail_hard',
            'required' => false
        ]));

        // END GENERATED

    }
}
