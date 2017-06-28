<?php

namespace Domain\Handler
{

    use Domain\Error\HandlerDuplication;

    /**
     * Class HandlersMap
     *
     * @package Domain\Handler
     */
    class HandlersMap extends Map
    {

        /**
         * Register command handler
         *
         * @param string $message
         * @param string $handler
         *
         * @throws HandlerDuplication
         *
         * @return HandlersMap
         */
        public function add($message, $handler)
        {
            if ($this->has($message)) {
                throw new HandlerDuplication("Handler for {$message} already registered");
            }
            $this->_map[$message] = $handler;

            return $this;
        }

    }

}

