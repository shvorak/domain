<?php

namespace Domain\Bus
{

    /**
     * Interface QueryBusInterface
     *
     * @package Domain\Bus
     */
    interface QueryBusInterface
    {

        /**
         * Execute query handler for message
         *
         * @param object $message
         *
         * @return mixed
         */
        public function ask($message);

    }

}

