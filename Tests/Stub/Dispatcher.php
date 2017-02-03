<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents\Tests\Stub;

use Itmedia\DomainEvents\DomainEventDispatcher;
use Itmedia\DomainEvents\Publisher\DomainEventPublisher;

class Dispatcher implements DomainEventDispatcher
{
    private $events = [];

    public function dispatch(DomainEventPublisher $publisher)
    {
        $events = $publisher->releaseEvents();
        $this->events = array_merge($this->events, $events);
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

}