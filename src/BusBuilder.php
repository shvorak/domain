<?php

namespace Domain
{

    abstract class BusBuilder
    {

        /**
         * @var Middleware[]
         */
        protected $middlewares = [];

        /**
         * @var HandlerResolver
         */
        protected $handlerResolver;

        /**
         * @var HandlerMethodResolver
         */
        protected $handlerMethodResolver;

        /**
         * Create new builder instance
         *
         * @return static
         */
        public static function make()
        {
            return new static();
        }

        /**
         * @param Middleware[] ...$middleware
         *
         * @return static
         */
        public function using(Middleware ...$middleware)
        {
            // TODO : merge by value
            $this->middlewares = $middleware;
            return $this;
        }

        /**
         * @param HandlerResolver $resolver
         *
         * @return static
         */
        public function usingHandlerResolver(HandlerResolver $resolver)
        {
            $this->handlerResolver = $resolver;
            return $this;
        }

        /**
         * @param HandlerMethodResolver $resolver
         *
         * @return static
         */
        public function usingHandlerMethodResolver(HandlerMethodResolver $resolver)
        {
            $this->handlerMethodResolver = $resolver;
            return $this;
        }

    }

}

