<?php namespace Hive\Locator\Exception;

/**
 * Undefined Property Exception.
 *
 * Attempted to call a property which does not exist.
 * This Exception exists to handle invalid calls with in __get()
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class UndefinedProperty extends \Hive\Locator\Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 5;

    /**
     *  Exception Message to be displayed.
     */
    const MESSAGE = 'Undefined property :class:::property';

    /**
     * Undefined Property constructor, assigns exception code the message.
     *
     * Will also place the name of the class into the exception message if we have it.
     * @param string $class the class which was called
     * @param string $property the property which doesn't exist
     */
    public function __construct($class, $property)
    {
        $code = self::CODE;

        $message = strtr(self::MESSAGE, [':class' => $class, ':property' => $property]);

        parent::__construct($message, $code);

    }



}