<?php namespace Hive\Locator\Driver;

/**
 * Regular Expression Locator Library Driver.
 *
 * Handles a comparison for the locator library,
 * By doing a regular expression comparision.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class Expression implements \Hive\Locator\Contract\Driver
{

    /**
     * Does a regular expression comparision.
     *
     * @param $pattern string the pattern to search for
     * @param $subject string the subject to search
     *
     * @return bool whether or not one or more matches were found
     */
    public function compare($pattern, $subject) : bool
    {
        preg_match($subject, $subject, $matches);
        return (isset($matches) && count($matches));
    }

}