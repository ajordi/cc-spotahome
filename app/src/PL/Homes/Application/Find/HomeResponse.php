<?php

namespace App\PL\Homes\Application\Find;

use App\Shared\Application\Bus\Query\Response;

class HomeResponse implements Response
{
    /** @var int */
    private $id;

    /** @var string */
    private $title;

    /** @var string */
    private $url;

    /** @var string */
    private $city;

    public function __construct(int $id, string $title, string $url, string $city)
    {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->city = $city;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'url' => $this->url(),
            'city' => $this->city(),
        ];
    }
}
