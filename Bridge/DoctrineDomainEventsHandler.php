<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents\Bridge;

use Doctrine\ORM\Event\PostFlushEventArgs;
use Itmedia\DomainEvents\Dispatcher\DomainEventDispatcher;
use Itmedia\DomainEvents\Publisher\DomainEventPublisher;

class DoctrineDomainEventsHandler
{
    /**
     * @var DomainEventDispatcher
     */
    private $domainDispatcher;

    /**
     * DoctrineDomainEventsHandler constructor.
     *
     * @param DomainEventDispatcher $domainDispatcher
     */
    public function __construct(DomainEventDispatcher $domainDispatcher)
    {
        $this->domainDispatcher = $domainDispatcher;
    }


    /**
     * Обработка Domain Events
     *
     * @param PostFlushEventArgs $args
     */
    public function postFlush(PostFlushEventArgs $args)
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
    }
}
