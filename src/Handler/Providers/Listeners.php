<?php

namespace Domain\Handler\Providers
{

    /**
     * Class Listeners
     *
     * @package Domain\Handler\Providers
     */
    class Listeners extends Map
    {

        /**
         * Register event handlers
         *
         * @param string $event
         * @param string $handler
         *
         * @return Listeners
         */
        public function handle(string $event, string $handler)
        {
            if (false === $this->has($event)) {
                $this->_map[$event] = [];
            }

            $this->_map[$event][] = $handler;

            return $this;
        }

    }

}

