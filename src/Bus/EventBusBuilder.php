<?php

namespace Domain\Bus
{

    use Domain\BusBuilder;
    use Domain\Handler\ListenersMap;
    use Domain\Handler\ListenersProvider;

    /**
     * Class EventBusBuilder
     * @package Domain\Bus
     */
    class EventBusBuilder extends BusBuilder
    {

        /**
         * @var ListenersProvider[]
         */
        private $providers = [];

        /**
         * Register listeners providers
         *
         * @param ListenersProvider $provider
         *
         * @return static
         */
        public function register(ListenersProvider $provider)
        {
            $this->providers[] = $provider;
            return $this;
        }

        /**
         * @return EventBusInterface
         */
        public function build()
        {
            $map = array_reduce($this->providers, function (ListenersMap $map, ListenersProvider $provider) {
                $provider->register($map);

                return $map;
            }, new ListenersMap());

            return new EventBus(
                $map,
                $this->getMessageResolver(),
                $this->getHandlerResolver(),
                $this->getHandlerMethodResolver(),
                ...$this->middlewares
            );
        }

    }

}

