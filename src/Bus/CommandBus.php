<?php

namespace Domain\Bus
{

    use Domain\Bus;

    /**
     * Class CommandBus
     *
     * @package Domain\Bus
     */
    class CommandBus extends Bus
    {

        /**
         * Execute command handler
         *
         * @param object $message
         *
         * @return mixed
         */
        public function execute($message)
        {
            $messageName = $this->messageExtractor->extract($message);
            $handler = $this->handlerLocator->resolve($messageName);

            return $this->invoker->invoke($message, $handler);
        }

        /**
         * Handle message
         *
         * @param object $message
         *
         * @return mixed
         */
        protected function process($message)
        {
            $messageName = $this->messageExtractor->extract($message);
            $handler = $this->handlerLocator->resolve($messageName);
            $method = $this->handlerMethodLocator->resolve($message, $handler);

            return $handler->{$method}($message);
        }

    }

}

