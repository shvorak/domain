<?php


namespace Domain
{

    /**
     * Interface Middleware
     *
     * @package Domain
     */
    interface Middleware
    {

        /**
         * Wrap any message execution
         *
         * @param object   $message Message instance
         * @param object   $handler Message handler instance
         * @param callable $next    Next handler
         *
         * @return mixed
         */
        function execute($message, $handler, callable $next);

    }

}
