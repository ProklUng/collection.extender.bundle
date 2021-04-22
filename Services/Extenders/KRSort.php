<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class KRSort
 * @package Prokl\CollectionExtenderBundle\Extenders
 * Sorts the Collection by its keys in the reverse order.
 *
 * @example $collection = collect(
 * ['d' => 'lemon', 'a' => 'orange', 'b' => 'banana', 'c' => 'apple'
 * ]
 * );
 *
 *  $collection->krsort(); // ['d' => 'lemon', 'c' => 'apple', 'b' => 'banana', 'a' => 'orange']
 *
 * @since 18.09.2020
 * @since 20.09.2020 Проверка на существование макроса.
 */
class KRSort implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('krsort')) {
            return;
        }

        Collection::macro('krsort', static function (Collection $collection) : Collection {
            $array = $collection->toArray();
            krsort($array);

            return collect($array);
        });
    }
}
