<?php namespace Hive\Locator\Driver;


/**
 * Simple Locator Library Driver.
 *
 * Handles a comparison for the locator library,
 * by doing a case insensitive, whitespace insensitive comparision.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class Simple implements \Hive\Locator\Contract\Driver
{

    /**
     * Does a simple (case insensitive, whitespace insensitive) comparision.
     *
     * @param $examine string The string to search for
     * @param $subject string the string to search
     *
     * @return bool whether or not the string was found
     */
    public function compare($examine, $subject) : bool
    {
        return trim(strtolower($examine)) == trim(strtolower($subject));
    }

}