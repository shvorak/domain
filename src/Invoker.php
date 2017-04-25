<?php

namespace Domain
{

    use Domain\Error\InvalidMiddleware;

    class Invoker
    {

        /**
         * @var callable
         */
        private $pipeline;

        /**
         * Invoker constructor.
         *
         * @param Middleware[] $middlewares
         * @param callable     $last
         */
        public function __construct(array $middlewares, callable $last)
        {
            $this->pipeline = $this->create($middlewares, $last);
        }

        /**
         * Create execution pipeline
         *
         * @param Middleware[] $middlewares
         * @param callable     $next
         *
         * @throws InvalidMiddleware
         *
         * @return callable
         */
        protected function create(array $middlewares, callable $next)
        {
            while ($middleware = array_pop($middlewares)) {
                if ($middleware instanceof Middleware) {
                    $next = function ($message) use ($middleware, $next) {
                        return $middleware->execute($message, $next);
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
         * @param object $message
         *
         * @return mixed
         */
        public function invoke($message)
        {
            return call_user_func($this->pipeline, $message);
        }

    }

}

