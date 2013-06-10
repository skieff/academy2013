<?php

require_once 'CoinInterface.php';

class Coin implements CoinInterface {
    const UNCHECKED = 0;
    const REAL = 10;
    const HEAVY = 5;
    const LIGHT = 6;
    const FAKE  = -10;

    protected $_weight = 0;

    protected $_state;

    protected $_realState;

    function __construct($state = static::UNCHECKED, $weight = 10)
    {
        $this->_setState($state);
        $this->_setWeight($weight);
    }

    public function getRealState() {
        return $this->_realState;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->_weight;
    }

    /**
     * @param int $weight
     */
    protected function _setWeight($weight)
    {
        $this->_weight = $weight;
    }

    /**
     * @return int
     */
    protected function _getState()
    {
        return $this->_state;
    }

    /**
     * @param mixed $state
     */
    protected function _setState($state)
    {
        $this->_state = $state;
    }


    public function markAsReal()
    {
        $this->_setState(static::REAL);
    }

    public function markAsFake()
    {
        $this->_setState(static::FAKE);
    }

    public function markAsHeavy()
    {
        if ($this->isChecked()) {
            if ($this->isHeavy()) {
                $this->_setState(static::FAKE);
            } else {
                $this->_setState(static::REAL);
            }
        } else {
            $this->_setState(static::HEAVY);
        }
    }

    public function markAsLight()
    {
        if ($this->isChecked()) {
            if ($this->isLight()) {
                $this->_setState(static::FAKE);
            } else {
                $this->_setState(static::REAL);
            }
        } else {
            $this->_setState(static::LIGHT);
        }
    }

    public function isChecked()
    {
        return $this->_getState() !== static::UNCHECKED;
    }

    public function isReal()
    {
        return $this->_getState() === static::REAL;
    }

    public function isFake()
    {
        return $this->_getState() === static::FAKE;
    }

    public function isHeavy()
    {
        return $this->_getState() === static::HEAVY;
    }

    public function isLight()
    {
        return $this->_getState() === static::LIGHT;
    }
}
