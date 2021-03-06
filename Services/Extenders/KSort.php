<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class KSort
 * @package Prokl\CollectionExtenderBundle\Extenders
 * Sorts the Collection by its keys.
 *
 * @example $collection = collect(
 * ['d' => 'lemon', 'a' => 'orange', 'b' => 'banana', 'c' => 'apple'
 * ]
 * );
 *
 *  $collection->ksort(); // ['a' => 'orange', 'b' => 'banana', 'c' => 'apple', 'd' => 'lemon']
 *
 * @since 18.09.2020
 * @since 20.09.2020 Проверка на существование макроса.
 */
class KSort implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('ksort')) {
            return;
        }

        Collection::macro('ksort', static function (Collection $collection) : Collection {
            $array = $collection->toArray();
            ksort($array);

            return collect($array);
        });
    }
}
