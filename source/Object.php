<?php namespace Hive\Locator;

/**
 * Object Library.
 *
 * Allows access to the library through an object and adds the ability to call aliases, legends and current.
 * Which can be called either through properties or methods. Also adds the ability to access other items with in the map.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class Object extends Library implements Contract\Object
{

    /**
     * Default configuration settings.
     *
     * @var array config default object configuration for the library.
     * @var array ['legend'] : array : Legend used to create the map, ie. what to call each of the array keys (in order)
     * @var array ['aliases'] : array : Alias to the legend as methods $environment->in('staging'); $environment->is('domain.com.au');
     * @var array ['driver'] : string|object : The driver which will compare our value to see if it is a match
     * @var array ['current'] : array : Allow access to the current result from these names;
     * @var array ['access'] : array : Whether to allow access to the result through method calls, property calls or a 'current'.
     * @var array ['current'] : array : Any names which to allow access to the current result.
     */
    private $config = [
        'legend'    => ['server', 'type', 'domain'],
        'aliases'   => ['in' => 'server', 'as' => 'type', 'is' => 'domain'],
        'driver'    => 'Hive\Locator\Driver\Simple',
        'access'    => ['method' => true, 'property' => true, 'current' => true],
        'current'   => ['current']
    ];


    /**
     * Object constructor.
     *
     * Merge the object config with the libraries
     *
     * @param array $map
     * @param array $config
     */
    public function __construct(array $map, array $config = [])
    {

        // Merge the received config with the defaults
        $config = array_merge($this->config, $config);

        parent::__construct($map, $config);
    }


    /**
     * Will allow access to the result through properties.
     *
     * Allows access to the result, through property calls on the object,
     * depending on config, it can allow access via the legend, current or alias.
     * @param $name
     *
     * @return bool|object
     * @throws Exception\UndefinedProperty
     */
    public function __get($name)
    {
        // If magic properties are turned on
        if ($this->config['access']['property'])
        {
            // If we have a value, return it
            if ($value = $this->magic($name)) {
                return $value;
            }
        }

        // Throw a Bad Method call as the method wasn't found.
        throw new Exception\UndefinedProperty(__CLASS__, $name);
    }


    /**
     * Will allow access to the result through a method call.
     *
     * Allows access to the result through a method call on the object, depending on the config.
     * It can allow access via the legend, current or alias. To enable, ensure that 'method is with in Config['access'].
     *
     * If an argument is sent to, it will compare the argument with the result and return a true/false boolean.
     *
     * @param $name
     * @param $arguments
     *
     * @return bool|object
     * @throws Exception\BadMethodCall
     * @throws Exception\UnresolvedLegend
     */
    public function __call($name, $arguments)
    {
        // If magic methods are turned on
        if ($this->config['access']['method'])
        {
            // If we have a value
            if ($value = $this->magic($name))
            {
                // If there was an argument sent in, compare the values.
                if (isset($arguments[0]))
                {
                    $value = ($value == $arguments[0]);
                }

                return $value;
            }
        }

        // Throw a Bad Method call as the method wasn't found.
        throw new Exception\BadMethodCall(__CLASS__, $name);
    }


    /**
     * Method used to find items from their legend, alias or current.
     *
     * @param $name
     *
     * @return bool|object
     * @throws Exception\UnresolvedLegend
     */
    private function magic($name)
    {
        // Make sure we have a result
        if ($this->status)
        {
            // If the current property is set and the called property, return the current result.
            if (in_array($name, $this->config['current']))
            {
                return (object) $this->result;
            }

            // Return the current item directly by a call to its legend property
            if (in_array($name, $this->config['legend']))
            {
                return $this->result[$name];
            }

            // Return the current item directly by a call to its alias
            if (in_array($name, array_keys($this->config['aliases'])))
            {
                // Find what legend we are looking for from the alias
                $legend = $this->config['aliases'][$name];
                return $this->result[$legend];
            }

            return false; #:(
        }
        else
        {
            // You can not us ean alias with an unresolved legend.
            throw new Exception\UnresolvedLegend();
        }
    }


    /**
     * Will get the value of items other then the current.
     *
     * Does a fuzzy search, based upon the parameters, any which are sent in as config['current'] it will use the current result.
     *
     * @return \stdClass
     * @throws Exception\UndefinedMapping
     * @throws Exception\UnresolvedLegend
     */
    public function get()
    {
        // Make sure we have a result
        if ($this->status)
        {
            $args = func_get_args();

            $result = $this->map;

            $legends = $this->config['legend'];

            // We don't need the last item, which is the 'result', we add it at the end.
            array_pop($legends);

            // loop through all of the legends and assign them based of the args
            for ($i=0; $i<count($legends); $i++)
            {
                if (isset($args[$i]) && !in_array($args[$i], $this->config['current']))
                {
                    // If the item exists with in our result, use it otherwise throw an exception
                    if (isset($result[$args[$i]]))
                    {
                        $result = $result[$args[$i]];
                        //$map[$legends[$i]] = $args[$i];
                    }
                    else
                    {
                        // There is no mapping of that name, throw an exception.
                        throw new Exception\UndefinedMapping($legends[$i], $args[$i]);
                    }
                }
                else
                {
                    $result = $result[$this->result[$legends[$i]]];
                    $map[$legends[$i]] = $this->result[$legends[$i]];
                }
            }

            $map[end($this->config['legend'])] = $result;

            return (object) $map;
        }
        else
        {
            // You can not us ean alias with an unresolved legend.
            throw new Exception\UnresolvedLegend();
        }
    }
}
