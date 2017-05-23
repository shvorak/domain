<?php

namespace Domain\Handler\Method
{

    use Domain\Error;
    use Domain\Handler;
    use Domain\MethodResolver;

    class InvokeResolver implements MethodResolver
    {

        /**
         * @inheritdoc
         */
        public function resolve($message, $handler)
        {
            $callable = [$handler, '__invoke'];

            if (false === is_callable($callable)) {
                throw new Error\HandlerMethodNotCallable();
            }

            return new Handler($callable);
        }

    }

}

