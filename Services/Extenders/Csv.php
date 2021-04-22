<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class Csv
 * @package Prokl\CollectionExtenderBundle\Extenders
 * Pass collection to an anonymous function.
 *
 * @since 20.09.2020
 */
class Csv implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('csv')) {
            return;
        }

        Collection::macro('csv', function () {
            /** @var $this Collection */
            $buffer = fopen('php://temp/maxmemory:' . (5 * 1024 * 1024), 'rb+');
            if (!$buffer) {
                return false;
            }

            // @phpstan-ignore-next-line
            $this->each(
                /**
                 * @param mixed $line
                 *
                 * @return mixed
                 */
                static fn($line) => fputcsv($buffer, $line));

            rewind($buffer);

            return stream_get_contents($buffer);
        });
    }
}
