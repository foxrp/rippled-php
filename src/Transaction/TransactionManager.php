<?php

namespace XRPHP\Transaction;

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Key\PrivateKeyFactory;
use BitWasp\Bitcoin\Script\ScriptFactory;
use BitWasp\Bitcoin\Transaction\Factory\Signer;
use BitWasp\Bitcoin\Transaction\TransactionFactory;
use BitWasp\Bitcoin\Transaction\TransactionOutput;

class TransactionManager
{
    public function sign(string $hex, string $privateKey): string
    {
        $tx = TransactionFactory::fromHex($hex);

        $transactionOutputs = [];
        foreach ($tx->getInputs() as $idx => $input) {
            $transactionOutputs[] = new TransactionOutput(0, ScriptFactory::fromHex($input->getScript()->getBuffer()->getHex()));
        }

        $priv = PrivateKeyFactory::fromWif($privateKey);
        $signer = new Signer($tx, Bitcoin::getEcAdapter());

        foreach ($transactionOutputs as $idx => $transactionOutput) {
            $signer->sign($idx, $priv, $transactionOutput);
        }

        $signed = $signer->get();
        return $signed->getHex();
    }
}
