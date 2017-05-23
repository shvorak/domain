<?php

namespace Domain\Plugin
{

    use Domain\Middleware;
    use Psr\Log\LoggerInterface;

    class LoggerMiddleware implements Middleware
    {

        /**
         * @var LoggerInterface
         */
        private $logger;

        /**
         * @var bool
         */
        private $silent;

        /**
         * LoggerMiddleware constructor.
         *
         * @param LoggerInterface $logger
         * @param bool            $silent
         */
        public function __construct(LoggerInterface $logger, bool $silent = false)
        {
            $this->logger = $logger;
            $this->silent = $silent;
        }

        /**
         * Wrap any message execution
         *
         * @param object   $message
         * @param callable $next
         *
         * @throws \Exception
         *
         * @return mixed
         */
        function execute($message, callable $next)
        {
            $this->logger->info('Starting to processing ' . get_class($message));
            try {
                $result = $next($message);
                $this->logger->info('Completed processing ' . get_class($message));

                return $result;
            } catch (\Exception $exception) {
                $this->logger->error($exception->getMessage());

                if (false === $this->silent) {
                    throw $exception;
                }
            }
        }
    }

}

