<?php

namespace Domain\Handler\Method
{

    use Domain\Handler\HandlerMethodLocator;

    class ClassNameMethodLocator implements HandlerMethodLocator
    {

        /**
         * Returns message handler method name
         *
         * @param object $message Message instance
         * @param object $handler Message handler instance
         * @param string $prefix  Handler method name prefix
         *
         * @throws \Domain\Error\HandlerMethodNotFound
         *
         * @return string
         */
        public function resolve($message, $handler, $prefix = 'handle')
        {
            $commandName = get_class($message);

            if (strpos($commandName, '\\') !== false) {
                $commandName = substr($commandName, strrpos($commandName, '\\') + 1);
            }
            return $prefix . $commandName;
        }
    }

}

