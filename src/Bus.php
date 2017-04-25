<?php

namespace Domain
{

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
         * BaseBus constructor.
         *
         * @param Middleware[] $middlewares
         */
        public function __construct(array $middlewares = [])
        {
            $this->invoker = new Invoker($middlewares, function ($message) {
                return $this->process($message);
            });
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

