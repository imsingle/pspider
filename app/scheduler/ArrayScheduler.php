<?php

/**
 * Date: 17/1/24
 * Time: 下午1:03
 */
class ArrayScheduler implements SchedulerInterface
{
    private $queue = [];

    private $queueUsed = [];

    public function push(Task $task, Request $request)
    {
        $this->queue[] = $request;
    }

    public function pushWithUnDuplicate(Task $task, Request $request) {
        if (empty($this->queueUsed[$request])) {
            $this->push($task, $request);
        }
    }

    public function poll(Task $task):Task
    {
        return array_shift($this->queue);
    }
}