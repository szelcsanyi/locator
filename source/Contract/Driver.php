<?php namespace Hive\Locator\Contract;

/**
 * Instance Interface.
 *
 * Interface for use with the instances.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
interface Driver
{
    public function compare($subject, $examine);// : bool;
}