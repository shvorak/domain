<?php

namespace Domain\Plugins
{

    use Domain\Middleware;
    use Domain\Plugins\Logger\LoggingInterface;

    class Logger implements Middleware
    {

        /**
         * @inheritdoc
         */
        function execute($message, $handler, callable $next)
        {
            $logger = $this->getLogger($message);

            $logger('INFO', 'Start handling');

            try {
                $result = $next();

//                if ($handler instanceof LoggingInterface) {
//                    array_map($logger, $handler->getLogs());
//                }

                $logger('INFO', 'Handled successfully');
            } catch (\Exception $exception) {
                $logger('ERROR', 'Failed to handle');
                throw $exception;
            }
            return $result;
        }

        /**
         * @param $message
         *
         * @return \Closure
         */
        protected function getLogger($message)
        {
            $name = get_class($message);
            $story = $message instanceof Story ? $message->getStory() : '';

            return function ($level, $message, array $context = []) use ($name, $story) {
                $time = date('Y-m-d H:i:s');
                $level = strtoupper($level);

                echo empty($story)
                    ? "$level [{$time}] {$name} - {$message}\n"
                    : "$level [{$time}] {$story} {$name} - {$message}\n";
            };
        }

    }

}

