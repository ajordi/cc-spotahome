<?php

namespace App\PL\Homes\Application\Find;

use App\PL\Homes\Domain\HomeRepository;
use App\Shared\Application\Bus\Query\Query;
use App\Shared\Domain\Exception\InvalidArgumentException;
use App\Shared\Infrastructure\Http\Url;

class FindHomesQuery implements Query
{
    public const ID = 'id';

    public const TITLE = 'title';

    public const URL = 'url';

    public const CITY = 'city';

    public const FIELDS = [self::ID, self::TITLE, self::URL, self::CITY];

    /** @var Url */
    private $url;

    /** @var string */
    private $field;

    /** @var string */
    private $direction;

    /**
     * @param Url $url
     * @param string $field
     * @param string $direction
     * @throws InvalidArgumentException
     */
    private function __construct(Url $url, string $field, string $direction)
    {
        $this->url = $url;
        $this->setField($field);
        $this->setDirection($direction);
    }

    public function url(): Url
    {
        return $this->url;
    }

    public function field(): string
    {
        return $this->field;
    }

    public function direction(): string
    {
        return $this->direction;
    }

    public static function fromArray(array $data): Query
    {
        return new self(
            new Url($data['url']),
            $data['field'],
            $data['direction'] ?? 3
        );
    }

    /**
     * @param string $field
     * @throws InvalidArgumentException
     */
    private function setField(string $field)
    {
        if (!in_array($field, self::FIELDS)) {
            throw new InvalidArgumentException(sprintf(
                'Got: %s, expected one of %s',
                $field,
                implode(', ', self::FIELDS)
            ));
        }
        $this->field = $field;
    }

    /**
     * @param string $direction
     * @throws InvalidArgumentException
     */
    private function setDirection(string $direction)
    {
        if (HomeRepository::ASC === $direction) {
            $this->direction = SORT_ASC;
        }

        if (HomeRepository::DESC === $direction) {
            $this->direction = SORT_DESC;
        }

        if (null === $this->direction) {
            throw new InvalidArgumentException(sprintf('%s is not a valid sorting direction', $direction));
        }
    }

    public function serialize(): array
    {
        return [
            'url' => $this->url()->value(),
            'field' => $this->field(),
            'direction' => $this->direction(),
        ];
    }
}
