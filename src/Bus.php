<?php

namespace Domain
{

    use Domain\Handler\Map;
    use Domain\Message\MessageResolver;

    /**
     * Class Bus
     *
     * Base message bus realization
     *
     * @package Domain
     */
    abstract class Bus
    {

        /**
         * @var Pipeline
         */
        protected $invoker;

        /**
         * @var Map
         */
        protected $handlerMap;

        /**
         * @var MessageResolver
         */
        protected $messageResolver;

        /**
         * @var HandlerResolver
         */
        protected $handlerResolver;

        /**
         * @var HandlerMethodResolver
         */
        protected $handlerMethodResolver;

        /**
         * Bus constructor.
         *
         * @param Map                   $handlerMap
         * @param MessageResolver       $messageResolver
         * @param HandlerResolver       $handlerResolver
         * @param HandlerMethodResolver $handlerMethodResolver
         * @param Middleware[]          ...$middlewares
         */
        public function __construct(
            Map $handlerMap,
            MessageResolver $messageResolver,
            HandlerResolver $handlerResolver,
            HandlerMethodResolver $handlerMethodResolver,
            Middleware ...$middlewares
        )
        {
            $this->invoker = new Pipeline($middlewares, function ($message) {
                return $this->process($message);
            });

            $this->handlerMap = $handlerMap;
            $this->messageResolver = $messageResolver;
            $this->handlerResolver = $handlerResolver;
            $this->handlerMethodResolver = $handlerMethodResolver;
        }

        protected abstract function process($message);

    }

}

