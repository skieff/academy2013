<?php

chdir(dirname(__DIR__));

require_once 'Common/Coin.php';
require_once 'Common/CoinHeap.php';

function compare(CoinHeapInterface $left, CoinHeapInterface $right) {
    return $left->getWeight() - $right->getWeight();
}

$heap0 = new CoinHeap(array(
    new RealCoin(1),
    new RealCoin(2),
    new RealCoin(3),
    new RealCoin(4),
    new RealCoin(5),
    new RealCoin(6),
    new RealCoin(7),
    new RealCoin(8),
    new FakeCoin(9, 15),
    new RealCoin(10),
    new RealCoin(11),
    new RealCoin(12),
));

$Heap1L = new CoinHeap($heap0->getUnchecked(4));
$Heap1R = new CoinHeap($heap0->getUnchecked(4));
$Heap1 = new CoinHeap($heap0->getUnchecked(4));

if (compare($Heap1L, $Heap1R) === 0) {
    $Heap1L->markAsReal();
    $Heap1R->markAsReal();

    $Heap4L = new CoinHeap($Heap1->getUnchecked(1));
    $Heap4R = new CoinHeap($Heap1->getUnchecked(1));
    $Heap4  = new CoinHeap($Heap1->getUnchecked(2));

    if (compare($Heap4L, $Heap4R) === 0) {
        $Heap4L->markAsReal();
        $Heap4R->markAsReal();
        $Heap7L = new CoinHeap($Heap1R->getReal(1));
        $Heap7R = new CoinHeap($Heap4->getUnchecked(1));
        $Heap7 = new CoinHeap($Heap4->getUnchecked(1));

        if (compare($Heap7L, $Heap7R) === 0) {
            print_r($Heap7->getIds());
        } else {
            print_r($Heap7R->getIds());
        }
    } else {
        $Heap4->markAsReal();
        $Heap12 = new CoinHeap($Heap4->getReal(1));

        if (compare($Heap12, $Heap4R)) {
            print_r($Heap4R->getIds());
        } else {
            print_r($Heap4L->getIds());
        }
    }
} else {
    $Heap1->markAsReal();
    if (compare($Heap1L, $Heap1R) < 0) {
        $Heap1L->markAsLight();
        $Heap1R->markAsHeavy();
    } else {
        $Heap1L->markAsHeavy();
        $Heap1R->markAsLight();
    }
    $tmpHeap = new CoinHeap(array_merge($Heap1L->getAll(), $Heap1R->getAll()));

    $heap20L = new CoinHeap(array_merge($tmpHeap->getHeavy(2), $tmpHeap->getLight(1)));
    $heap20R = new CoinHeap(array_merge($tmpHeap->getHeavy(1), $tmpHeap->getLight(1), $Heap1->getReal(1)));
    $heap20  = new CoinHeap(array_merge($tmpHeap->getHeavy(1), $tmpHeap->getLight(2)));

    if (compare($heap20L, $heap20R) === 0) {

    }
}