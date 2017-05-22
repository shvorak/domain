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
         * @param object   $message
         * @param callable $next
         *
         * @return mixed|void
         */
        function execute($message, callable $next);

    }

}