<?php

declare(strict_types=1);

namespace Itmedia\DomainEvents\Tests\Stub;

use Itmedia\DomainEvents\Event\DomainEvent;

class Event extends DomainEvent
{


    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $payload;

    /**
     * Event constructor.
     * @param string $name
     * @param string $payload
     */
    public function __construct(string $name, string $payload)
    {
        $this->name = $name;
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }


}