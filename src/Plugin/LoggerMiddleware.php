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
         * LoggerMiddleware constructor.
         *
         * @param LoggerInterface $logger
         */
        public function __construct(LoggerInterface $logger)
        {
            $this->logger = $logger;
        }

        /**
         * Wrap any message execution
         *
         * @param object   $message
         * @param callable $next
         *
         * @return mixed|void
         */
        function execute($message, callable $next)
        {
            $this->logger->info('Starting to processing ' . get_class($message));
            try {
                $next($message);
                $this->logger->info('Completed processing ' . get_class($message));
            } catch (\Exception $exception) {
                $this->logger->error($exception->getMessage());
            }
        }
    }

}

