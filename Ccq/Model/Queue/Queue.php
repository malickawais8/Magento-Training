<?php

declare(strict_types=1);

namespace RLTSquare\Ccq\Model\Queue;

class Queue implements \RLTSquare\Ccq\Api\Data\QueueInterface
{

    /**
     * @var mixed
     */
    protected mixed $data;

    /**
     * @inheriDoc
     */
    public function setData(mixed $data)
    {
        $this->data = $data;
    }

    /**
     * @inheriDoc
     */
    public function getData(): mixed
    {
        return $this->data;
    }
}

