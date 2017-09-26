<?php

class Model {

    protected $db;
    protected $table;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /* CRUD START */
    public function save($data)
    {
        $sql = $this->buildInsertQuery($this->table, $data);

        try {
            $stmt = $this->db->prepare($sql);

            $this->bindValues($stmt, $data);

            if (!$stmt->execute()) {
                return false;
            }

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findByColumn($column, $value)
    {
        $sql = "SELECT * FROM $this->table WHERE $column = :$column";

        try {
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(":$column", $value);

            if (!$stmt->execute()) {
                return false;
            }

            $item = $stmt->fetch();

            return $item;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id";

        try {
            $stmt = $this->db->query($sql);

            $item = $stmt->fetch();

            return $item;

        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function update($id, $data)
    {
        $sql = $this->buildUpdateQuery($id, $data, $this->table);

        try {
            $stmt = $this->db->prepare($sql);

            $this->bindValues($stmt, $data);

            if (!$stmt->execute()) {
                return false;
            }

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";

        try {
            $stmt = $this->db->prepare($sql);

            if (!$stmt->execute(array(':id' => $id))) {
                return false;
            }

            return true;

        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function all()
    {
        $sql = "SELECT * FROM $this->table";

        try {
            $stmt = $this->db->query($sql);

            $items = $stmt->fetchAll();

            return $items;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function paginate($page = 1, $orderBy = null, $order = null, $limit = 5) {
        $sqlCount = "SELECT COUNT(id) FROM $this->table";
        $data['topic'] = strtolower($this->table);
        $data['currentPage'] = $page;
        $data['orderBy'] = $orderBy;
        $data['order'] = strtolower($order);

        //Get the number of rows to calculate total pages
        try {
            $stmt = $this->db->query($sqlCount);

            $rows = $stmt->fetchColumn();

        } catch (PDOException $e) {
            return false;
        }

        //number of pages
        $pages = ceil($rows/$limit);
        $data['totalPages'] = $pages;

        //offset
        $offset = $page * $limit - $limit;

        if ($orderBy && $order) {
            $sqlItems = "SELECT * FROM $this->table ORDER BY $orderBy $order LIMIT $limit OFFSET $offset";
        } else {
            $sqlItems = "SELECT * FROM $this->table LIMIT $limit OFFSET $offset";
        }

        try {
            $stmt = $this->db->query($sqlItems);

            $data['items'] = $stmt->fetchAll();

        } catch (PDOException $e) {
            return false;
        }

        return $data;
    }
    /* CRUD END */

    /* HELPERS START */
    public function buildInsertQuery($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = ':'. implode(', :', array_keys($data));

        return "INSERT INTO $table ($columns) VALUES ($values)";
    }

    public function buildUpdateQuery($id, $data, $table)
    {
        $columns = '';

        foreach ($data as $key => $value) {
            $columns .= "$key = :$key, ";
        }
        $columns = rtrim($columns, ', ');

        $sql = "UPDATE $table SET $columns WHERE id = $id";

        return $sql;
    }

    public function selectQueryBuilder()
    {

    }

    public function bindValues(&$stmt, $data)
    {
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
    }
    /* HELPERS END */
}