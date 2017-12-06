<?php

require_once 'abstract_api.php';// API class

class MyAPI extends API
{
    public function __construct($request, $origin)
    {
        parent::__construct($request);
    }

    /**
     * Vehicle endpoint
     * @return array|string
     */
    protected function todo_list()
    {
        switch ($this->verb) {
            case "get":
                if ($this->method == 'GET') {
                    $MODEL = new MyModel();
                    $res = $MODEL->db_get($this->request);
                    return ["status" => TRUE, "results" => $res];
                } else {
                    return "Only accepts GET requests";
                }
                break;
            case "post":
                if ($this->method == 'POST') {
                    $MODEL = new MyModel();
                    $res = $MODEL->db_post($this->request);
                    return $res;
                } else {
                    return "Only accepts POST requests";
                }
                break;
            case "delete":
                if ($this->method == 'DELETE') {
                    $MODEL = new MyModel();
                    $res = $MODEL->db_delete($this->request);
                    return ["status" => TRUE, "results" => $res];
                } else {
                    return "Only accepts DELETE requests";
                }
                break;
            case "put":
                if ($this->method == 'PUT') {
                    $MODEL = new MyModel();
                    $res = $MODEL->db_put($this->request);
                    return ["status" => TRUE, "results" => $res];
                } else {
                    return "Only accepts PUT requests";
                }
                break;
            default:
                break;
        }

    }
}

?>