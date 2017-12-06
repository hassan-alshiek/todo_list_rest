<?php

class MyModel
{
    protected $mysqli = null;

    public function __construct()
    {
        $this->mysqli = new mysqli(
            '172.17.0.2',
            'root',
            'password',
            'todo_list',
            '3306'
        );
        $this->mysqli->set_charset("utf8");
    }

    /**
     * Select from vehicles table
     * @param array $params
     * @return array
     */
    public function db_get($params = [])
    {
        $res = [];
        if ($this->mysqli) {
            $cols = [
                'list_items' => [
                    'list_item_id',
                    'label',
                    'done',
                    'date_created',
                    'date_updated'
                ]
            ];
            //search
            $search = $this->_search($cols, $params);
            //order
            $order = $this->_order($cols, $params);
            $sql = "SELECT * FROM list_items " .
                $search . $order;
            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }
            }
        }

        return $res;
    }

    /**
     * Insert to vehicles table with minor rule checking
     * @param array $params
     * @return array
     */
    public function db_post($params = [])
    {
        $res = [];
        if ($this->mysqli) {
            $rules = [
                'label' => [
                    'required',
                    'max' => 100
                ],
                'done' => [
                    'required',
                    'in_list' => [0, 1]
                ]
            ];
            //validate
            $validate = $this->_validate($rules, $params);
            if ($validate['status']) {
                $sql = "INSERT INTO list_items SET " . $validate['results'];
                if ($this->mysqli->query($sql) === TRUE) {
                    return ["status" => TRUE, "results" => ['list_item_id'=> $this->mysqli->insert_id]];
                } else {
                    return ["status" => FALSE, "results" => $this->mysqli->error];
                }
            } else {
                return $validate;
            }
        }

        return $res;
    }

    /**
     * Insert to vehicles table with minor rule checking
     * @param int $id
     * @param array $params
     * @return array
     */
    public function db_put($id, $params = [])
    {
        $res = [];
        if ($this->mysqli) {
            $rules = [
                'label' => [
                    'max' => 100
                ],
                'done' => [
                    'in_list' => [0, 1]
                ]
            ];
            //validate
            $validate = $this->_validate($rules, $params);
            if ($validate['status']) {
                $sql = "UPDATE list_items SET " . $validate['results']."WHERE list_item_id= ".$id;
                if ($this->mysqli->query($sql) === TRUE) {
                    return ["status" => TRUE, "results" => ['list_item_id'=> $id]];
                } else {
                    return ["status" => FALSE, "results" => $this->mysqli->error];
                }
            } else {
                return $validate;
            }
        }

        return $res;
    }

    /**
     * Insert to vehicles table with minor rule checking
     * @param int $id
     * @return array
     */
    public function db_delete($id)
    {
        $res = [];
        if ($this->mysqli) {
            $sql = "DELETE FROM list_items WHERE list_item_id= ".$id;
            if ($this->mysqli->query($sql) === TRUE) {
                return ["status" => TRUE, "results" => ['list_item_id'=> $id]];
            } else {
                return ["status" => FALSE, "results" => $this->mysqli->error];
            }
        }

        return $res;
    }

    /**
     * Create mysql WHERE string
     * @param $cols
     * @param array $params
     * @return string
     */
    private function _search($cols, $params = [])
    {
        $res = "";
        foreach ($params as $k => $v) {
            foreach ($cols as $tk => $t) {
                foreach ($t as $c) {
                    if ($k == $c) {
                        if ($res == "") {
                            $res .= " WHERE";
                        }
                        $res .= " " . $tk . "." . $c . " = '" . $v . "',";
                    }
                }
            }
        }
        return ($res ? rtrim($res, ',') : $res);
    }

    /**
     * Create mysql ORDER BY string
     * @param $cols
     * @param array $params
     * @return string
     */
    private function _order($cols, $params = [])
    {
        $res = "";
        if (!empty($params['order'])) {
            foreach ($cols as $tk => $t) {
                foreach ($t as $c) {
                    if ($params['order'] == $c) {
                        $res .= " ORDER BY " . $tk . "." . $c . " " .
                            (!empty($params['sort']) && in_array($params['sort'], ['ASC', 'DESC']) ? $params['sort'] : 'ASC');
                    }
                }
            }
        }
        return $res;
    }

    /**
     * Minor rule validation
     * @param $rules
     * @param array $params
     * @return array
     */
    private function _validate($rules, $params = [])
    {
        $res = "";
        $query = "";
        $flag = TRUE;
        foreach ($rules as $rk => $rv) {
            //Required
            if (array_key_exists($rk, $params) && in_array('required', $rv)) {
                if (array_key_exists('max', $rv)) {
                    if (strlen($params[$rk]) > $rv['max']) {
                        $flag = FALSE;
                        $res .= $rk . " max length is " . $rv['max'] . ". ";
                    }
                }
                if (array_key_exists('in_list', $rv)) {
                    if (!in_array($params[$rk], $rv['in_list'])) {
                        $flag = FALSE;
                        $res .= $rk . " must be " . implode(', ', $rv['in_list']) . ". ";
                    }
                }
                $query .= " " . $rk . " = '" . $params[$rk] . "', ";
            } else {
                $flag = FALSE;
                $res .= $rk . " is required. ";
            }
        }
        return ["status" => $flag, "results" => ($flag ? rtrim($query, ', ') : $res)];
    }
}

?>