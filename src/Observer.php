<?php

namespace src;

/**
 * Class Observer.
 */
abstract class Observer
{
    public $telegram;

    public function __construct(Telegram $myTele)
    {
        $this->telegram = $myTele;
    }

    abstract public function update();

    abstract protected function check();
}
