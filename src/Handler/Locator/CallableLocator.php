<?php

namespace Domain\Handler\Locator
{

    use Domain\Handler\HandlerLocator;

    class CallableLocator implements HandlerLocator
    {

        /**
         * @var callable
         */
        private $getter;

        /**
         * CallableLocator constructor.
         *
         * @param callable $getter
         */
        public function __construct(callable $getter)
        {
            $this->getter = $getter;
        }

        /**
         * @inheritdoc
         */
        public function get($message)
        {
            return call_user_func($this->getter, $message);
        }
    }

}

