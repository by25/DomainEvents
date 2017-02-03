<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents\Publisher;

use Itmedia\DomainEvents\Event\DomainEvent;

trait DomainEventPublisherTrait
{
    /**
     * @var array
     */
    private $domainEvents = [];

    /**
     * Add domain event
     *
     * @param DomainEvent $event
     */
    protected function pushEvent(DomainEvent $event)
    {
        $this->domainEvents[] = $event;
    }

    /**
     * Return published domain events
     *
     * @return DomainEvent[]
     */
    public function releaseEvents()
    {
        $events = $this->domainEvents;
        $this->domainEvents = [];

        return $events;
    }
}
