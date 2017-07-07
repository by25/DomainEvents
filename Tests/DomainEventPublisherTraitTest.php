<?php

/**
 * (c) itmedia.by <info@itmedia.by>
 */

namespace Itmedia\DomainEvents\Tests;

use Itmedia\DomainEvents\Tests\Stub\Event;
use Itmedia\DomainEvents\Tests\Stub\Publisher;
use PHPUnit\Framework\TestCase;

class DomainEventPublisherTraitTest extends TestCase
{
    public function testPushEvent()
    {
        $publisher = new Publisher();

        $publisher->onEvent(new Event('event_name', 'test1'));
        $publisher->onEvent(new Event('event_name_2', 'test2'));

        $events = $publisher->releaseEvents();
        $this->assertCount(2, $events);

        $data = array_map(function (Event $event) {
            return [$event->getName(), $event->getPayload()];
        }, $events);

        $this->assertEquals([['event_name', 'test1'], ['event_name_2', 'test2']], $data);

        $events = $publisher->releaseEvents();
        self::assertCount(0, $events);
    }


    public function testPushSingleEvent()
    {
        $publisher = new Publisher();

        $publisher->onSingleEvent(new Event('event_name', 'test1'));
        $publisher->onSingleEvent(new Event('event_name', 'test1'));

        $events = $publisher->releaseEvents();
        $this->assertCount(1, $events);

        $data = array_map(function (Event $event) {
            return [$event->getName(), $event->getPayload()];
        }, $events);

        $this->assertEquals([['event_name', 'test1']], $data);

        $events = $publisher->releaseEvents();
        self::assertCount(0, $events);
    }
}
