<?php

namespace Domain
{

    use Domain\Handler\HandlerLocator;
    use Domain\Handler\HandlerMethodLocator;
    use Domain\Handler\Message\ClassBasedName;
    use Domain\Handler\MessageNameExtractor;
    use Domain\Handler\Method\ClassNameMethodLocator;

    /**
     * Class BaseBus
     *
     * @package Domain
     */
    abstract class Bus
    {

        /**
         * @var Invoker
         */
        protected $invoker;

        /**
         * @var HandlerLocator
         */
        protected $handlerLocator;

        /**
         * @var HandlerMethodLocator
         */
        protected $handlerMethodLocator;

        /**
         * @var MessageNameExtractor
         */
        protected $messageExtractor;

        /**
         * BaseBus constructor.
         *
         * @param Middleware[]   $middlewares
         * @param HandlerLocator $locator
         *
         * @internal param HandlerLocator $handlerLocator
         */
        public function __construct(array $middlewares = [], HandlerLocator $locator)
        {
            $this->invoker = new Invoker($middlewares, function ($message) {
                return $this->process($message);
            });

            $this->handlerLocator = $locator;
            $this->handlerMethodLocator = new ClassNameMethodLocator();

            $this->messageExtractor = new ClassBasedName();
        }

        /**
         * Handle message
         *
         * @param object $message
         *
         * @return mixed
         */
        abstract protected function process($message);

    }

}

