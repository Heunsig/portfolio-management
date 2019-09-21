<?php
namespace App\Http\Controllers\API\helpers;

class Converter {
    public static function hasProperty ($object, $property) {
        foreach ($object as $key => $value) {
            if ($key == $property) {
                return true;
            }
        }

        return false;
    }

    public static  function filterProperty ($elements, $value) {
        $result = [];
        foreach($elements as $element) {
            if (self::hasProperty($value, $element)) {
                $result[$element] = $value[$element];
            }
        }

        return $result;
    }

    public static function makeResult ($value, $onlyQuery) {
        $result = [];

        if ($value) {
            $value = $value->toArray();

            if ($onlyQuery) {
                $elementsToFilter = explode(',', $onlyQuery);

                $result = self::filterProperty($elementsToFilter, $value);
            } else {
                $result = $value;
            }
        }


        return $result;
    }
} 