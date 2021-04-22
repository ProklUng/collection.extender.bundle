<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class SortByDateDesc
 * @package Prokl\CollectionExtenderBundle\Extenders
 *
 * @internal Collection@sortByDate($key = null)
 *
 * Sort the values in a collection by a datetime value in reversed order.
 *
 * @since 20.09.2020
 */
class SortByDateDesc implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('sortByDateDesc')
            ||
            !Collection::hasMacro('sortByDate')
        ) {
            return;
        }

        Collection::macro('sortByDateDesc', function ($key = null) {
            // @phpstan-ignore-next-line
            return $this->sortByDate($key)->reverse();
        });
    }
}
