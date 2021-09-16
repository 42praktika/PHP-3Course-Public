<?php


interface ParserInterface
{
  public function getResult(): array;
  public function __construct(string $content);
}