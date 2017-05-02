<?php

namespace Domain\Handler
{

    /**
     * Interface HandlerLocator
     * @package Domain\Handler
     */
    interface HandlerLocator
    {

        /**
         * Returns handler instance by message name
         *
         * @param string $message
         *
         * @throws \Domain\Error\HandlerNotFound
         *
         * @return object
         */
        public function resolve($message);

    }

}
