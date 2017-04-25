<?php

namespace Domain
{

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
         * @param Middleware[] $middlewares
         * @param callable     $next
         *
         * @return callable|\Closure
         */
        protected function create(array $middlewares, callable $next)
        {
            while ($middleware = array_pop($middlewares)) {
                $next = function ($message) use ($middleware, $next) {
                    return $middleware->execute($message, $next);
                };
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

