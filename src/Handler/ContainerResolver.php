<?php

namespace Domain\Handler
{

    use Domain\Error;
    use Domain\HandlerResolver;
    use Psr\Container\ContainerInterface;

    class ContainerResolver implements HandlerResolver
    {

        /**
         * @var ContainerInterface
         */
        private $container;

        /**
         * ContainerResolver constructor.
         */
        public function __construct(ContainerInterface $container)
        {
            $this->container = $container;
        }

        /**
         * @param string $class
         *
         * @throws Error\HandlerNotFound
         *
         * @return object
         */
        public function resolve($class)
        {
            return $this->container->get($class);
        }
    }

}

