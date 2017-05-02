<?php

namespace Domain
{

    use Domain\Error\InvalidMiddleware;

    class Invoker
    {

        /**
         * @var callable
         */
        private $last;

        /**
         * @var Middleware[]
         */
        private $middlewares;

        /**
         * Invoker constructor.
         *
         * @param Middleware[] $middlewares
         * @param callable     $last
         */
        public function __construct(array $middlewares, callable $last)
        {
            $this->last = $last;
            $this->middlewares = $middlewares;
        }

        /**
         * Create execution pipeline
         *
         * @param $message
         * @param $handler
         *
         * @throws InvalidMiddleware
         *
         * @return callable
         */
        protected function create($message, $handler)
        {
            $next = $this->last;
            while ($middleware = array_pop($this->middlewares)) {
                if ($middleware instanceof Middleware) {
                    $next = function () use ($middleware, $message, $handler, $next) {
                        return $middleware->execute($message, $handler, $next);
                    };
                } else {
                    throw new InvalidMiddleware('Middleware must be instance of Middleware interface');
                }
            }
            return $next;
        }

        /**
         * Invoke message handlers pipeline
         *
         * @return mixed
         */
        public function invoke($message, $handler)
        {
            return $this->create($message, $handler)();
        }

    }

}

