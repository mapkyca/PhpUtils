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
     * Encode a url to something which can be put in an email
     *
     * @param string $url
     * @return string
     */
    public static function encodeUrlForEmail(string $url) :string {
        // Use rawurlencode to encode the URL
        $encodedUrl = rawurlencode($url);
    
        // Since rawurlencode encodes all characters, decode only the / character
        $encodedUrl = str_replace('%2F', '/', $encodedUrl);
        $encodedUrl = str_replace('%3A', ':', $encodedUrl);
    
        return $encodedUrl;
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
    public static function firstLettersSeparatedByUnderscore($inputString)
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

    /**
     * Convert HTML content to plain text, ignoring script and style elements.
     *
     * @param string $html
     * @return string
     */
    public static function textFromHtml(string $html): string
    {
        $html = trim($html);
        if (empty($html)) {
            return '';
        }

        // Create a new DOMDocument
        $doc = new DOMDocument();

        // Load HTML (suppress warnings for malformed HTML)
        libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        libxml_clear_errors();

        // Extract all text
        $xpath = new DOMXPath($doc);
        $textNodes = $xpath->query('//text()');

        $textContent = '';
        foreach ($textNodes as $node) {
            // Ignore script and style content
            if (!in_array($node->parentNode->nodeName, ['script', 'style'])) {
                $textContent .= strtolower($node->nodeValue) . ' ';
            }
        }

        return $textContent;
        
    }
}
