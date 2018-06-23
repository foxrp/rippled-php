<?php declare(strict_types=1);

namespace FOXRP\Rippled\Api\Method;

use FOXRP\Rippled\Api\Field;

/**
 * RipplePathFind Method Class
 *
 * The ripple_path_find method is a simplified version of the path_find method that provides a single response with a
 * payment path you can use right away. It is available in both the WebSocket and JSON-RPC APIs. However, the results
 * tend to become outdated as time passes. Instead of making multiple calls to stay updated, you should instead use the
 * path_find method to subscribe to continued updates where possible.
 *
 * @link https://developers.ripple.com/ripple_path_find.html RipplePathFind method documentation.
 */
class RipplePathFind extends AbstractMethod
{
    /**
     * {@inheritDoc}
     *
     * @throws \FOXRP\Rippled\Exception\FieldException
     */
    public function setFields(): void
    {
        parent::setFields();

        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new Field([
            'name' => 'source_account',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'destination_account',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'destination_amount',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'send_max',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'source_currencies',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'ledger_hash',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'ledger_index',
            'required' => false
        ]));

        // END GENERATED
    }
}
