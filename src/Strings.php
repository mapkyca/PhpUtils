<?php

namespace Mapkyca\PhpUtils;

class Strings
{

    /**
     * Validate whether a string is a UUID
     *
     * @param string $str
     * @return boolean
     */
    public static function is_uuid(string $str): bool
    {
        if (strlen($str) != 36) {
            return false;
        } else {
            $UUIDv4 = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
            if (preg_match($UUIDv4, $str) === 1) {
                return true;
            }
            $UUID = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i';
            if (preg_match($UUID, $str) === 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return whether a string starts and ends with a particular character
     *
     * @param string $string
     * @param string $char
     * @return boolean
     */
    public static function startsAndEndsWithChar(string $string, string $char): bool
    {
        $startsWithChar = (substr($string, 0, 1) === $char);
        $endsWithChar = (substr($string, -1) === $char);

        return ($startsWithChar && $endsWithChar);
    }

    /**
     * Tokenise a string based on first letter in a string where words are separated by an underscore.
     *
     * @param [type] $inputString
     * @return void
     */
    function firstLettersSeparatedByUnderscore($inputString)
    {
        // Split the input string into words based on underscores
        $words = explode('_', $inputString);
        $firstLetters = [];

        // Loop through each word and extract its first letter
        foreach ($words as $word) {

            // Check if the word is not empty
            if (!empty($word)) {
                // Extract the first letter
                $firstLetters[] = substr($word, 0, 1);
            }
        }

        return implode('', $firstLetters);
    }
}
