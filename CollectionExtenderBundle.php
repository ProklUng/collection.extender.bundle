<?php

namespace Prokl\CollectionExtenderBundle;

use Prokl\CollectionExtenderBundle\DependencyInjection\CollectionExtenderExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class CollectionExtenderBundle
 * @package Prokl\CollectionExtenderBundle
 *
 * @since 22.04.2021
 */
class CollectionExtenderBundle extends Bundle
{
   /**
   * @inheritDoc
   */
    public function getContainerExtension()
    {
        if ($this->extension === null) {
            $this->extension = new CollectionExtenderExtension();
        }

        return $this->extension;
    }
}
