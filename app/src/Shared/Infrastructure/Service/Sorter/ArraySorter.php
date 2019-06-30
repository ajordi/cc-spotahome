<?php

namespace App\Shared\Infrastructure\Service\Sorter;

class ArraySorter
{
    public static function fromMultiArray(string $column, array $arrayData, int $direction): array
    {
        $sortArray = array();

        foreach ($arrayData as $person) {
            foreach ($person as $key => $value) {
                if (!isset($sortArray[$key])) {
                    $sortArray[$key] = array();
                }
                $sortArray[$key][] = $value;
            }
        }
        array_multisort($sortArray[$column], $direction, $arrayData);

        return $arrayData;
    }
}
