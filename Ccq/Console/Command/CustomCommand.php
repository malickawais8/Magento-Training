<?php

declare(strict_types=1);

namespace RLTSquare\Ccq\Console\Command;

use Magento\Framework\MessageQueue\PublisherInterface;
use Psr\Log\LoggerInterface;
use RLTSquare\Ccq\Api\Data\QueueInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomCommand extends Command
{
    const Var1 = 'var1';
    const Var2 = 'var2';
    /**
     * @var PublisherInterface
     */
    protected PublisherInterface $publisher;
    /**
     * @var QueueInterface
     */
    protected QueueInterface $queue;
    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    public function __construct(
        LoggerInterface     $logger,
        QueueInterface $queue,
        PublisherInterface  $publisher,
        string              $name = null,
    ) {
        $this->publisher = $publisher;
        $this->queue = $queue;
        $this->logger = $logger;
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('rltsquare:hello:world');
        $this->setDescription('custom console command.');

        $this->addArgument(
            self::Var1,
            null,
            InputArgument::IS_ARRAY,
            'Var1'
        );
        $this->addArgument(
            self::Var2,
            null,
            InputArgument::IS_ARRAY,
            'Var2'
        );

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $exitCode = 0;
        $var1 = $input->getArgument(self::Var1);
        $var2 = $input->getArgument(self::Var2);
        $this->queue->setData(".$var1.$var2.");
        $this->publisher->publish('rltsquare_hello_world', $this->queue);
        $this->logger->info($var1 . $var2 . 'has been added');
        var_dump('Added message to queue');
        return $exitCode;
    }
}
