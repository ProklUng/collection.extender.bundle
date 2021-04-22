<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

/**
 * Interface ExtenderCollectionInterface
 * @package Prokl\CollectionExtenderBundle\Extenders
 *
 * @since 16.09.2020
 */
interface ExtenderCollectionInterface
{
    /**
     * Регистрация нового макроса Сollection.
     *
     * @return void
     */
    public function registerMacro() : void;
}
