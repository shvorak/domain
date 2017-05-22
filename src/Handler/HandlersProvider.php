<?php

namespace Domain\Handler
{

    /**
     * Interface HandlersProvider
     * @package Domain\Handler
     */
    interface HandlersProvider
    {

        /**
         * Register handlers
         *
         * @param HandlersMap $map
         *
         * @return void
         */
        public function register(HandlersMap $map);

    }

}

