<?php

namespace Domain\Handler
{

    /**
     * Interface HandlersProvider
     * @package Domain\Handler
     */
    interface ListenersProvider
    {

        /**
         * Register handlers
         *
         * @param ListenersMap $map
         *
         * @return void
         */
        public function register(ListenersMap $map);

    }

}

