<?php

namespace Depotwarehouse\Streameroni;

use Illuminate\Support\Contracts\JsonableInterface;

class ChatMessage implements JsonableInterface
{

    /**
     * @var string
     */
    protected $messageString;

    /** @var  string */
    protected $author;

    public function __construct($author, $message)
    {
        $this->messageString = $message;
        $this->author = $author;
    }

    public function __toString()
    {
        return "{$this->author}: {$this->messageString}";
    }

    public function getMessage()
    {
        return $this->messageString;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode([ 'message' => $this->getMessage(), 'author' => $this->getAuthor() ]);
    }

    public static function fromJson($json_string) {
        $attributes = json_decode($json_string, true);

        // TODO error checking on correct object type
        return new ChatMessage($attributes['author'], $attributes['message']);
    }
}
