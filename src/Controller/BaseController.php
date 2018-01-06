<?php

namespace Boivie\League\Controller;

use Interop\Container\ContainerInterface;

class BaseController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
