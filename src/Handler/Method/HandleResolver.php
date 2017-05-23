<?php

namespace Domain\Handler\Method
{

    use Domain\Error;
    use Domain\Handler;
    use Domain\MethodResolver;

    class HandleResolver implements MethodResolver
    {

        /**
         * Returns
         *
         * @param object $message
         * @param object $handler
         *
         * @throws Error\HandlerMethodNotFound
         * @throws Error\HandlerMethodNotCallable
         *
         * @return Handler
         */
        public function resolve($message, $handler)
        {
            return new Handler([$handler, 'handle']);
        }
    }

}

