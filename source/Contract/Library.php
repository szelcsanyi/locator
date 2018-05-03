<?php namespace Hive\Locator\Contract;

/**
 * Library Interface.
 *
 * Interface for the library used as a contact.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
interface Library
{
    /**
     * Resolves a subject against the internal map, returning the legend for the object
     *
     * @param $subject
     *
     * @return \stdClass a object of the subjects legend values.
     */
    public function resolve($subject);//: \stdClass;
}
