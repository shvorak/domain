<?php

namespace Domain\Bus
{

    /**
     * Interface EventBusInterface
     *
     * @package Domain\Bus
     */
    interface EventBusInterface
    {

        /**
         * Emit event object
         *
         * @param object $event
         *
         * @return void
         */
        public function emit($event) : void;

    }

}
