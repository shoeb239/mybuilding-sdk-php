<?php

/**
 * DataProxy interface.
 *
 * @category Services
 * @package  Services_MyBuilding
 * @author   Hadar Porat <hadar@mybuilding.org>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */ 
interface Services_MyBuilding_DataProxy
{
    /**
     * Retrieve the object specified by key.
     *
     * @param string $key    The index
     * @param array  $params Optional parameters
     *
     * @return object The object
     */
    function retrieveData($key, array $params = array());

    /**
     * Create the object specified by key.
     *
     * @param string $key    The index
     * @param array  $params Optional parameters
     *
     * @return object The object
     */
    function createData($key, array $params = array());

    /**
     * Delete the object specified by key.
     *
     * @param string $key    The index
     * @param array  $params Optional parameters
     *
     * @return null
     */
    function deleteData($key, array $params = array());
}

