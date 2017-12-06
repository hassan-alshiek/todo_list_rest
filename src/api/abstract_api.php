<?php

abstract class API
{
    protected $method = '';
    protected $endpoint = '';
    protected $verb = '';
    protected $args = [];

    public function __construct($request) {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");

        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);

        $this->endpoint=$uri_segments[3];

        $this->verb = strtolower($_SERVER['REQUEST_METHOD']);

        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Process API request
     * @return string
     */
    public function processAPI() {
        switch($this->method) {
            case 'POST':
                $this->request = $this->_cleanInputs($_POST);
                break;
            case 'GET':
                $this->request = $this->_cleanInputs($_GET);
                break;
            default:
                return $this->_response('Invalid Method', 405);
                break;
        }

        if ((int)method_exists($this, $this->endpoint) > 0) {
            return $this->_response($this->{$this->endpoint}($this->args));
        }

        return $this->_response("No Endpoint: $this->endpoint", 404);
    }

    /**
     * Generate response
     * @param $data
     * @param int $status
     * @return string
     */
    private function _response($data, $status = 200) {
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        return json_encode($data, JSON_PRETTY_PRINT); // JSON_PRETTY_PRINT only works in PHP >= 5.4
    }

    /**
     * Clean and get input data
     * @param $data
     * @return array|string
     */
    private function _cleanInputs($data) {
        $clean_input = [];
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->_cleanInputs($v);
            }
        } 
        else {
            $clean_input = trim(strip_tags($data));
        }
        return $clean_input;
    }

    /**
     * Generate status code
     * @param $code
     * @return mixed
     */
    private function _requestStatus($code) {// Can be implemented more on improvements
        $status = [
            200 => 'OK',
            401 => 'Invalid Parameters', //Unused
            404 => 'Not Found',   
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ];
        return ($status[$code]) ? $status[$code] : $status[500]; 
    }
}

?>