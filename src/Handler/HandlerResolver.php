<?php

namespace Domain\Handler
{

    use Domain\Message\NameExtractor;

    class HandlerResolver
    {

        /**
         * @var NameExtractor
         */
        private $nameResolver;

        /**
         * @var HandlerLocator
         */
        private $handlerLocator;

        /**
         * @var HandlerMethodLocator
         */
        private $methodLocator;

        /**
         * HandlerResolver constructor.
         *
         * @param NameExtractor        $nameResolver
         * @param HandlerLocator       $handlerLocator
         * @param HandlerMethodLocator $methodLocator
         */
        public function __construct(
            NameExtractor $nameResolver,
            HandlerLocator $handlerLocator,
            HandlerMethodLocator $methodLocator
        )
        {
            $this->nameResolver = $nameResolver;
            $this->handlerLocator = $handlerLocator;
            $this->methodLocator = $methodLocator;
        }

    }

}

