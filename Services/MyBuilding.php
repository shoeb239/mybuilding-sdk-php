<?php

function Services_MyBuilding_autoload($className) {
    if (substr($className, 0, 19) != 'Services_MyBuilding') {
        return false;
    }
    $file = str_replace('_', '/', $className);
    $file = str_replace('Services/', '', $file);
    return include dirname(__FILE__) . "/$file.php";
}

spl_autoload_register('Services_MyBuilding_autoload');

/**
 * MyBuilding API client interface.
 *
 * @category Services
 * @package  Services_MyBuilding
 * @author   Hadar Porat <hadar@mybuilding.org>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Services_MyBuilding extends Services_MyBuilding_Resource
{
    const USER_AGENT = 'mybuilding-php/1.0.2';

    protected $http;
    protected $version;
    
    /**
     * Residents API
     * 
     * @var Services_MyBuilding_Rest_Residents
     */
    public $residents;
    
    /**
     * Service Requests API
     * 
     * @var Services_MyBuilding_Rest_ServiceRequests
     */
    public $serviceRequests;
	 
   	/**
	 * app id
	 * @var string
	 */
	protected $_app_id;
	
	/**
	 * app key
	 * @var string
	 */
	protected $_app_key;
	

    /**
     * Constructor.
     *
	 * @param string $base_url
	 * @param string $app_id
	 * @param string $app_key
     * @param Services_MyBuilding_Http $_http    A HTTP client
     */
    public function __construct(
		$base_url, 
		$app_id, 
		$app_key,
        Services_MyBuilding_TinyHttp $_http = null
    ) {
		$this->_app_id = $app_id;
		$this->_app_key = $app_key;
    	
       if (null === $_http) {
            $_http = new Services_MyBuilding_TinyHttp(
                "http://" . $base_url,
                array("curlopts" => array(CURLOPT_USERAGENT => self::USER_AGENT))
            );
        }
        $this->http = $_http;
        
        $this->residents = new Services_MyBuilding_Rest_Residents($this);
        $this->serviceRequests = new Services_MyBuilding_Rest_ServiceRequests($this);
    }

    /**
     * GET the resource at the specified path.
     *
     * @param string $path   Path to the resource
     * @param array  $params Query string parameters
     *
     * @return object The object representation of the resource
     */
    public function retrieveData($path, array $params = array())
    {
    	$path = "/$path";
    	$params = array_merge($params, array('format' => 'json', 'app_id' => $this->_app_id, 'app_key' => $this->_app_key));
    	
        return $this->_processResponse(
                $this->http->get("$path?" . http_build_query($params, '', '&')));
    }

    /**
     * POST to the resource at the specified path.
     *
     * @param string $path   Path to the resource
     * @param array  $params Query string parameters
     *
     * @return object The object representation of the resource
     */
    public function createData($path, array $params = array())
    {
    	$path = "/$path";
    	$params = array_merge($params, array('format' => 'json', 'app_id' => $this->_app_id, 'app_key' => $this->_app_key));
    	
    	$headers = array('Content-Type' => 'application/x-www-form-urlencoded');
        return $this->_processResponse(
                $this->http->post(
                    $path,
                    $headers,
                    http_build_query($params, '', '&')
                ));
    }

    /**
     * Convert the JSON encoded resource into a PHP object.
     *
     * @param array $response 3-tuple containing status, headers, and body
     *
     * @return object PHP object decoded from JSON
     */
    private function _processResponse($response)
    {
        list($status, $headers, $body) = $response;

        if ($status == 204) {
            return TRUE;
        }
        if (empty($headers['Content-Type'])) {
            throw new DomainException('Response header is missing Content-Type');
        }
        switch ($headers['Content-Type']) {
        case 'application/json':
        case 'text/json':
        	return $this->_processJsonResponse($status, $headers, $body);
            break;
        case 'text/xml':
            return $this->_processXmlResponse($status, $headers, $body);
            break;
        }
        throw new DomainException(
            'Unexpected content type: ' . $headers['Content-Type']);
    }

    private function _processJsonResponse($status, $headers, $body) {
        $decoded = json_decode($body);
        if (200 <= $status && $status < 300 && $decoded->status=='success') {
            return $decoded->response;
        }
        throw new Services_MyBuilding_RestException(
            0,
            (string)$decoded->response->message
        );
    }

    private function _processXmlResponse($status, $headers, $body) {
        $decoded = simplexml_load_string($body);
        if (200 <= $status && $status < 300 && $decoded->status=='success') {
            return $decoded->response;
        }
        throw new Services_MyBuilding_RestException(
            0,
            (string)$decoded->response->message
        );
    }
}
