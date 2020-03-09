<?php

namespace Racoon\Core\Utility\Helper;

class StringHelper {

    public function __construct() {}

    /**
     * Return the first character of the string.
     */

    public function first(string $str) {
        return substr($str, 0, 1);
    }

    /**
     * Return the last character of the string.
     */

    public function last(string $str) {
        return substr($str, strlen($str) - 1, strlen($str));
    }

    /**
     * Cut string from an index position.
     */

    public function move(string $str, int $pos_start, int $pos_end = 0) {
        return substr($str, $pos_start, strlen($str) - $pos_end);
    }

    /**
     * Test if the two string is equal.
     */

    public function equal(string $str1, string $str2, bool $case_sensitive = false) {
        if($case_sensitive) {
            return $str1 === $str2;
        }
        else {
            return strtolower($str1) === strtolower($str2);
        }
    }

}