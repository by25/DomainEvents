<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

declare(strict_types=1);

namespace Itmedia\DomainEvents\Bridge;

use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Itmedia\DomainEvents\Dispatcher\DomainEventDispatcher;
use Itmedia\DomainEvents\Publisher\DomainEventPublisher;

class DoctrineDomainEventsHandler
{
    /**
     * @var DomainEventDispatcher
     */
    private $domainDispatcher;


    private $removedEntities = [];

    /**
     * DoctrineDomainEventsHandler constructor.
     *
     * @param DomainEventDispatcher $domainDispatcher
     */
    public function __construct(DomainEventDispatcher $domainDispatcher)
    {
        $this->domainDispatcher = $domainDispatcher;
    }


    public function preFlush(PreFlushEventArgs $args): void
    {
        $em = $args->getEntityManager();
        $this->removedEntities = $em->getUnitOfWork()->getScheduledEntityDeletions();
    }


    /**
     * Обработка Domain Events
     *
     * @param PostFlushEventArgs $args
     */
    public function postFlush(PostFlushEventArgs $args): void
    {
        $em = $args->getEntityManager();

        $identityMap = $em->getUnitOfWork()->getIdentityMap();

        foreach ($identityMap as $entities) {
            foreach ($entities as $entity) {
                if ($entity instanceof DomainEventPublisher) {
                    $this->domainDispatcher->dispatch($entity);
                }
            }
        }

        foreach ($this->removedEntities as $entity) {
            if ($entity instanceof DomainEventPublisher) {
                $this->domainDispatcher->dispatch($entity);
            }
        }
    }
}
