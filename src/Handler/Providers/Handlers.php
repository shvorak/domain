<?php

namespace Domain\Handler\Providers
{

    use Domain\Error\HandlerDuplication;

    /**
     * Class Handlers
     *
     * @package Domain\Handler\Providers
     */
    class Handlers extends Map
    {

        /**
         * Register command handler
         *
         * @param string $message
         * @param string $handler
         *
         * @throws HandlerDuplication
         *
         * @return Handlers
         */
        public function handle(string $message, string $handler)
        {
            if ($this->has($message)) {
                throw new HandlerDuplication("Handler for {$message} already registered");
            }
            $this->_map[$message] = $handler;

            return $this;
        }

    }

}

