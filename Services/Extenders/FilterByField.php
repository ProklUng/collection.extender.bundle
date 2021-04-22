<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class FilterByField
 * Фильтр по одному полю. Вместо:
 * collect($this->arConfigs)
 * ->filter(static function ($value) use ($currentUrl) {
 * return trim($value['uri']) === trim($currentUrl);
 * })->toArray();
 *
 * Пишем collect($this->arConfigs)->filterField('field_name', 'value')
 *
 * @package Prokl\CollectionExtenderBundle\Extenders
 *
 * @since 25.09.2020
 */
class FilterByField implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('filterField')) {
            return;
        }

        Collection::macro('filterField',
            /**
             * @param string $field Поле.
             * @param mixed  $value Значение.
             *
             * @return mixed
             */
            function (string $field, $value) {
                /** @var $this Collection */
                // @phpstan-ignore-next-line
                return $this->filter(static function ($data) use ($field, $value) : bool {
                    if (!array_key_exists($field, $data)
                    ||
                    is_null($value)
                    ) {
                        return false;
                    }

                    return trim($data[$field]) === $value;
                });
            });
    }
}
