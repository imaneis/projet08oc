<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase 
{
    public function testTaskConstructor()
    {
        $task = new Task();

        $this->assertSame((new \Datetime())->getTimestamp(), ($task->getCreatedAt())->getTmestamp(), 'createdAt should contains actual datetime');
        $this->assertSame(false, $task->isDone(), 'isDone should contains false');
    }
}