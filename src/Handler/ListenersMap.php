<?php

namespace Domain\Handler
{

    /**
     * Class HandlersMap
     *
     * @package Domain\Handler
     */
    class ListenersMap extends Map
    {

        /**
         * Register event handlers
         *
         * @param string $message
         * @param string $handler
         *
         * @return ListenersMap
         */
        public function add($message, $handler)
        {
            if ($this->has($message) === false) {
                $this->_map[$message] = [];
            }
            $this->_map[$message][] = $handler;

            return $this;
        }

        public function get($message)
        {
            return $this->has($message) ? $this->_map[$message] : [];
        }

    }

}

