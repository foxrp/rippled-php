<?php declare(strict_types=1);

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * OfferCreate Transaction Type Class
 *
 * An OfferCreate transaction is effectively a limit order. It defines an intent to exchange currencies, and creates an
 * Offer object if not completely fulfilled when placed. Offers can be partially fulfilled.
 *
 * @link https://developers.ripple.com/offercreate.html OfferCreate transaction type documentation.
 */
class OfferCreate extends AbstractTransactionType
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
            'name' => 'TakerGets',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'TakerPays',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Expiration',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'OfferSequence',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED
    }
}
