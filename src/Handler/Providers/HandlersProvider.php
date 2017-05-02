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
         * @param Handlers $map
         *
         * @return void
         */
        public function register(Handlers $map);

    }

}

