<?php

namespace Domain\Message
{

    /**
     * Interface MessageResolver
     * @package Domain\Message
     */
    interface MessageResolver
    {

        /**
         * Resolve message name from an object
         *
         * @param object $message
         *
         * @return string
         */
        public function resolve($message) : string;

    }

}

