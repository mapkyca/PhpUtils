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
    public static function is_uuid(string $str) : bool
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
}
