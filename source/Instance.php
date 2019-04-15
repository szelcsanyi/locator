<?php namespace Hive\Locator;

/**
 * Locator Instance.
 *
 * Allows access to the Locator through itself, and the ability to save an instance, for later use.
 *
 * @todo    This isn't an instance, its something else altogether. While is is storing a link to the singlton register
 *          each of the items must be constructed before we are able to access them.
 *
 * @todo    This might require a complete re-write to remove the quirky behaviour. 
 *
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class Instance extends Object implements Contract\Instance
{
    private static $objects;


    /**
     * Instance constructor.
     *
     * Thats right this instance has a non-static constructor. This was added for syntax sugar. 
     * 
     * $environment = new Locator\Instance('benchmark', $map); 
     *
     * @param $name
     * @param array $map
     * @param array $config
     * @throws Exception\InstanceExists
     */
    public function __construct($name, array $map, array $config = [])
    {
        if(! isset(self::$objects[$name]))
        {
            parent::__construct($map, $config);
            self::$objects[$name] = $this;
        }
        else
        {
            throw new Exception\InstanceExists($name);
        }
    }


    /**
     * Old Fashioned way to access the object.
     *
     * @depreciated the prefered method is via the callStatic.
     *
     * @param $name
     *
     * @return mixed
     * @throws Exception\InstanceDoesNotExist
     */
    public static function init($name)
    {
        return self::$name();
    }


    /**
     * Shortcut Method, for creating, parsing and saving the object in one call.
     * @param       $name
     * @param       $subject
     * @param array $data
     * @param array $config
     * @throws Exception\InstanceExists
     */
    public static function construct($name, $subject, array $data, array $config = [])
    {
        if (! isset(self::$object[$name]))
        {
            self::$objects[$name] = new Object($data, $config);
            self::$objects[$name]->parse($subject);
        }
        else
        {
            throw new Exception\InstanceExists($name);
        }
    }


    /**
     * Get access to an object through a static call.
     *
     * @param $name
     * @param $params
     *
     * @return mixed
     */
    public static function __callStatic($name, $params)
    {

        if (isset(self::$objects[$name]))
        {
            return self::$objects[$name];
        }
        else
        {
            throw new Exception\InstanceDoesNotExist($name);
        }
    }

}
