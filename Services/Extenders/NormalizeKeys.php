<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class NormalizeKeys
 * @package Prokl\CollectionExtenderBundle\Extenders
 * Ensure that every array / collection within a collection contains the same keys.
 *
 * @since 20.09.2020
 */
class NormalizeKeys implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('normalizeKeys')) {
            return;
        }

        /**
         * Ensure that every array / collection within a collection contains the same keys.
         *
         * @return Collection
         */
        Collection::macro('normalizeKeys', function () {
            /** @var $this Collection */
            // @phpstan-ignore-next-line
            if ($this->isEmpty()) {
                return $this;
            }

            $null_array = array_fill_keys(
                array_keys(array_merge(...$this)),
                null
            );

            // @phpstan-ignore-next-line
            $this->transform(static function (array $item) use ($null_array) : array {
                return array_merge($null_array, $item);
            });

            return $this;
        });
    }
}
