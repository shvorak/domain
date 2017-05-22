<?php

namespace Domain\Bus
{

    use Domain\Bus;

    /**
     * Class EventBus
     * @package Domain\Bus
     */
    class EventBus extends Bus implements EventBusInterface
    {

        /**
         * @inheritdoc
         */
        protected function process($message)
        {
            $event = $this->messageResolver->resolve($message);
            $listeners = $this->handlerMap->get($event);

            foreach ($listeners as $listener) {
                $handler = $this->handlerResolver->resolve($listener);

                $method = $this->handlerMethodResolver->resolve($message, $handler);
                $method->handle($message);
            }
        }

        /**
         * Emit event object
         *
         * @param object $event
         *
         * @return void
         */
        public function emit($event): void
        {
            $this->invoker->execute($event);
        }

    }

}

