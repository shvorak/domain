<?php

namespace Domain\Handler
{

    /**
     * Interface HandlerMethodLocator
     * @package Domain\Handler
     */
    interface HandlerMethodLocator
    {

        /**
         * Returns message handler method name
         *
         * @param object $message   Message instance
         * @param object $handler   Message handler instance
         * @param string $prefix    Handler method name prefix
         *
         * @throws \Domain\Error\HandlerMethodNotFound
         *
         * @return string
         */
        public function resolve($message, $handler, $prefix = 'handle');

    }

}

