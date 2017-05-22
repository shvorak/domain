<?php

namespace Domain
{

    use Domain\Handler\Map;
    use Domain\Message\MessageResolver;

    /**
     * Class Bus
     *
     * @package Domain
     */
    abstract class Bus
    {

        /**
         * @var Map
         */
        protected $map;

        /**
         * @var Pipeline
         */
        protected $invoker;

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
         * @param Map                   $map
         * @param MessageResolver       $messageResolver
         * @param HandlerResolver       $handlerResolver
         * @param HandlerMethodResolver $handlerMethodResolver
         * @param Middleware[]          ...$middlewares
         */
        public function __construct(
            Map $map,
            MessageResolver $messageResolver,
            HandlerResolver $handlerResolver,
            HandlerMethodResolver $handlerMethodResolver,
            Middleware ...$middlewares
        )
        {
            $this->invoker = new Pipeline($middlewares, function ($message) {
                return $this->process($message);
            });

            $this->map = $map;
            $this->messageResolver = $messageResolver;
            $this->handlerResolver = $handlerResolver;
            $this->handlerMethodResolver = $handlerMethodResolver;
        }

        protected abstract function process($message);

    }

}

