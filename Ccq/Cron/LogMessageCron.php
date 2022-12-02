<?php
declare(strict_types=1);

namespace RLTSquare\Ccq\Cron;

use PHPUnit\Exception;
use Psr\Log\LoggerInterface;

class LogMessageCron
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     *
     * @return void
     */
    public function execute(): void
    {
        try {
            $this->logger->info('hello world from rltsquare_hello_world queue job');
        } catch (Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }
    }
}
