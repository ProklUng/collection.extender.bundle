<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class SortByExternalKeys
 * @package Prokl\CollectionExtenderBundle\Extenders
 *
 * @since 16.09.2020
 * @since 17.09.2020 Доработка.
 * @since 20.09.2020 Проверка на существование макроса.
 */
class SortByExternalKeys implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('sortByExternalKeys')) {
            return;
        }

        Collection::macro('sortByExternalKeys',
            /**
             * @param mixed $arrayKeys
             *
             * @return Collection
             */
            function ($arrayKeys): Collection {
                if (!is_array($arrayKeys)) {
                    $arrayKeys = (array)$arrayKeys;
                }

                $arResult = [];
                foreach ($arrayKeys as $newKey) {
                    $arResult[] = $this[$newKey] ?? null;
                }

                return collect($arResult)->filter();
            });
    }
}
