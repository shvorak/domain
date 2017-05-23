<?php

namespace Domain\Message
{

    use Domain\MessageResolver;

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

