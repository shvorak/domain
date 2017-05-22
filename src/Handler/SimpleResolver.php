<?php

namespace Domain\Handler
{

    use Domain\Error;
    use Domain\HandlerResolver;

    class SimpleResolver implements HandlerResolver
    {

        /**
         * @inheritdoc
         */
        public function resolve($class)
        {
            try {
                return new $class();
            } catch (\Exception $exception) {
                throw new \Exception(
                    'Can\'t instantiate handler class. Use ContainerResolver handlers with dependencies',
                    0,
                    $exception
                );
            }
        }

    }

}

