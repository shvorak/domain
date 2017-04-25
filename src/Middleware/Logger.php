<?php

namespace Domain\Middleware
{

    use Domain\Middleware;

    class Logger implements Middleware
    {

        /**
         * Wrap any message execution
         *
         * @param object   $message
         * @param callable $next
         *
         * @return mixed
         * @throws \Exception
         */
        function execute($message, callable $next)
        {
            $name = get_class($message);
            $story = $message instanceof \Domain\Message\Story ? $message->getStory() : '';

            $this->write($story, $name, 'Start handling');
            try {
                $data = $next($message);
                $this->write($story, $name, 'Handled successfully');
            } catch (\Exception $exception) {
                $this->write($story, $name, 'Failed to handle');
                throw $exception;
            }
            return $data;
        }

        protected function write($story, $name, $text)
        {
            $time = date('Y-m-d H:i:s');

            echo empty($story)
                ? "[{$time}] {$name} - {$text}\n"
                : "[{$time}] {$story} {$name} - {$text}\n";
        }
    }

}

