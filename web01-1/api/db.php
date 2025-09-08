<?php
session_start();
date_default_timezone_set("Asia/Taipei");

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function q($sql)
{
    $dsn = 'mysql:host=localhost;dbname=db01;charset=utf8';
    $pdo = new PDO($dsn, 'root', '');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function to($url)
{
    // header("location:".$url);
    // 雙引號內 直接以空格(可不加) 區分不同字串或變數  不加空格可生效
    header("location:$url");
}


class DB
{
    private $dsn = "mysql:host=localhost;dbname=db01;charset=utf8";
    private $pdo;
    private $table;

    function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, "root", '');
    }


    // 4-1 $Table->all()-查詢 符合條件的 "全部資料" select *
    // 五組變數 $sql  三個if  return
    function all(...$arg)
    {
        $sql = "select * from $this->table ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->arraytosql($arg[0]);
                $sql = $sql . " where " . join(" AND ", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


    // 4-5 查詢 資料筆數 select count(*) 之後7/1才補上的函數-進行more判斷並在db.php中增count函式
    // count() SQL內建函式 聚合函式
    function count(...$arg)
    {
        $sql = "select count(*) from $this->table ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->arraytosql($arg[0]);
                $sql = $sql . " where " . join(" AND ", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchColumn();
    }


    // 4-2 $Table->find($id)-查詢 符合條件的 "單筆資料" select *
    // 找某個特定id的資料  回傳資料表 指定id的資料 
    function find($id)
    {
        $sql = "select * from $this->table ";

        if (is_array($id)) {
            $tmp = $this->arraytosql($id);
            $sql = $sql . " where " . join(" AND ", $tmp);
        } else {
            $sql .= " WHERE `id`='$id'";
        }
        //echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }


    // 4-4 儲存資料：update、insert
    function save($array)
    {
        if (isset($array['id'])) {
            //update
            $sql = "update $this->table set ";
            $tmp = $this->arraytosql($array);
            $sql .= join(" , ", $tmp) . "where `id`= '{$array['id']}'";
        } else {
            //insert
            $cols = join("`,`", array_keys($array));
            $values = join("','", $array);
            $sql = "insert into $this->table (`$cols`) values('$values')";
        }

        return $this->pdo->exec($sql);
    }


    // 4-3 刪除資料
    function del($id)
    {
        $sql = "delete  from $this->table ";

        if (is_array($id)) {
            $tmp = $this->arraytosql($id);
            $sql = $sql . " where " . join(" AND ", $tmp);
        } else {
            $sql .= " WHERE `id`='$id'";
        }
        //echo $sql;
        return $this->pdo->exec($sql);
    }


    // 4-6 簡稱 a2s()將陣列轉換為SQL字串 
    private function arraytosql($array)
    {
        $tmp = [];
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }

        return $tmp;
    }
}


// 類似 宣告$pdo= new DB($dsn,'root','')
// 共九個物件
$Title = new DB('title');
$Ad = new DB('ad');
$Mvim = new DB('mvim');
$Image = new DB('image');
$News = new DB('news');
$Admin = new DB('admin');
$Menu = new DB('menu');
$Total = new DB('total');
$Bottom = new DB('bottom');



// if(!isset($_SESSION['visit'])){
//     //第一次來訪
//     $t=$Total->find(1);
//     $t['total']++;
//     $Total->save($t);
//     $_SESSION['visit']=1;
// }
