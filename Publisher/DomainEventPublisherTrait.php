<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

declare(strict_types=1);

namespace Itmedia\DomainEvents\Publisher;

use Itmedia\DomainEvents\Event\DomainEvent;

trait DomainEventPublisherTrait
{
    /**
     * @var DomainEvent[]
     */
    private $domainEvents = [];

    /**
     * Add domain event
     *
     * @param DomainEvent $event
     */
    protected function pushEvent(DomainEvent $event): void
    {
        $this->domainEvents[] = $event;
    }


    /**
     * Add single event
     *
     * @param DomainEvent $event
     */
    protected function pushSingleEvent(DomainEvent $event):void
    {
        foreach ($this->domainEvents as $domainEvent) {
            if ($domainEvent->getName() === $event->getName()) {
                return;
            }
        }

        $this->pushEvent($event);
    }

    /**
     * Return published domain events
     * @return DomainEvent[]
     */
    public function releaseEvents(): array
    {
        $events = $this->domainEvents;
        $this->domainEvents = [];

        return $events;
    }
}
