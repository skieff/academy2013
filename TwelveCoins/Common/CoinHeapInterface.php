<?php

interface CoinHeapInterface {
    /**
     * @param $coins
     * @return CoinInterface[]
     */
    public function addCoins($coins);

    public function getWeight();

    public function getUnchecked($amount);

    public function getLight($amount);

    public function getHeavy($amount);

    public function getReal($amount);

    public function getFake($amount);

    public function markAsReal();

    public function markAsFake();

    public function markAsLight();

    public function markAsHeavy();
}