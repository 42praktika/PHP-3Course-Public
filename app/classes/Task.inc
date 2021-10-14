<?php


class Task
{
    protected int $taskId;
    protected Generator $coroutine;

    public function __construct(
        int $taskId,
        Generator $coroutine,
        protected mixed $sendValue = null,
        protected bool $beforeFirstYield = true
    ) {
        $this->taskId = $taskId;
        $this->coroutine = $coroutine;
    }

    public function getTaskId(): int
    {
        return $this->taskId;
    }

    public function isFinished(): bool
    {
        return !$this->coroutine->valid();
    }

    public function run()
    {
        if ($this->beforeFirstYield) {
            $this->beforeFirstYield = false;
            return $this->coroutine->current();
        }
        $ret = $this->coroutine->send($this->sendValue);
        $this->setSendValue(null);
        return $ret;
    }

    public function setSendValue(mixed $sendValue)
    {
        $this->sendValue = $sendValue;
    }

}