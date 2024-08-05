<?php
require_once 'PDO.php';

class Query extends PDOConnect
{
    private $sql = '';
    private $table = '';
    private $where = '';
    private $duplicate = '';
    // select input ['id', 'name' => 'name1' , 'description] => elector id , name1 , description form database,
    // cớ thể dùng chuổi để select
    // default lấy tất cả 
    // trả về this;

    // ví dụ select()->form('users')->all(); lấy tất cả database từ bản users
    function select($column = '*')
    {

        $columnName = '';
        if (is_array($column)) {
            $index = 0;
            foreach ($column as $key => $value) {
                gettype($key) == 'string' ? $columnName .=  $key . ' as ' . $value : $columnName .= $value;
                if ($index < count($column) - 1) $columnName .= ' , ';
                $index++;
            }
        } else {
            $columnName = $column;
        }
        $this->sql = "SELECT $columnName FROM $this->table " .  $this->sql;
        return $this;
    }

    // tên column name
    function table($table)
    {
        $this->table = $table;
        return $this;
    }
    function where($field, $compare, $value = '')
    {
        if ($this->where !== '') {
            $this->sql  .= " AND $field $compare  '$value' ";
        } else {
            $this->where .= " WHERE $field $compare  " . (isset($value) ? "'" . $value . "'" : '') . "";
            $this->sql .= $this->where;
        }

        return $this;
    }
    function whereIn($field, $data = [])
    {
        if ($this->where !== '') {
            $this->sql  .= " AND $field IN (" . implode(',', $data) . ")";
        } else {
            $this->where .= " WHERE $field IN (" . implode(',', $data) . ")";
            $this->sql .= $this->where;
        }

        return $this;
    }
    function whereNotIn($field, $data = [])
    {
        if ($this->where !== '') {
            $this->sql  .= " AND $field NOT IN (" . implode(',', $data) . ")";
        } else {
            $this->where .= " WHERE $field NOT IN (" . implode(',', $data) . ")";
            $this->sql .= $this->where;
        }

        return $this;
    }
    function is_NUll($field)
    {
        if ($this->where !== '') {
            $this->where .= " AND $field IS NULL";
        } else {
            $this->where .= "WHERE $field IS NULL";
        }
        $this->sql .= $this->where;
        return $this;
    }
    function or($field, $compare, $value)
    {
        $this->sql .= " OR $field $compare '$value'";
        return $this;
    }
    function having($field, $compare, $value)
    {
        $this->sql .= " HAVING $field $compare $value";
        return $this;
    }
    function delete()
    {
        $this->sql = "DELETE FROM $this->table" . $this->sql;
        $this->execute($this->sql);
    }
    // vd $query->table('users')->insert(['name' => 'a' , password => 1234])
    // => sql = 'INSERT INTO users (name, password ) VALUES ('a',1234)';
    // output là col của users đã được tạo
    function insert($data)
    {
        $column = '';
        $valueCol = '';
        foreach ($data as $key => $value) {
            $column .= $key . ' ,';
            if (isset($value)) {
                $valueCol  .= is_numeric($value) || gettype($value) == 'integer' ?  " $value  ," : " '$value' ,";
            } else {
                $valueCol .= ' NULL ,';
            }
        }

        $sql = "INSERT INTO $this->table (" . substr($column, 0, -1) . ") VALUES (" . substr($valueCol, 0, -1) . ") " . $this->where;
        $id = $this->execute($sql);
        return $this->select()->where('id', '=', $id)->first();
    }
    function update($data)
    {
        $valueCol = '';
        foreach ($data as $key => $value) {
            $valueCol .= is_numeric($value) || gettype($value) == 'integer' ? " $key = $value ," : "$key = '$value' ,";
        }
        $sql = " UPDATE $this->table SET " . substr($valueCol, 0, -1) . " " . $this->sql;
        $this->execute($sql);
    }
    function duplicate($data)
    {
        $valueCol = '';
        foreach ($data as $key => $value) {
            $valueCol .= is_numeric($value) || gettype($value) == 'integer' ? " $key = $value ," : "$key = '$value' ,";
        }
        $this->duplicate = " ON DUPLICATE KEY UPDATE " . substr($valueCol, 0, -1);
        return $this;
    }
    function paginate($item)
    {
        $offsetItem = $item * !empty($_GET['page']) ? $_GET['page'] - 1 :  0;
        $data['data'] = $this->limit($item)->offset($offsetItem)->all();
        $data['page'] =   $this->select(['ROUND(count(*) / ' . $item . ')' => 'total_pages'])->first();
        $data['page']['current_page'] = !empty($_GET['page']) && $_GET['page'] != 0 ? $_GET['page'] : 1;
        return $data;
    }
    function orderBy($column, $direction = 'DESC')
    {
        $column = is_array($column) ? join(',', $column) : $column;
        $this->sql .= " ORDER BY " . $column . " " . $direction;
        return $this;
    }
    function limit($limit)
    {
        $this->sql .= " LIMIT  $limit";
        return $this;
    }
    function offset($offset)
    {
        $this->sql .= " OFFSET $offset";
        return $this;
    }
    function groupBy($column)
    {
        $this->sql .= " GROUP BY $column";
        return $this;
    }
    function join($tableJoin, $foreignKey, $primaryKey = 'id', $location = 'INNER', $table1 = '', $table2 = '')
    {
        $foreignKey = isset($table1) && $table1 != '' ? "$table1.$foreignKey" : "$this->table.$foreignKey";
        $primaryKey = isset($table2) && $table2 != '' ? "$table2.$primaryKey " : "$tableJoin.$primaryKey";
        $this->sql .= " $location JOIN $tableJoin ON $foreignKey = $primaryKey";
        return $this;
    }
    // lấy tất cả dữ liệu
    function all()
    {
        try {
            $data = parent::query($this->sql)->fetchAll(PDO::FETCH_ASSOC);
            $this->sql = '';
            $this->where = '';
            return $data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    // lấy một dữ liệu
    function first()
    {
        $stml = parent::query($this->sql);
        $this->sql = '';
        $this->where = '';
        return $stml->fetch(PDO::FETCH_ASSOC);
    }

    // check cơ sở dữ liệu
    function execute($sql)
    {
        try {
            parent::query($sql);
            $this->sql = '';
            $this->where = '';
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
