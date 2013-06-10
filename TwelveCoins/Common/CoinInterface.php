<?php

interface CoinInterface {
    public function getWeight();

    public function getId();

    public function markAsReal();
    public function markAsFake();
    public function markAsHeavy();
    public function markAsLight();

    /**
     * @return boolean
     */
    public function isChecked();

    /**
     * @return boolean
     */
    public function isReal();

    /**
     * @return boolean
     */
    public function isFake();

    /**
     * @return boolean
     */
    public function isHeavy();

    /**
     * @return boolean
     */
    public function isLight();
}