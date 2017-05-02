<?php

namespace Domain\Handler
{

    /**
     * Interface NameExtractor
     *
     * @package Domain\Message
     */
    interface MessageNameExtractor
    {

        /**
         * Returns message name from instance
         *
         * @param object $message
         *
         * @return string
         */
        public function extract($message);

    }

}

