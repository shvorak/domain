<?php

namespace Domain\Handler\Message
{


    use Domain\Handler\MessageNameExtractor;

    class ClassBasedName implements MessageNameExtractor
    {

        /**
         * Returns message name from instance
         *
         * @param object $message
         *
         * @return string
         */
        public function extract($message)
        {
            return get_class($message);
        }

    }

}

