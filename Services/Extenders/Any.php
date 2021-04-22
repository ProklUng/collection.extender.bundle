<?php

namespace Prokl\CollectionExtenderBundle\Services\Extenders;

use Illuminate\Support\Collection;

/**
 * Class Any
 * @package Prokl\CollectionExtenderBundle\Extenders
 *
 * $users = User::all();
 *
 * // Returns `true` if the collection is not empty.
 * $users->any();
 *
 * // Returns `true` if there is a user with a paid plan.
 * $users->any(fn ($user) => $user->has_paid_plan);
 *
 * // Returns `true` if there is a user with a paid plan.
 * $users->any->has_paid_plan;
 *
 * @since 20.09.2020
 */
class Any implements ExtenderCollectionInterface
{
    /**
     * @inheritDoc
     *
     */
    public function registerMacro(): void
    {
        if (Collection::hasMacro('any')) {
            return;
        }

        Collection::macro('any', function (callable $callback = null) : bool {
            /** @var $this Collection */
            // @phpstan-ignore-next-line
            $iterable = $this->getIterator();

            if (is_null($callback)) {
                $callback = static function ($value): bool {
                    return (bool) $value;
                };
            }

            foreach ($iterable as $key => $value) {
                if ($callback($value, $key)) {
                    return true;
                }
            }

            return false;
        });
    }
}
