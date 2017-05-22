<?php

namespace Domain\Bus
{

    use Domain\BusBuilder;
    use Domain\Handler\HandlersMap;
    use Domain\Handler\HandlersProvider;
    use Domain\Message\MessageClassResolver;

    /**
     * Class CommandBusBuilder
     * @package Domain\Bus
     */
    class CommandBusBuilder extends BusBuilder
    {

        protected $providers = [];

        /**
         * Register handler providers
         *
         * @param HandlersProvider $provider
         *
         * @return static
         */
        public function register(HandlersProvider $provider)
        {
            $this->providers[] = $provider;

            return $this;
        }

        /**
         * Returns new instance of CommandBus
         *
         * @return CommandBus
         */
        public function build()
        {
            $map = array_reduce($this->providers, function (HandlersMap $map, HandlersProvider $provider) {
                $provider->register($map); return $map;
            }, new HandlersMap());

            return new CommandBus(
                $map,
                new MessageClassResolver(),
                $this->handlerResolver,
                $this->handlerMethodResolver,
                ...$this->middlewares
            );
        }

    }

}

