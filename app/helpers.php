<?php

use Illuminate\Support\Str;

if (!function_exists('convertArrayAttributes')) {
    /**
     * Convert an array attributes to a specific case.
     *
     * @param mixed[] $array  Array to convert.
     * @param string $case  Case to convert to ("camel=default|snake|kebab|studly").
     * @param bool $recursive  If converting the attributes recursively.
     * @return mixed[]
     */
    function convertArrayAttributes(?array $array, $case = "camel", $recursive = true)
    {
        if (!is_array($array)) {
            return $array;
        }
        $newArray = [];
        foreach ($array as $key => $value) {
            if ($recursive && is_array($value)) {
                $value = convertArrayAttributes($value, $case, true);
            }
            if (is_string($key)) {
                $key = Str::$case($key);
            }
            $newArray[$key] = $value;
        }
        return $newArray;
    }
}
