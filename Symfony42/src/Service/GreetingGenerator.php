<?php
namespace App\Service;


use Psr\Log\LoggerInterface;

class GreetingGenerator
{
    private LoggerInterface $logger;
    private string $language;

    public function __construct(LoggerInterface $logger, string $language)
    {
        $this->logger = $logger;
        $this->language = $language;
    }

    public function getGreeting(): string
    {
        $messages = $this->language=="ru"? ["Здравствуй", "Привет"]:["Hello","Hi" ];

        $index = array_rand($messages);
$this->logger->emergency("Selected greeting: ". $messages[$index]);
        return $messages[$index];
    }
}