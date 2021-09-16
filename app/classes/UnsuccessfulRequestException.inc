<?php


class UnsuccessfulRequestException extends Exception
{
    private int $httpCode;

    private string $httpReason;

    /**
     * UnsuccessfulRequestException constructor.
     * @param string $message
     * @param int $getStatusCode
     * @param string $getReasonPhrase
     */
    public function __construct(string $message, int $getStatusCode=-1, string $getReasonPhrase="")
    {
        $this->httpCode = $getStatusCode;
        $this->httpReason = $getReasonPhrase;
        parent::__construct($message);
    }

    /**
     * @return string
     */
    public function getHttpReason(): string
    {
        return $this->httpReason;
    }

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }
}