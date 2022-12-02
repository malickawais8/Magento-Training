<?php
declare(strict_types=1);

namespace RLTSquare\Ccq\Api\Data;

interface QueueInterface
{
    /**
     * @param string $data
     * @return void
     */
    public function setData(string $data): void;

    /**
     * @return string
     */
    public function getData(): string;

}
