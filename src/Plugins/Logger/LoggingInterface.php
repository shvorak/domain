<?php

namespace Domain\Plugins\Logger
{

    use Psr\Log\LoggerInterface;

    interface LoggingInterface extends LoggerInterface
    {

        public function getLogs();

    }

}
