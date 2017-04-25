<?php

namespace Domain\Message
{

    /**
     * Interface NameExtractor
     *
     * @package Domain\Message
     */
    interface NameExtractor
    {

        /**
         * Returns message name from instance
         *
         * @param object $message
         *
         * @return string
         */
        public function resolve($message);

    }

}

