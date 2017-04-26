<?php

namespace Domain\Handler\Providers
{

    /**
     * Interface HandlersProvider
     *
     * @package Domain\Handler\Providers
     */
    interface HandlersProvider
    {

        /**
         * Register handlers
         *
         * @param Handlers $bus
         *
         * @return void
         */
        public function register(Handlers $bus);

    }

}

