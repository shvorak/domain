<?php

namespace Domain\Handler\Locator
{

    use Psr\Container\ContainerInterface;

    use Domain\Handler\HandlerLocator;
    use Domain\Handler\Providers\Handlers;
    use Domain\Handler\Providers\HandlersProvider;

    /**
     * Class ContainerLocator
     * @package Domain\Handler\Locator
     */
    class ContainerLocator implements HandlerLocator
    {

        /**
         * @var HandlersProvider
         */
        protected $_map;

        /**
         * @var ContainerInterface
         */
        protected $_container;

        /**
         * ContainerLocator constructor.
         *
         * @param ContainerInterface $_container
         * @param HandlersProvider[] $providers
         */
        public function __construct(ContainerInterface $_container, \Iterator $providers)
        {
            $this->_map = new Handlers();
            $this->_container = $_container;

            foreach ($providers as $provider) {
                $provider->register($this->_map);
            }
        }

        /**
         * Returns handler instance by message name
         *
         * @param string $message
         *
         * @throws \Domain\Error\HandlerNotFound
         *
         * @return object
         */
        public function resolve($message)
        {
            $handler = $this->_map->get($message);

            return $this->_container->get($handler);
        }

    }

}

