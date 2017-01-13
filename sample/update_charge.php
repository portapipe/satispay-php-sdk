<?php

include __DIR__ . '/../vendor/autoload.php';

use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Satispay;

$satispay = new Satispay(
    new Bearer('osh_...'),
    'sandbox'
);

use ChiarilloMassimo\Satispay\Model\Charge;

$charge = new Charge();
$charge
    ->setUser($satispay->getUserHandler()->createByPhoneNumber('+39 3939278036'))
    ->setAmount(15) // 0.15 €
    ->setCallbackUrl('http://fakeurl.com/satispay-callback')
    ->setCurrency('EUR')
    ->setDescription('Test description')
    ->setExpireMinutes(20)
    ->setExtraFields([
        'orderId' => 'id',
        'extra' => 'extra'
    ])
    ->setSendMail(false);

$satispay->getChargeHandler()->persist($charge, true);

$charge->setDescription('Opssss :)');

$satispay->getChargeHandler()->update($charge);

var_dump($charge->getDescription());