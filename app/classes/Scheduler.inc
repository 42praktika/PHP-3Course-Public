<?php


class Scheduler
{
    protected array $taskMap = [];
    protected int $maxTaskId = 0;
    protected SplQueue $queue;

    public function __construct()
    {
        $this->queue = new SplQueue();
    }

    public function newTask(Generator $coroutine): int
    {
        $tid = ++$this->maxTaskId;
        $task = new Task($tid, $coroutine);
        $this->taskMap[$tid] = $task;
        $this->enqueue($task);
        return $tid;
    }

    public function enqueue(Task $task)
    {
        $this->queue->enqueue($task);
    }

    public function run()
    {
        while (!$this->queue->isEmpty()) {
            /**
             * @var Task $task
             */
            $task = $this->queue->dequeue();

            $retval = $task->run();
            if ($retval instanceof SystemCall) {
                $retval($task, $this);
                continue;
            }


            if ($task->isFinished()) {
                unset($this->taskMap[$task->getTaskId()]);
            } else {
                $this->enqueue($task);
            }
        }
    }

    public function killTask(int $id)
    {
        if (!isset($this->taskMap[$id])) {return false;}
        unset($this->taskMap[$id]);
        foreach ($this->queue as $i=>$task) {
            if ($task->getTaskId() === $id) {
                unset($this->queue[$i]);
                break;
            }

        }
        return true;
    }

}