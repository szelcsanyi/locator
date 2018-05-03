<?php namespace Hive\Locator\Exception;

/**
 * Undefined Mapping Exception.
 *
 * Attempted to call a item in the map which does not exist.
 * This Exception exists to handle invalid calls with in get()
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class UndefinedMapping extends \Hive\Locator\Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 6;

    /**
     *  Exception Message to be displayed.
     */
    const MESSAGE = 'Undefined Mapping, ":map" does not exist with in ":legend".';

    /**
     * Undefined Mapping constructor, assigns exception code the message.
     *
     * Will also place the name of the class into the exception message if we have it.
     * @param string $legend the name of the legend we are searching
     * @param string $map the name of the map we are looking for
     */
    public function __construct($legend, $map)
    {
        $code = self::CODE;

        $message = strtr(self::MESSAGE, [':legend' => $legend, ':map' => $map]);

        parent::__construct($message, $code);

    }
}
