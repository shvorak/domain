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
    class QueryBusBuilder extends BusBuilder
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
         * @return QueryBus
         */
        public function build()
        {
            $map = array_reduce($this->providers, function (HandlersMap $map, HandlersProvider $provider) {
                $provider->register($map); return $map;
            }, new HandlersMap());

            return new QueryBus(
                $map,
                new MessageClassResolver(),
                $this->handlerResolver,
                $this->handlerMethodResolver,
                ...$this->middlewares
            );
        }

    }

}

