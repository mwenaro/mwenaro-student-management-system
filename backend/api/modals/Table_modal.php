<?php

class Table
{
    //BD instance
    private $fieldCount = 0;
    private $db;

    private $sql = " CREATE TABLE IF NOT EXISTS ";

    //Fields default options
    private $defaultOptions = [
        "string" => [
            'size' => 255

        ]

    ];

    //Feilds options
    private $types = [
        "string" => "VARCHAR",
        "text" => "TEXT",
        "int" => "INTEGER"
    ];
    
    function __construct($db = "")
    {

        $this->db = is_string($db) ? new Database(null,SQL_DBPATH . "/{$db}.sqlite3") : $db;

    }
    function primaryKey(): Table
    {

        $this->sql .= " PRIMARY KEY ";
        return $this;
    }
    function autoIncrement(): Table
    {

        $this->sql .= " AUTOINCREMENT ";
        return $this;
    }
    function varchar(int $limit = 0): Table
    {
        if ($limit > 0) {
            $this->sql .= " VARCHAR({$limit}) ";
            return $this;
        }
        $this->sql .= " VARCHAR() ";
        return $this;
    }
    function integer(int $limit = 0): Table
    {
        if ($limit === 0) {
            $this->sql .= " INTEGER ({$limit}) ";

        } else if ($limit === 1) {
            $this->sql .= " INTEGER ";

        } else {
            $this->sql .= " INTEGER(11) ";
        }
        return $this;
    }
    function notNull(): Table
    {

        $this->sql .= " NOT NULL ";
        return $this;
    }

    /**
     * Used to print the $sql for deburging
     * @return Table
     */
    function print(): Table
    {
        print_r($this->sql . ");");
        return $this;
    }

    /**
     * Summary of tableName
     * @param string $name
     * @return Table
     */
    function tableName(string $name): Table
    {
        $this->sql .= "`{$name}` (";
        return $this;
    }

    /**
     * Adds a fields
     * @param string $name
     * @return Table
     */
    function addColumn(string $name): Table
    {
        $this->sql .= $this->fieldCount > 0 ? ", `{$name}` " : "`{$name}` ";
        ++$this->fieldCount;
        return $this;
    }

    /**
     * Adds a Primary Key field
     * @param mixed $field
     * @return Table
     */
    function addPrimaryKey($field = null): Table
    {
        if (is_null($field)):

            $this->sql .= " id INTEGER (11) PRIMARY KEY ";
            $this->sql .= " AUTOINCREMENT ";
            $this->sql .= " NOT NULL ";
            return $this;
        endif;
        $this->sql .= " PRIMARY KEY({$field}) ";
        return $this;
    }


    /**
     * Excutes the the SQL command for creating a db table
     * @param string $sql
     * @return void
     */
    function create(string $sql = null): void
    {
        $this->sql = is_null($sql) ? rtrim($this->sql, ",") . ");" : $sql;
        try {

            $flag = $this->db->exec($this->sql);
            print_r(['flag' => $flag]);
        } catch (\Throwable $err) {
            throw $err;
        }
    }

    /**
     * Summary of addInteger
     * @param string $colName
     * @param int $limit
     * @param int $null
     * @param string|null $role
     * @return Table
     */
    function addInteger(string $colName, int $limit = 0, int $null = 1, string $role = null): Table
    {
        $this->addColumn($colName)
            ->integer($limit);
        if ($null !== 1):
            $this->notNull();
        endif;

        if (!is_null($role)):
            $this->sql .= " {$role} ";
            if (trim($role) === "PRIMARY KEY") {
                $this->autoIncrement();
            }

        endif;

        return $this;
    }

    /**
     * Summary of addTextField
     * @param string $colName
     * @param int $limit
     * @param int $null
     * @return Table
     */
    function addTextField(string $colName, int $limit = 0, int $null = 1): Table
    {
        $this->addColumn($colName)
            ->varchar($limit);
        if ($null !== 1):
            $this->notNull();
        endif;
        return $this;
    }


}