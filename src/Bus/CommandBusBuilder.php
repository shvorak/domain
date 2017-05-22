<?php

namespace Domain\Bus
{

    use Domain\BusBuilder;
    use Domain\Handler\HandlersProvider;

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
            return new CommandBus();
        }

    }

}

