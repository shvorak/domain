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
    class MessageNameResolver implements MethodResolver
    {

        /**
         * @var string
         */
        private $prefix;

        /**
         * @var string
         */
        private $suffix;

        /**
         * @var int
         */
        private $suffixLength;

        /**
         * MessageNameResolver constructor.
         *
         * @param string $prefix
         * @param string $suffix
         */
        public function __construct($prefix = 'handle', $suffix = '')
        {
            $this->suffix = $suffix;
            $this->suffixLength = strlen($suffix);
            $this->prefix = $prefix;
        }

        /**
         * @inheritdoc
         */
        public function resolve($message, $handler)
        {
            $reflect = new \ReflectionClass($message);
            $unqualified = $reflect->getShortName();

            $method = $this->prefix . ucfirst($unqualified);

            if (substr($method, $this->suffixLength * -1) === $this->suffix) {
                $method = substr($method, 0, strlen($method) - $this->suffixLength);
            }

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

