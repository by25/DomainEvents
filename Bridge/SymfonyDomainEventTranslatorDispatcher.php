<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents\Bridge;

use Itmedia\DomainEvents\Dispatcher\DomainEventDispatcher;
use Itmedia\DomainEvents\Publisher\DomainEventPublisher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SymfonyDomainEventTranslatorDispatcher implements DomainEventDispatcher
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * SymfonyEventTranslatorDispatcher constructor.
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }


    public function dispatch(DomainEventPublisher $publisher)
    {
        $events = $publisher->releaseEvents();
        foreach ($events as $event) {
            $this->dispatcher->dispatch($event->getName(), $event);
        }
    }
}
