<?php namespace Hive\Locator\Exception;

/**
 * Instance Exists Exception.
 *
 * Trying to create an instance, with the same name as an existing one.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class InstanceExists extends \Hive\Locator\Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 7;

    /**
     *  Exception Message to be displayed.
     */
    const MESSAGE = 'An Instance with that name (:instance) already exist, you can only have one instance of each name.';

    /**
     * Instance Exists constructor, assigns exception code the message.
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
