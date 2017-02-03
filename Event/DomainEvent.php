<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents\Event;

use Symfony\Component\EventDispatcher\Event;

abstract class DomainEvent extends Event
{
    /**
     * Domain event name
     *
     * @return string
     */
    abstract public function getName();
}
