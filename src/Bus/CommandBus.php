<?php

namespace Domain\Bus
{

    use Domain\Bus;

    class CommandBus extends Bus implements CommandBusInterface
    {

        /**
         * @param object $message
         *
         * @return mixed
         */
        protected function process($message)
        {
            $messageName = $this->messageResolver->resolve($message);
            $handlerName = $this->map->get($messageName);

            $handler = $this->handlerResolver->resolve($handlerName);
            $method = $this->handlerMethodResolver->resolve($message, $handler);

            return $method->handle($message);
        }

        /**
         * @inheritdoc
         */
        public function execute($message)
        {
            return $this->invoker->execute($message);
        }

    }

}

