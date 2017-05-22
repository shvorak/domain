<?php

namespace Domain
{

    /**
     * Interface HandlerResolver
     * @package Domain
     */
    interface HandlerResolver
    {

        /**
         * @param string $class
         *
         * @throws Error\HandlerNotFound
         *
         * @return object
         */
        public function resolve($class);

    }

}
