<?php

/**
 * Abstraction of a MyBuilding resource.
 *
 * @category Services
 * @package  Services_MyBuilding
 * @author   Hadar Porat <hadar@mybuilding.org>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */ 
abstract class Services_MyBuilding_Resource
    implements Services_MyBuilding_DataProxy
{
    protected $name;
    protected $proxy;
    protected $subresources;

    public function __construct(Services_MyBuilding_DataProxy $proxy)
    {
        $this->subresources = array();
        $this->proxy = $proxy;
        $this->name = get_class($this);
        $this->init();
    }

    protected function init()
    {
        // Left empty for derived classes to implement
    }

    public function retrieveData($path, array $params = array())
    {
        return $this->proxy->retrieveData($path, $params);
    }

    public function deleteData($path, array $params = array())
    {
        return $this->proxy->deleteData($path, $params);
    }

    public function createData($path, array $params = array())
    {
        return $this->proxy->createData($path, $params);
    }

    public function getSubresources($name = null)
    {
        if (isset($name)) {
            return isset($this->subresources[$name])
                ? $this->subresources[$name]
                : null;
        }
        return $this->subresources;
    }

    public function addSubresource($name, Services_MyBuilding_Resource $res)
    {
        $this->subresources[$name] = $res;
    }

    protected function setupSubresources()
    {
        foreach (func_get_args() as $name) {
            $constantized = ucfirst(Services_MyBuilding_Resource::camelize($name));
            $type = "Services_MyBuilding_Rest_" . $constantized;
            $this->addSubresource($name, new $type($this));
        }
    }

    public static function decamelize($word)
    {
        return preg_replace(
            '/(^|[a-z])([A-Z])/e',
            'strtolower(strlen("\\1") ? "\\1_\\2" : "\\2")',
            $word
        );
    }

    public static function camelize($word)
    {
        return preg_replace('/(^|_)([a-z])/e', 'strtoupper("\\2")', $word);
    }
}

