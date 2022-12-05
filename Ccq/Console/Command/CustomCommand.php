<?php

declare(strict_types=1);

namespace RLTSquare\Ccq\Console\Command;

use Exception;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomCommand extends Command
{
    const Var1 = 'var1';
    const Var2 = 'var2';
    /**
     * @var SerializerInterface
     */
    protected SerializerInterface $serializer;
    /**
     * @var PublisherInterface
     */
    protected PublisherInterface $publisher;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     * @param PublisherInterface $publisher
     * @param SerializerInterface $serializer
     * @param string|null $name
     */
    public function __construct(
        LoggerInterface     $logger,
        PublisherInterface  $publisher,
        SerializerInterface $serializer,
        string              $name = null,
    ) {
        $this->publisher = $publisher;
        $this->logger = $logger;
        $this->serializer = $serializer;
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
        try {
            if (!empty($var1) && !empty($var2)) {
                $serialized_response = $this->serializer->serialize(["var1" => $var1, "var2" => $var2]);
                $this->publisher->publish('rltsquare_hello_world', $serialized_response);
                $this->logger->info($var1 . $var2 . 'has been added');
                $output->writeln("$var1 $var2 added to rltsquare_hello_world_queue");
            }
        } catch (Exception $e) {
            $output->writeln(
                sprintf(
                    '<error>%s</error>',
                    $e->getMessage()
                )
            );
        }
        return $exitCode;
    }
}
