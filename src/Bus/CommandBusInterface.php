<?php

namespace Domain\Bus
{

    /**
     * Interface CommandBusInterface
     * @package Domain\Bus
     */
    interface CommandBusInterface
    {

        /**
         * Execute command
         *
         * @param object $message
         *
         * @return mixed
         */
        public function execute($message);

    }

}
