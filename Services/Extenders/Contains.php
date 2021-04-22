<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class Contains
 * @package Prokl\CollectionExtenderBundle\Extenders
 * Contains macros.
 *
 * @since 20.09.2020
 */
class Contains implements ExtenderCollectionInterface
{
    /**
     * @var array $macros Макросы.
     */
    private $macros = [
        'containsAll',
        'containsAll',
        'hasAll',
        'hasAny',
    ];

    /**
     * @inheritDoc
     */
    public function registerMacro(): void
    {
        foreach ($this->macros as $macroName) {
            if (Collection::hasMacro($macroName)) {
                return;
            }
        }

        /**
         * This method returns true if the collection contains all elements of the given $subset.
         */
        Collection::macro('containsAll',
            /**
             * @param mixed $subset
             *
             * @return boolean
             */
            function ($subset) : bool {
                $data = $subset;
                if (!$subset instanceof Collection) {
                    $data = Collection::make($subset);
                }

                // @phpstan-ignore-next-line
                return $data->filter(fn($value) => !$this->contains($value))->isEmpty();
            });

        /**
         * This method returns true if the collection contains any
         * of the elements given in $subset
         */
        Collection::macro('containsAny',
            /**
             * @param mixed $subset
             *
             * @return boolean
             */
            function ($subset) : bool {
                /** @var $this Collection */
                $data = $subset;
                if (!$subset instanceof Collection) {
                    $data = Collection::make($subset);
                }

                return $data->filter(function ($value) : bool {
                    /** @var $this Collection */
                    // @phpstan-ignore-next-line
                    return $this->contains($value);
                })->isNotEmpty();
            });

        /**
         * This method checks if all the given keys in $subset are present in
         * the collection.
         */
        Collection::macro('hasAll',
            /**
             * @param mixed $subset
             *
             * @return boolean
             */
            function ($subset) : bool {
                /** @var $this Collection */
                $data = $subset;
                if (!$subset instanceof Collection) {
                    $data = Collection::make($subset);
                }

                return $data->filter(function ($value) : bool {
                    /** @var $this Collection */
                    // @phpstan-ignore-next-line
                    return !$this->has($value);
                })->isEmpty();
            });

        /**
         * This method checks if any of the given keys in $subset exist in the collection.
         */
        Collection::macro('hasAny',
            /**
             * @param mixed $subset
             *
             * @return boolean
             */
            function ($subset) : bool {
            /** @var $this Collection */
                $data = $subset;
                if (!$subset instanceof Collection) {
                    $data = Collection::make($subset);
                }
                return $data->filter(function ($value) : bool {
                    /** @var $this Collection */
                    // @phpstan-ignore-next-line
                    return $this->has($value);
                })->isNotEmpty();
            });
    }
}
