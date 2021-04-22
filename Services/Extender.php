<?php

namespace Prokl\CollectionExtenderBundle\Services;

use Prokl\CollectionExtenderBundle\Services\Extenders\ExtenderCollectionInterface;

/**
 * Class Extender
 * @package Prokl\CollectionExtenderBundle
 *
 * @since 16.09.2020
 * @since 20.09.2020 Мелкая доработка.
 */
class Extender
{
    /**
     * @var ExtenderCollectionInterface[] $extenderCollection Экстендеры.
     */
    private $extenderCollection;

    /**
     * Extender constructor.
     *
     * @param ExtenderCollectionInterface ...$extenderCollection Экстендеры.
     */
    public function __construct(ExtenderCollectionInterface ...$extenderCollection)
    {
        $this->extenderCollection = $extenderCollection;

        $this->register();
    }

    /**
     * Регистрация экстендеров.
     *
     * @return void
     */
    public function register() : void
    {
        if (!$this->extenderCollection) {
            return;
        }

        foreach ($this->extenderCollection as $extender) {
            $extender->registerMacro();
        }
    }
}
