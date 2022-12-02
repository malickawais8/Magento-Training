<?php

declare(strict_types=1);

namespace RLTSquare\Ccq\Model\Queue;

use RLTSquare\Ccq\Api\Data\QueueInterface;

class Queue implements QueueInterface
{

    /**
     * @var string
     */
    protected string $data;

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return void
     */
    public function setData(string $data): void
    {
        $this->data = $data;
    }
}
