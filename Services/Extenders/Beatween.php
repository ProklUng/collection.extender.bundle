<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class Beatween
 * @package Prokl\CollectionExtenderBundle\Extenders
 * Reduce each collection item to the value found between a given start and end string.
 *
 * @since 16.09.2020
 * @since 20.09.2020 Проверка на существование макроса.
 */
class Beatween implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     * @example collect(['"value1"', '"value2"', '"value3"',])->between('"', '"');
     *
     * Illuminate\Support\Collection { all: [ "value1", "value2", "value3", ] }
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('between')) {
            return;
        }

        Collection::macro('between',
            /**
             * @param mixed $start
             * @param mixed|null $end
             *
             * @return Collection
             */
            function ($start, $end = null) : Collection {
                $end = $end ?? $start;
            /** @var Collection $obj */
                $obj = clone $this;

                return $obj->reduce(static function ($items, $value) use ($start, $end) : Collection {
                    if (preg_match('/^' . $start . '(.*)' . $end . '$/', $value, $matches)) {
                        $items[] = $matches[1];
                    }

                    return collect($items);
                });
            });
    }
}
