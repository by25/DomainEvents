<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents\Bridge;

use Itmedia\DomainEvents\Dispatcher\DomainEventDispatcher;
use Itmedia\DomainEvents\Publisher\DomainEventPublisher;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SymfonyDomainEventTranslatorDispatcher implements DomainEventDispatcher
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var boolean
     */
    private $debug;

    /**
     * SymfonyDomainEventTranslatorDispatcher constructor.
     * @param EventDispatcherInterface $dispatcher
     * @param LoggerInterface $logger
     * @param bool $debug
     */
    public function __construct(EventDispatcherInterface $dispatcher, LoggerInterface $logger = null, $debug = false)
    {
        $this->dispatcher = $dispatcher;
        $this->logger = $logger;
        $this->debug = $debug;
    }


    public function dispatch(DomainEventPublisher $publisher)
    {
        $events = $publisher->releaseEvents();
        foreach ($events as $event) {
            $this->dispatcher->dispatch($event->getName(), $event);

            if ($this->debug && $this->logger) {
                $this->logger->info('Pushed domain event "{event}"', [
                    'event' => $event->getName()
                ]);
            }
        }
    }
}
