<?php namespace Hive\Locator\Exception;

/**
 * Invalid Driver Exception.
 *
 * The comparison driver must be an instance of the Hive\Locator\Contract\Driver
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class UnresolvedLegend extends \Hive\Locator\Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 4;

    /**
     *  Exception Message to be displayed.
     */
    const MESSAGE = 'Unresolved Legend, the legend must be resolved prior to calling.';

    /**
     * Incomplete Legend constructor, assigns exception code the message.
     *
     * Will also place the name of the class into the exception message if we have it.
     * @param string|object  Driver the driver which was
     */
    public function __construct()
    {
        $code = self::CODE;

        parent::__construct(self::MESSAGE, $code);
    }
}
