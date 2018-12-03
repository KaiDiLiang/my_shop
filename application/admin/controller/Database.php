<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\query;
use think\Request;

class Database {
    public function index() {

    }

    public function sql_config() {
        $link = Db::connect('my_shop')->table('shop_admin')->find();
        if ($link != null) echo '链接成功';
        var_dump($link);
    }

    public function connect() {
    //    $link = Db::connect('my_shop') or die('连接数据库失败Error:'.mysql_errno().':'.mysql_error());
    //    return $link;
    }

    /**
     * 完成记录插入操作
     * @param string $table
     * @param array array
     */
    public function insert($table, $array) {
        $keys = join(',', array_key($array));
        $vals = '"'.join('","', array_value($array)).'"';
        $sql = 'insert{$table}($keys) values({$vals})';
        mysql_query($sql);
        return mysql_insert_id();
    }

    /**
     * 记录的更新操作
     * @param string $table
     * @param array $array
     * @param string $where
     * @param number
     */
    public function update($table, $array, $where = null) {
        foreach ($array as $key => $val) {
            if ($str == null) {
                $sep = '';
            } else {
                $sep = ',';
            }
            $str .= $sep.$key."='".$val."'";    
        }
        $sql = 'update {$table} set {$str}'.($where == null ? null : 'where'.$where);
        mysql_query($sql);
        return mysql_affected_rows();
    }

    /**
     * 记录的删除操作
     * @param string $table
     * @param string $where
     * @return number
     */
    public function delete($table, $where = null) {
        $where = $where == null ? null : 'where'.$where;
        $sql = 'delete from {$table} {$where}';
        mysql_query($sql);
        return mysql_affected_rows();
    }

    /**
     * 记录的查找一条记录操作
     * @param string $result_type
     * @param multitype
     */
    public function fetchOne($sql, $result_type = MYSQL_ASSOC) {
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result); 
        return $row;
    }

    
    /* 记录的查找所有记录操作
    * @param string $result_type
    * @param multitype
    */
    public function fetchAll($sql, $result_type = MYSQL_ASSOC) {
        $result = mysql_query($sql);
        while(@$row = mysql_fetch_array($result, $result_type)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /** 
     * 得到结果中的记录条数
     */
    public function getResultNum($sql) {
        $con = 'mysql://root:root@127.0.0.1:3306/my_shop#utf8';        
        if (!$con) {
            die('链接失败:'.mysql_error());
        }
        // $sql = "SELECT id FROM shop_admin WHERE id = 003";
        $result = Db::connect($con)->query($sql);
        return '受影响的条数：'.count($result);
    }
}