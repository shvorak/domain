<?php

namespace Domain\Handler\Method
{

    use Domain\Handler;
    use Domain\MethodResolver;
    use Domain\Error\HandlerMethodNotFound;
    use Domain\Error\HandlerMethodNotCallable;

    /**
     * Class NamedMethodLocator
     *
     * @package Domain\Handler\Method
     */
    class NamedMethodResolver implements MethodResolver
    {

        /**
         * @inheritdoc
         */
        public function resolve($message, $handler)
        {
            $reflect = new \ReflectionClass($message);
            $unqualified = $reflect->getShortName();

            $prefix = 'handle';
            $method = $prefix . ucfirst($unqualified);

            if (false === method_exists($handler, $method)) {
                throw new HandlerMethodNotFound('Method ' . $method . ' not found in handler class');
            }

            $callable = [$handler, $method];

            if (false === is_callable($callable)) {
                throw new HandlerMethodNotCallable('Method ' . $method . ' not callable');
            }

            return new Handler($callable);
        }

    }

}

