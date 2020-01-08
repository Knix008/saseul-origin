<?php

namespace Saseul\Script\Network;

use Saseul\Common\Script;
use Saseul\Core\Env;
use Saseul\Core\Key;
use Saseul\Core\Rule;
use Saseul\Data\Tracker;
use Saseul\Util\DateTime;
use Saseul\Util\RestCall;
use Saseul\Version;

class STest extends Script
{
    function main()
    {
        $validator = Tracker::getRandomValidator();
        $host = $validator['host'] ?? '';
        $rest = RestCall::GetInstance();

        while (true)
        {
            $rs = $rest->post('http://'.$host.'/transaction', $this->item1());
        }
    }

    function item1()
    {
        $type = 'Farming';
        $transaction = [
            'type' => $type,
            'version' => Version::CURRENT,
            'from' => Env::getAddress(),
            'to' => Env::getAddress(),
            'timestamp' => DateTime::microtime() + (5 * Rule::MICROINTERVAL_OF_CHUNK),
        ];

        $thash = Rule::hash($transaction);
        $private_key = Env::getPrivateKey();
        $public_key = Env::getPublicKey();
        $signature = Key::makeSignature($thash, $private_key, $public_key);

        $item = [
            'transaction' => json_encode($transaction),
            'thash' => $thash,
            'public_key' => $public_key,
            'signature' => $signature
        ];

        return $item;
    }
}

