<?php

namespace Domain\Bus
{

    use Domain\Bus;

    /**
     * Class CommandBus
     *
     * @package Domain\Bus
     */
    class CommandBus extends Bus
    {

        /**
         * Execute command handler
         *
         * @param object $message
         *
         * @return mixed
         */
        public function execute($message)
        {
            return $this->invoker->__invoke($message);
        }

        /**
         * Handle message
         *
         * @param object $message
         *
         * @return mixed
         */
        protected function process($message)
        {
            echo 'TODO : Add handling' . PHP_EOL;
        }

    }

}

