<?php

namespace XRPHP\Transaction;

use XRPHP\Exception\TransactionTypeException;

/**
 * Provides a map of transaction types to their respective classes.
 *
 * @package XRPHP\Transaction
 */
class TypeMap
{
    /**
     * @param string $type
     * @return string
     * @throws TransactionTypeException
     */
    public static function FindClass(string $type): string
    {
        $classes = [
            'Payment' => \XRPHP\Transaction\Type\Payment::class
        ];

        if (!isset($classes[$type])) {
            throw new TransactionTypeException(sprintf('No class found for transaction type %s', $type));
        }

        return $classes[$type];
    }
}
