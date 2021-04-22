<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class Replace
 * @package Prokl\CollectionExtenderBundle\Extenders
 * Perform a regular expression search and replace.
 *
 * @since 20.09.2020
 *
 * @method transform(mixed $item)
 */
class Replace implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('replace')) {
            return;
        }

        Collection::macro('replace',
            /**
             *
             * @param mixed $pattern
             * @param mixed $replacement
             * @param mixed $key
             *
             * @return mixed
             */
            function ($pattern, $replacement, $key = null) {
            // @phpstan-ignore-next-line
            return $this->transform(function ($item) use ($pattern, $replacement, $key) {
                if (!is_null($key)) {
                    $item->{$key} = preg_replace($pattern, $replacement, $item->{$key});
                } else {
                    $item = preg_replace($pattern, $replacement, $item);
                }

                return $item;
            });
        });
    }
}
