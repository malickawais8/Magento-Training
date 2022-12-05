<?php
declare(strict_types=1);

namespace RLTSquare\Ccq\Model\Queue;

use PHPUnit\Exception;
use Psr\Log\LoggerInterface;

class Consumer
{

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param $json_response
     * @return void
     */
    public function processMessage($json_response): void
    {
        try {
            $this->logger->info($json_response . 'hello world from rltsquare_hello_world queue job...');
        } catch (Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }
    }
}
