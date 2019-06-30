<?php

namespace App\PL\Homes\Domain;

use App\Shared\Infrastructure\Http\Url;

class Home
{
    /** @var HomeId */
    private $homeId;

    /** @var Title */
    private $title;

    /** @var Url */
    private $url;

    /** @var City */
    private $city;

    private function __construct(HomeId $homeId, Title $title, Url $url, City $city)
    {
        $this->homeId = $homeId;
        $this->title = $title;
        $this->url = $url;
        $this->city = $city;
    }

    public function homeId(): HomeId
    {
        return $this->homeId;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function url(): Url
    {
        return $this->url;
    }

    public function city(): City
    {
        return $this->city;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            new HomeId($data['id']),
            new Title($data['title']),
            new Url($data['url']),
            new City($data['city'])
        );
    }
}
