<?php

namespace Domain\Message
{

    /**
     * Class ClassBased
     *
     * Class based message name extractor
     *
     * @package Domain\Message
     */
    class ClassBased implements NameExtractor
    {

        /**
         * Returns message name from instance
         *
         * @param object $message
         *
         * @return string
         */
        public function resolve($message)
        {
            return get_class($message);
        }

    }

}

