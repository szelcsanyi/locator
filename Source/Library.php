<?php namespace Hive\Locator;


use Hive\Locator\Contract;
use Hive\Locator\Driver;

/**
 * Locator Library.
 *
 * The actual Locator library, which does the core operations.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class Library implements Contract\Library
{


    /**
     * Contract which a driver must implement. (Magic Value)
     */
    const DRIVER_CONTRACT = 'Hive\Locator\Contract\Driver';


    /**
     * The array or 'map' upon which to parse
     * @var array Must be an associative array
     */
    public $map = [];

    /**
     * Default configuration settings.
     * @var array ['legend'] : array : Legend used to create the map, ie. what to call each of the array keys (in order)
     * @var array ['aliases'] : array : Alias to the legend as methods $environment->in('staging'); $environment->is('domain.com.au');
     * @var array ['driver'] : s108tring|object : The driver which will compare our value to see if it is a match
     */
    private $config = [
        'legend'    => ['server', 'type', 'domain'],
        'driver'    => 'Hive\Locator\Driver\Simple'
    ];

    /**
     * Status of whether or not we have found a result
     * @var bool
     */
    public  $status = false;


    /**
     * The result of the map/legend, used while we build it up.
     * @var array
     */
    public $result = [];

    /**
     * Comparison driver object
     * @var bool|object
     */
    protected $driver = false;

    /**
     * The item to look for.
     * @var string
     */
    private $subject = false;

    /**
     * Let the magic begin, assign our map and set our configuration
     *
     * @throws Exception\InvalidDriver
     *
     * @param array $map        The actual environment mapping
     * @param array $config     Configuration settings for this class
     */
    public function __construct(array $map, array $config = [])
    {

        // Map needs to be defined on creation.
        $this->map = $map;

        // Merge the received config with the defaults
        $this->config = array_merge($this->config, $config);

        // Create the driver object if it hasn't been created already
        if (!is_object($this->config['driver'])) {
            $this->driver = new $this->config['driver']();
        }

        // Gigo Check that the driver implements the driver interface
        if (! in_array(self::DRIVER_CONTRACT, class_implements($this->driver) )  )  {

            throw new Exception\InvalidDriver($this->config['driver']);
        }
    }

    /**
     * Takes a subject and resolves it against the legend, returns the map information as a result
     *
     * @param mixed $subject the subject to search the map for and assign the result
     *
     * @return \stdClass of the result, with correct map assigned or false if it doesn't exist
     */
    public function resolve($subject)//  :  \stdClass
    {
        // Reset the status to false, as we are about the parse a new value
        $this->status = false;

        // Assign the subject to search for
        $this->subject = $subject;

        // Parse the map
        if ($this->parse($this->map)) {

            // Convert the result into an object and return
            return (object) ($this->result);

        } else {

            // return the result with all false values
            return (object) array_fill_keys($this->config['legend'], false);
        }
    }


    /**
     * Parse the map, using the legend it returns the location of the array.
     *
     * @todo to be moved the array helper (when written) : array::locate
     *
     * @recursive
     *
     * @throws \Hive\Locator\Exception\IncompleteLegend
     *
     * @param array $data the array to parse looking for a values location
     * @param int   $depth private value used as a internal pointer of the data for the recursive method
     *
     * @return bool
     */
    private function parse( $data,   $depth = 0) // : bool
    {

        // Assign the current alias and increment depth
        $legend = $this->config['legend'][$depth++];

        // Gigo check, ensure that there is an alias for the map.
        if ($depth < count($this->config['legend']) ) {

            // Loop through all the items in the current array
            foreach ($data as $key => $value) {

                // if the value is an array check to see if its child meets the critera
                if (is_array($value) && $this->parse($value, $depth)) {

                    // Set the alias and return
                    $this->result[$legend] = $key;

                    return true;

                } elseif (!is_array($value) && $this->driver->compare($this->subject, $value)) {

                    // We had a value, and it passed the compare, assign it and its key back to our result and return.
                    $this->result[$this->config['legend'][$depth]] = $value;
                    $this->result[$legend]                         = $key;

                    // set our status to true, as we found an item.
                    return $this->status = true;
                }
            }

        } else {

            // There legend doesn't match the map we were sent in, each map item needs a legend
            throw new Exception\IncompleteLegend();

        }

        // these are not the androids you are looking for.
        return false; #:(
    }

}