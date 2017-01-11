<?php namespace Hive\Locator\Driver;


/**
 * Domain  Locator Library Driver.
 *
 * Handles a comparison for the locator library,
 * by comparing domains once they have been put in the same format.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Locator
 *
 * @copyright (c) 2017 Jamie Peake
 */
class Domain implements \Hive\Locator\Contract\Driver
{

    /**
     * Does a strict (case, space and type sensitive) comparision.
     *
     * @param $examine mixed the item to search for
     * @param $subject mixed the item the search
     *
     * @return bool whether or not the two arguments are strictly equal
     */
    public function compare($examine, $subject)// : bool
    {
        return $this->domain($examine) == $this->domain($subject);
    }


    /**
     * clean up the domain and put it in a standard format.
     *
     * @todo to be moved the request helper (when written)
     *
     * @param $domain string the domain to parse
     *
     * @return string cleaned domain
     */
    private function domain ($domain)// : string
    {

        // Clean the domain
        $domain = strtolower(trim($domain));

        // The following line will format the urls so that they are always the with in the same format.
        return (substr($domain,0 ,3) == 'www')  ? substr($domain, 4, strlen($domain) - 4) : $domain;
    }


}













