<?php

namespace Domain\Message
{

    class MessageClassResolver implements MessageResolver
    {

        /**
         * Resolve message name from an object
         *
         * @param object $message
         *
         * @return string
         */
        public function resolve($message): string
        {
            return get_class($message);
        }

    }

}

