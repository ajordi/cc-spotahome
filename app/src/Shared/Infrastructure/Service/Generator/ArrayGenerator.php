<?php

namespace App\Shared\Infrastructure\Service\Generator;

use SimpleXMLElement;

class ArrayGenerator
{
    public static function fromXML(SimpleXMLElement $xml, array $columns = null): array
    {
        $count = 0;
        $arrayData = [];

        foreach ($xml as $item) {
            $properties = $columns ?? array_keys(get_object_vars($item));
            $data = [];
            foreach ($properties as $property) {
                $data[$property] = (string) $item->{$property};
            }
            $arrayData[] = $data;

            $count++;
        }

        return $arrayData;
    }
}
