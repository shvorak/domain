<?php

namespace Domain
{

    use Domain\Handler\HandlerLocator;

    /**
     * Class BaseBus
     *
     * @package Domain
     */
    abstract class Bus
    {

        /**
         * @var Invoker
         */
        protected $invoker;

        /**
         * @var HandlerLocator
         */
        protected $handlerLocator;

        /**
         * BaseBus constructor.
         *
         * @param Middleware[]   $middlewares
         * @param HandlerLocator $handlerLocator
         */
        public function __construct(array $middlewares = [], HandlerLocator $handlerLocator = null)
        {
            $this->invoker = new Invoker($middlewares, function ($message) {
                return $this->process($message);
            });

            $this->handlerLocator = $handlerLocator;
        }

        /**
         * Handle message
         *
         * @param object $message
         *
         * @return mixed
         */
        abstract protected function process($message);

    }

}

