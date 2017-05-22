<?php

namespace Domain\Bus
{

    use Domain\Bus;

    /**
     * Class QueryBus
     *
     * @package Domain\Bus
     */
    class QueryBus extends Bus implements QueryBusInterface
    {

        /**
         * @inheritdoc
         */
        public function ask($message)
        {
            return $this->invoker->execute($message);
        }

        /**
         * @inheritdoc
         */
        protected function process($message)
        {
            $messageName = $this->messageResolver->resolve($message);
            $handlerName = $this->map->get($messageName);

            $handler    = $this->handlerResolver->resolve($handlerName);
            $method     = $this->handlerMethodResolver->resolve($message, $handler);

            return $method->handle($message);
        }

    }

}

