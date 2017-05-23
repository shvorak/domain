<?php

namespace Domain
{

    use Domain\Error\InvalidMiddleware;

    /**
     * Class Pipeline
     * @package Domain
     */
    class Pipeline
    {

        /**
         * Middlewares chain
         *
         * @var callable
         */
        private $pipeline;

        /**
         * Pipeline constructor.
         *
         * @param array    $middlewares
         * @param callable $handler
         */
        public function __construct(array $middlewares, callable $handler)
        {
            $this->pipeline = $this->create($middlewares, $handler);
        }

        /**
         * Create execution pipeline
         *
         * @param array    $middlewares
         * @param callable $next
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
         * Execute pipeline with message
         *
         * @param object $message
         *
         * @return mixed
         */
        public function execute($message)
        {
            return call_user_func($this->pipeline, $message);
        }

    }

}

