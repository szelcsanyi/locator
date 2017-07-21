<?php namespace Hive\Locator\Exception;

/**
 * Incomplete Legend Exception.
 *
 * The Legend and the Mapping do not match, the 'depth' of the map, needs to be the count of the legend.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class IncompleteLegend extends \Hive\Locator\Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 1;

    /**
     *  Exception Message to be displayed.
     */
    const MESSAGE = 'The Legend and mapping do not match, each level of the map (array depth) must have a corresponding item in the legend.';

    /**
     * Incomplete Legend constructor, assigns exception code the message.
     *
     * Will also place the name of the class into the exception message if we have it.
     *
     */
    public function __construct()
    {
        $code = self::CODE;
        $message = self::MESSAGE;

        parent::__construct($message, $code);
    }
}
