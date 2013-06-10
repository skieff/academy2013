<?php

require_once 'CoinHeapInterface.php';
require_once 'CoinInterface.php';

class CoinHeap implements CoinHeapInterface {
    /**
     * @var CoinInterface[]
     */
    protected $_coins = array();

    /**
     * @param CoinInterface[] $coins
     */
    function __construct($coins = array())
    {
        $this->addCoins($coins);
    }


    public function getWeight()
    {
        $result = 0;

        foreach($this->_getCoins() as $coin) {
            $result+= $coin->getWeight();
        }

        return $result;
    }

    public function getUnchecked($amount)
    {
        $result = array();

        foreach ($this->_coins as $key => $coin) {
            if (!$coin->isChecked()) {
                $result[] = $coin;
                unset($this->_coins[$key]);
            }
        }

        if (count($result) < $amount) {
            throw new Exception('Not enough');
        }

        $this->addCoins(array_slice($result, $amount));
        return array_slice($result, 0, $amount);
    }

    public function getLight($amount)
    {
        $result = array();

        foreach ($this->_coins as $key => $coin) {
            if ($coin->isLight()) {
                $result[] = $coin;
                unset($this->_coins[$key]);
            }
        }

        if (count($result) < $amount) {
            throw new Exception('Not enough');
        }

        $this->addCoins(array_slice($result, $amount));
        return array_slice($result, 0, $amount);
    }

    public function getHeavy($amount)
    {
        $result = array();

        foreach ($this->_coins as $key => $coin) {
            if ($coin->isHeavy()) {
                $result[] = $coin;
                unset($this->_coins[$key]);
            }
        }

        if (count($result) < $amount) {
            throw new Exception('Not enough');
        }

        $this->addCoins(array_slice($result, $amount));
        return array_slice($result, 0, $amount);
    }

    public function getReal($amount)
    {
        $result = array();

        foreach ($this->_coins as $key => $coin) {
            if ($coin->isReal()) {
                $result[] = $coin;
                unset($this->_coins[$key]);
            }
        }

        if (count($result) < $amount) {
            throw new Exception('Not enough');
        }

        $this->addCoins(array_slice($result, $amount));
        return array_slice($result, 0, $amount);
    }

    public function getFake($amount)
    {
        $result = array();

        foreach ($this->_coins as $key => $coin) {
            if ($coin->isFake()) {
                $result[] = $coin;
                unset($this->_coins[$key]);
            }
        }

        if (count($result) < $amount) {
            throw new Exception('Not enough');
        }

        $this->addCoins(array_slice($result, $amount));
        return array_slice($result, 0, $amount);
    }

    /**
     * @param $coins
     * @return CoinInterface[]
     */
    public function addCoins($coins)
    {
        $this->_coins = array_merge($this->_coins, $coins);
    }

    public function markAsReal()
    {
        foreach ($this->_getCoins() as $coin) {
            $coin->markAsReal();
        }
    }

    public function markAsFake()
    {
        foreach ($this->_getCoins() as $coin) {
            $coin->markAsFake();
        }
    }

    public function markAsLight()
    {
        foreach ($this->_getCoins() as $coin) {
            $coin->markAsLight();
        }
    }

    public function markAsHeavy()
    {
        foreach ($this->_getCoins() as $coin) {
            $coin->markAsHeavy();
        }
    }

    /**
     * @return \CoinInterface[]
     */
    protected function _getCoins()
    {
        return $this->_coins;
    }

    public function getIds()
    {
        $result = array();

        foreach ($this->_coins as $coin) {
            $result[] = $coin->getId();
        }

        return $result;
    }
}