<?php

interface SchedulerInterface
{
    /*
     * add an request to task
     */
    public function push(Task $task, Request $request);

    /*
     * get an url
     */
    public function poll(Task $task):Task;
}