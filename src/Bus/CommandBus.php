<?php

namespace Domain\Bus
{

    use Domain\Bus;

    class CommandBus extends Bus implements CommandBusInterface
    {

        /**
         * @inheritdoc
         */
        public function execute($message)
        {

        }

    }

}

