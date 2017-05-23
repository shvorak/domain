<?php

namespace Domain\Handler
{

    use Domain\Error\HandlerNotFound;

    abstract class Map
    {
        /**
         * @var array
         */
        protected $_map = [];
        /**
         * Returns `true` if handler found
         *
         * @param string $message
         *
         * @return bool
         */
        public function has(string $message) : bool
        {
            return array_key_exists($message, $this->_map);
        }
        /**
         * Returns handler class for command
         *
         * @param string $message
         *
         * @throws HandlerNotFound
         *
         * @return mixed
         */
        public function get(string $message)
        {
            if (false === $this->has($message)) {
                throw new HandlerNotFound("Handler for message {$message} not registered");
            }
            return $this->_map[$message];
        }

        /**
         * Register handler for message
         *
         * @param string $message
         * @param string $handler
         *
         * @return mixed
         */
        abstract public function add(string $message, string $handler);

    }

}

