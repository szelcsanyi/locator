<?php namespace Hive\Locator\Driver;

/**
 * Strict Locator Library Driver.
 *
 * Handles a comparison for the locator library,
 * by doing a case, space and type sensitive comparision.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class Strict implements \Hive\Locator\Contract\Driver
{

    /**
     * Does a strict (case, space and type sensitive) comparision.
     *
     * @param $examine mixed the item to search for
     * @param $subject mixed the item the search
     *
     * @return bool whether or not the two arguments are strictly equal
     */
    public function compare($examine, $subject) : bool
    {
        return $examine == $subject;
    }

}