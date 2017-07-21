<?php namespace Hive\Locator\Exception;

/**
 * Instance Does Not Exist Exception.
 *
 * Trying to access an instance which does not exist.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class InstanceDoesNotExist extends \Hive\Locator\Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 8;

    /**
     *  Exception Message to be displayed.
     */
    const MESSAGE = 'The instance (:instance) does not exist, before accessing an instance you must first create it.';

    /**
     * Instance Exist constructor, assigns exception code the message.
     *
     * Will also place the name of the class into the exception message if we have it.
     * @param string|object  Driver the driver which was
     */
    public function __construct($instance)
    {
        $code = self::CODE;

        $message = strtr(self::MESSAGE, [':instance' => $instance]);

        parent::__construct($message, $code);
    }
}
