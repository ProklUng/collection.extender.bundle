<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class Recursive
 * @package Prokl\CollectionExtenderBundle\Extenders
 * Recursively convert nested arrays into Laravel Collections.
 *
 * @since 18.09.2020
 * @since 20.09.2020 Проверка на существование макроса.
 */
class Recursive implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('recursive')) {
            return;
        }

        Collection::macro('recursive',
            /**
             * @return mixed
             */
            function () {
                /** @var $this Collection */
                // @phpstan-ignore-next-line
                return $this->map(static function ($value) {
                    if (is_array($value) || is_object($value)) {
                        // @phpstan-ignore-next-line
                        return (collect($value))->recursive();
                    }

                    return $value;
                });
            });
    }
}
