<?php


class UriParser implements ParserInterface
{
    /**
     * @var string
     */
    private string $content;

    /**
     * UriParser constructor.
     * @param string $content String to parse
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return array Parsing result
     */
    public function getResult(): array
    {
        $matches = [];
        if (!preg_match_all("#<a\s+(?:[^>]*?\s+)?href=\"(.*?)\"#", $this->content, $matches)) return [];
        return $matches[1];
    }
}