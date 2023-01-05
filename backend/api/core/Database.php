<?php


class Database extends PDO
{

    private $flag = false;
    private $data = [];
    private $deburg = false;
    public $errors = [];

    public function __construct($DB_TYPE =null,$DB_NAME=null, $DB_HOST = null, $DB_USER = null, $DB_PASS = null)
    {


        if (!is_null($DB_TYPE)&&$DB_TYPE !=="sqlite") {

            parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
        }else{
           
            
            try {

                $DB_NAME = empty($DB_NAME) ? DB_NAME : $DB_NAME;
                parent::__construct('sqlite' . ':' . $DB_NAME);
            } catch (PDOException $exc) {
                echo $exc->getMessage();

            }



         }

        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function setDeburg()
    {
        $this->deburg = true;
        return $this;
    }

    private function show($thing)
    {
        if ($this->deburg) {
            echo '<p>';
            print_r($thing);
            echo '</p>';
        }
    }


    function valuePair($pair_arr, $sep = ' = ', $end = null)
    {
        $end = is_null($end) ? ',' : $end;
        $sen = '';
        if (!empty($pair_arr)) {
            foreach ($pair_arr as $key => $value) {
                $value = is_null($value) ? $value : " '{$value}'";
                $sen .= "$key" . $sep . "{$value}" . "{$end}";
            }
        }
        $this->show($sen);
        return '' === $sen ? '' : rtrim($sen, $end);
    }

    function getData()
    {
        return $this->data;
    }

    function getError()
    {
        return $this->errors;
    }

    function getFlag()
    {
        return $this->flag;
    }


    function where(array $where = array(), $option = '')
    {
        $option = !empty($option) ? $option : ' AND ';
        $str_where = '';
        if (!empty($where) && is_array($where)) {
            $str_where = 'WHERE ';
            foreach ($where as $field => $value) {

                $str_where .= "{$field} = '{$value}' $option";
            }
            $str_where = rtrim($str_where, $option);
        } elseif (!empty($where) && !array($where)) {
            $str_where = $where;
        }
        $this->show($str_where);
        return $str_where;
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param mixed $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $where = [], $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $where = $this->where($where);
        $sql = "$sql $where ";
        try {
            $sth = $this->prepare($sql);
            foreach ($array as $key => $value) {
                $sth->bindValue("$key", $value);
            }
            $this->show($sql);
            $this->flag = $sth->execute();

            $this->data = $this->flag ? $sth->fetchAll($fetchMode) : $this->data;

        } catch (PDOException $exc) {
            $this->errors['msg'] = $exc->getMessage();
            $this->errors['sql'] = $sql;
        }
        return $this;
    }



    /**
     * insert
     * @param string $table A name of table to insert into
     * @param array $data An associative array
     */
    public function insert($table, $data, $where = array(), $option = '')
    {
        $where = $this->where($where);

        try {
            ksort($data);
            $fieldNames = implode('`, `', array_keys($data));
            $fieldValues = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO `{$table}` (`$fieldNames`) VALUES ($fieldValues) $where";
            $sth = $this->prepare($sql);
            foreach ($data as $key => $value) {

                $sth->bindValue(":$key", $value);
            }
            $this->flag = $sth->execute();


        } catch (Exception $exc) {
            $this->errors['msg'] = $exc->getMessage();
            $this->errors['sql'] = $sql;
            $this->errors['flag'] = $this->flag;
        }
        return $this;
    }

    /**
     * update
     * @param string $table A name of table to insert into
     * @param array $data An associative array
     * @param array $where the WHERE query part
     */
    public function update($table, $data, $where)
    {
        $data = $this->removeEmpty($data);
        $where = $this->where($where);
        try {
            ksort($data);

            $fieldDetails = NULL;
            foreach ($data as $key => $value) {
                $fieldDetails .= "`$key` = :$key,";
            }
            $fieldDetails = rtrim($fieldDetails, ',');
            $sql = "UPDATE $table SET $fieldDetails $where";
            $sth = $this->prepare($sql);
            // $this->show($sql);
            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }

            $this->flag = $sth->execute();
        } catch (PDOException $exc) {
            $this->errors['msg'] = $exc->getMessage();
            $this->errors['sql'] = $sql;
        }
        return $this;
    }

    /**
     * delete
     * 
     * @param string $table
     * @param array $where
     * @param integer $limit
     * @return Database
     */
    public function delete($table, $where, $limit = 1)
    {
        $where = $this->where($where);
        $sql = "DELETE FROM $table  $where LIMIT $limit";
        $this->show($sql);

        try {
            $this->flag = $this->exec($sql);
        } catch (Exception $exc) {
            $this->errors['msg'] = $exc->getMessage();
        }
        return $this;
    }

    function fetch($sql)
    {
        try {
            $this->flag = ($this->exec($sql) === true ? true : false);
        } catch (PDOException $exc) {
            $this->errors['msg'] = $exc->getMessage();
        }

        return $this;
    }

    function cmd($sql, $where = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        try {
            $this->flag = ($this->exec($sql) === true ? true : false);
            $sth = $this->prepare($sql);
            $this->data = $this->flag ? $sth->fetchAll($fetchMode) : $this->data;
        } catch (PDOException $exc) {
            $this->errors['msg'] = $exc->getMessage();
            $this->errors['sql'] = $sql;
        }

        return $this;
    }

    function create($sql, array $sql1 = array())
    {

        try {
            $this->flag = ($this->exec($sql) === true ? true : false);
        } catch (PDOException $exc) {
            $this->errors[] = $exc->getMessage();
        }

        return $this;
    }

    function removeEmpty($inPut)
    {
        $output = [];

        foreach ($inPut as $key => $val) {
            if ($val !== null && !empty($val)) {
                $output[$key] = $val;
            }
        }
        return $output;
    }


    function getRow($table, $where, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {

        $sql = "SELECT * FROM {$table} " . $this->where($where) . ' Limit 1';
        // $this->show($sql);
        try {
            $sth = $this->prepare($sql);
            foreach ($array as $key => $value) {
                $sth->bindValue("$key", $value);
            }
            $this->flag = $sth->execute();
            $this->data = $this->flag ? $sth->fetch($fetchMode) : [];

        } catch (Exception $exc) {
            $this->errors['msg'] = $exc->getMessage();
            $this->errors['sql'] = $sql;

        } finally {
            $this->data = $this->data ? $this->data : [];
        }

        return $this;
    }

    function exists($table, $where = array())
    {
        $d = $this->getRow($table, $where)->getData();
        return (!empty($d) && count($d) > 0) ? true : false;
    }


}
