<?php
declare(strict_types=1);

namespace RLTSquare\Ccq\Api\Data;

interface QueueInterface
{
    /**
     * @param  mixed $data
     * @return $this
     */
    public function setData(mixed $data);

    /**
     * @return mixed
     */
    public function getData(): mixed;
}

