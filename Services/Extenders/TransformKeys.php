<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class TransformKeys
 * @package Prokl\CollectionExtenderBundle\Extenders
 * Perform an operation on the collection's keys.
 *
 * @see https://github.com/sebastiaanluca/laravel-helpers#collection-macros (идея)
 *
 * @since 16.09.2020
 * @since 17.09.2020 Доработка. Рекурсия.
 * @since 20.09.2020 Проверка на существование макроса.
 */
class TransformKeys implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('transformKeys')) {
            return;
        }

        Collection::macro('transformKeys', function (callable $operation) : Collection {
            /** @var Collection $obj */
            $obj = clone $this;

            return $obj->mapWithKeys(
                static function ($item, $key) use ($operation) : array {
                    if (is_array($item)) {
                        // @phpstan-ignore-next-line
                        $item = collect($item)->transformKeys($operation)
                                              ->toArray();
                    }

                    if ($item instanceof Collection) {
                        // @phpstan-ignore-next-line
                        $item = $item->transformKeys($operation);
                    }

                    return [$operation($key) => $item];
                });
        });
    }
}
