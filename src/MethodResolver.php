<?php

namespace Domain
{

    /**
     * Interface HandlerMethodLocator
     *
     * @package Domain
     */
    interface MethodResolver
    {

        /**
         * Returns
         *
         * @param object $message
         * @param object $handler
         *
         * @throws Error\HandlerMethodNotFound
         * @throws Error\HandlerMethodNotCallable
         *
         * @return Handler
         */
        public function resolve($message, $handler);

    }

}
