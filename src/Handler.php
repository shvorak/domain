<?php

namespace Domain
{

    /**
     * Class Handler
     * @package Domain
     */
    class Handler
    {

        /**
         * @var callable
         */
        private $handler;

        /**
         * Handler constructor.
         *
         * @param callable $handler
         */
        public function __construct(callable $handler)
        {
            $this->handler = $handler;
        }

        /**
         * Execute message handler
         *
         * @param object $message
         *
         * @return mixed
         */
        public function handle($message)
        {
            return call_user_func($this->handler, $message);
        }

    }

}

