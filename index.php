<?php
spl_autoload_register(function ($className) {require_once './app/classes/'.$className.'.inc';});

function getTaskId(): SystemCall {
    return new SystemCall(function (Task $task, Scheduler $scheduler) {
       $task->setSendValue($task->getTaskId());
       $scheduler->enqueue($task);

    });
}

function addTask(Generator $coroutine) {
    return new SystemCall(function (Task $task, Scheduler $scheduler) use ($coroutine) {
        $task->setSendValue($scheduler->newTask($coroutine));
        $scheduler->enqueue($task);

    });
}

function killTask(int $id) {
    return new SystemCall(function (Task $task, Scheduler $scheduler) use ($id) {
        $task->setSendValue($scheduler->killTask($id));
        $scheduler->enqueue($task);
    });
}

function childTask() {
    $tid = (yield getTaskId());
    while (true) {
        echo "Child task $tid still alive!\n";
        yield;
    }
}

function task() {
    $tid = (yield getTaskId());
    $childTid = (yield addTask(childTask()));

    for ($i = 1; $i <= 6; ++$i) {
        echo "Parent task $tid iteration $i.\n";
        yield;

        if ($i == 3) yield killTask($childTid);
    }
}

$scheduler = new Scheduler;
$scheduler->newTask(task());
$scheduler->run();