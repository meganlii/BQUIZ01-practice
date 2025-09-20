<?php
// 搭配講義註解--下次從237行開始看  繼續加油
/* 
1.[技能檢定]網頁乙級檢定-前置作業-程式功能整合測試-基礎
https://mackliu.github.io/php-book/2024/01/03/skill-check1-init-04/

2.[資料庫] Lesson 3 SQL 語法
https://mackliu.github.io/php-book/2021/09/20/db-lesson-03/

3.老師題組一解題說明
https://bquiz.mackliu.com/solve/solve01-02.html

4. 6/24、6/27 解題錄影檔案
*/

// 總共(2+3)+6+1 = 12個函式
// 記憶技巧 先列出全部函式跟變數(常忘記) 寫完時間 老師15分 同學25分
/*
1.全域函式 *2 + *3  再寫DB類別  *6

2.寫FN name1 (2/4) {3}，先寫名稱1/小2/大括號3/變數4  例 function all(...$arg){ }
all//find(查R) count  save(增C.改U)//del(刪D)  arraytosql
R-read顯示 在SQL稱為query  顯示功能屬於R

3.再寫new DB('table') 物件
$Title = new DB('title');

4.最後寫訪客計數器
if(!isset($_SESSION['visit'])){...}
*/


// 一、共用函式目的
/* ==============================================================
 * 簡化 CRUD動作、除錯過程
 * 減少 撰寫SQL錯誤
 * include 到所有頁面使用  方便之後維護和重複使用
 * 放到最上/外層的頁面 放backend.php(後台) 寫一次即可 不用寫好幾次
 * 後台會載入其他不同檔案(如backend\title.php) 都會共用到函式
 * 使用include_once 因為有用session
 * php echo 接雙引號還是單引號  雙引號會解析變數和轉義字符，而單引號則不會
 * 有些功能獨立寫到api 而非全部塞到一個檔案處理 後面維護麻煩 如果有錯不容易找到或要改好幾個地方
============================================================== */

// 啟用 session：讓網頁可以記錄使用者狀態（如登入、計數等）
// 每個需要使用 Session 的頁面，都要先呼叫 session_start()
// 用來在不同網頁間，保存使用者資料的機制
session_start();


// 設定預設時區為台北，避免時間錯誤
date_default_timezone_set('Asia/Taipei');


// 二、撰寫輔助用的全域函式：輔助函式
/* ==============================================================
1. 共 dd  q  to 三組函式： 除錯 / 資料庫 / 跳轉
2. 宣告在共用的引入檔中，做為全域隨時可以呼叫的工具函式
3. 不用放到類別中，獨立在 DB 類別之外
============================================================== */

// 陣列除錯用/測試用輔助函數，格式化輸出內容，方便開發時檢查資料
function dd($array)
{
    // 格式化輸出
    echo '<pre>';

    // print_r() 以易讀 保持格式化結構 輸出變數的結構和內容
    print_r($array);

    // 關閉格式化輸出
    echo '</pre>';
}


// classDB函式處理不了 解決 聯表查詢或是子查詢 執行 複雜SQL 查詢 ($sql是SQL語句)
/*
* 只有題組三會用到 直接執行 SQL語句，並返回結果 不會用到class DB
* $movies = q("select `movie` from `orders` group by `movie`");
* foreach($movies as $movie){
* echo "<option value='{$movie['movie']}'>{$movie['movie']}</option>";
* }
*/
// 複雜SQL語法的簡化函式
function q($sql)
{

    // DSN 資料庫來源/連線名稱 (縮寫 Data Source Name)
    // host => 主機名稱或是位置IP / charset => 使用的字元集，一般選utf8 / dbname => 使用的資料庫名稱
    $dsn = 'mysql:host=localhost;dbname=db09;charset=utf8';


    // PDO 屬於連線物件 負責連線資料庫 (縮寫 PHP Data Objects)
    // 使用 new語法 建立一個 PDO連線物件，並將這個物件指定給一個 變數$pdo (概念同505行$Title = new DB('title');) 
    // 資料庫設定資料：( 資料庫位置和名稱，使用者名稱，密碼（空白)  )
    $pdo = new PDO($dsn, 'root', '');


    // 參考 https://mackliu.github.io/php-book/2021/09/21/php-lesson-04/
    /*
    1. return 自訂函式 需要用 return 回傳資料

    2. $pdo->query($sql) 執行 SQL查詢 並返回結果

    3. 回傳值
    fetch() 一次取回一筆
    例：find()

    fetchAll (PDO::FETCH_ASSOC) 一次取回多筆
    把(所有all)查詢結果 轉成 關聯陣列，  返回全部的資料，所有資料會放在一個陣列
    例：q()、all()

    PDO:: PHP範圍解析運算符，用雙冒號 :: 表示
    ::「進入」一個類別，存取符號 存取內部靜態內容（常數、靜態方法、靜態屬性）
    存取 類別常數：存取PDO類別中  定義的常數-FETCH_ASSOC


    4. 回傳值形式
    回傳值的內容會因為傳遞時的SQL語法而有不同的結果，有時是單一個值，有時是陣列
    FETCH_ASSOC
    回傳 帶欄位名稱的陣列
    只返回 關聯陣列(二維)key=value，不返回 數字/索引陣列
    關聯陣列 ['name' => 'John', 'age' => 25]
    
    FETCH_NUM
    回傳 帶欄位 索引的陣列
    索引陣列 [0 => 'John', 1 => 25]
    粗箭頭（=>）：可用於陣列/數組 ex.[key]=>[value]

    fetchColumn($n)
    返回單一個值 返回該筆資料中指定欄位的資料， $n為欄位的索引值(0,1,2…)
    只返回第一列的第一個欄位值
    例：count() 如果查詢結果是 10 筆資料，則返回 10


    exec($sql)
    執行sql語句，但不返回資料，而是返回影響的資料筆數，適合使用在更新/新增(save)，或刪除資料時
    例：save()、del()
    */

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    // 共兩組參數-查詢跟取回
    // $pdo//query($sql) 執行SQL查詢  // fetchAll(PDO::FETCH_ASSOC)取回 全部關聯陣列
    // 將sql句子 帶進pdo的query方法中，並以fetchAll()方式回傳所有的結果

}


// 接收一個參數 $url（要跳轉的目標網址）
// 例：to('../backend/menu.php');  括號內要加引號
function to($url)
{
    // header("location:" . $url); 雙引號內 直接以空格(可不加) 區分不同字串或變數
    // header() 函數發送 HTTP 標頭Location
    // 標頭Location 會告訴瀏覽器 跳轉到指定的網址
    // . $url 將參數中的網址串接到 "location:" 後面
    header("location:$url");
}

/* 頁面導(定)向輔助函式：PHP檔頭管理指令-header()
1. 重新導向/跳轉 到指定網址 可為內部首頁、外部網址、相對路徑
跳轉時帶參數 to("profile.php?id=123");
跳轉到首頁 to("index.php") 

2. 伺服器 發送 HTTP 標頭：Location: login.php
瀏覽器 接收標頭
瀏覽器 自動跳轉到 login.php

3. 常見使用情境 不用前後端一直跳頁
// 表單提交後跳轉
if($_POST['submit']) {
// 處理表單...
to("success.php");
}
*/

// 三、資料庫操作類別 (Database Access Object, DAO)
/* ======================================================================
1. 簡化自訂函式：用物件導向的方式 簡化自訂函式的撰寫
2. 考量檢定時間限制，並不是全面採用OOP
3. 只把常用的自訂函式，包裝成一個 資料庫DB類別(Class DB)
======================================================================== */

// 步驟1 宣告類別DB
// 類別名稱：大寫開頭  317：三個private/變數 一個construct  七個FN
class DB
{

    // 步驟2 宣告屬性/變數：三個private/變數 概念同85行 function q($sql)
    // 2-1 建立 資料庫基本資料  $dsn  $pdo=new PDO()
    // 物件屬性1：資料庫來源/連線名稱
    private $dsn = "mysql:host=localhost;dbname=db09;charset=utf8";


    // 2-2 建立 PDO物件 連線資料庫
    // function q($sql) { $pdo = new PDO($dsn, 'root', '')
    // 物件屬性2：PDO連線物件
    private $pdo;  // 


    // 2-3 讓每個 DB物件 記住自己要操作哪個資料表
    // 物件屬性3：資料表名稱  
    private $table;  // $this->table = 資料表名稱


    // 步驟3 建構函式/建構子：兩個 $this
    // 505行 建立物件時/物件被實例化(new DB) 會先執行的方法/自動執行 
    // 在物件內部 存取這些屬性，都必須用 $this->property = 物件屬性 
    // $this->屬性名稱(字串、不用$)]  存取 物件屬性(變數)
    // $this-> 代表「這個物件本身-依據上下文決定」，用來存取「這個物件/我自己的」內部屬性和方法。
    // 記憶法：呼應上方3個private $table  $pdo  $dsn
    function __construct($table)
    {
        // $this設定/存取  存取物件內部的 table、pdo、dsn 屬性
        // 設定物件的 table 屬性 // 把參數 $table 的值，存到「這個物件」的 table 屬性中
        $this->table = $table;
        
        
        // 存取物件的 dsn 屬性  寫$dsn會找不到變數（錯誤）
        // 1. 使用「這個物件」的 dsn 屬性（$this->dsn）
        // 2. 建立一個新的 PDO 物件
        // 3. 把 PDO 物件 存到「這個物件」的 pdo 屬性中
        // $this->dsn = $dsn = "mysql:host=localhost;dbname=db09;charset=utf8"
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    /*
    // 建立 DB 物件時：在建構時 帶入 table資料表名稱時 執行兩個$this
    $Title = new DB('title');
    這時發生什麼：
    $this->table = 'title';           // 把 'title' 存到物件的 table 屬性
    $this->pdo = new PDO(...);        // 建立 PDO 連線並存到物件的 pdo 屬性

    // 之後在其他方法中可以使用：
    function all() {
        return $this->pdo->query("SELECT * FROM " . $this->table)->fetchAll();
                ↑使用物件的pdo屬性                     ↑使用物件的table屬性
    }
    */


    // 步驟4 自訂函式-CRUD / CURD
    // 共7個FN：const  all//find(查R)  count(額外加)  save(增C.改U)//del(刪D)  arraytosql(a2s)

    // 4-1 $Table->all()-查詢 符合條件的 "全部資料/全部拿來" select *
    // 五組變數 $sql  三個if  return
    /*
     * 使用 "..." 可變/不定(數量的)參數  三個點點點...
     * (...$arg) 不定參數陣列，表示可以接收0個或多個參數
     * 參數  會被包裝成陣列 $arg
     * 如果有傳入參數$arg[0][1]，則根據參數來修改 SQL 語句
     * all();                             // 0個參數 ✓
     * all(['name' => 'John']);           // 1個參數 ✓  
     * all(['age' => 25], "ORDER BY id"); // 2個參數 ✓

    SELECT
        ProductID,
        ProductName,
        CategoryName
    FROM
        Products
        INNER JOIN Categories ON Products.CategoryID = Categories.CategoryID;

     */
    function all(...$arg) {
        // 步驟1：建立查詢語句
        // 查詢 基本語句，選取資料表所有欄位
        // $this->table = 資料表名稱  'title'或ad...
        // 輸出字串  $sql = "select * from title"
        $sql = "select * from $this->table";


        // 步驟3：處理第一個參數
        // isset()  檢查是否成立 有傳入資料
        if (isset($arg[0])) {

            // 步驟4：is_array() 如果有資料 且 第一個參數是陣列
            if (is_array($arg[0])) {


                // 步驟2：arraytosql() a2s() 將陣列 轉為 SQL字串
                $tmp = $this->arraytosql($arg[0]);

                $sql = $sql . " where " . join(" AND ", $tmp);
                // 拚接 sql語句
                // 留意 (點.)運算子  WHERE前後有空格
                // AND拼接 WHERE 條件字串
                // 將語法字串及參數帶入 取得一個完整的SQL句子

                // join() 是 PHP 函數，將陣列元素 串接成字串
                // 第一個參數 " AND " 是分隔符號 連接 多條件查詢
                // 第二個參數 $tmp 是要串接的陣列

                // "AND" 連接多個查詢條件
                // 如果$tmp為SQL多條件字串
                // join(" AND ", ['id' => 1, 'name' => 'John'])
                // 輸出：`id`='1' AND `name`='John'  (`id`=1 數字可不用' ')
                // 整個 $sql 輸出
                // select * from users . where `id`='1' AND `name`='John'


                // 如果第一個參數不是陣列，則直接附加到SQL語句後
            } else {
                $sql .= $arg[0];
                // $sql = $sql . $arg[0];
                // 將原本 $sql 變數內容保留，並在後面 加上新內容
                // 例如 $sql .= " where id=1"
                // $sql = "select * from title .  where `id`='1'
                // 程式假設使用者傳入完整 SQL 片段，不用再加"where"
            }
        }

        // .= 是一個 複合-賦值-運算符：相當在原來的字串後面加上新的內容
        /*
        1. $variable .= $value 等同於 $variable = $variable . $value。
        結合 字串串接 (string concatenation) 和 賦值/給你 (assignment) 的功能 
        "." 字串串接 運算符，用於將兩個字串連接在一起。
        "=" 賦值 運算符，用於將一個值賦給一個變數。
        2. 將右邊的值 附加到 左邊變數的值之後，然後將結果賦值給左邊的變數
        $variable .= $value 先將 $variable 的值與 $value 的值串接，然後將結果存回 $variable
        

        // 步驟5：處理第二個參數
        1. 如果有第二個參數，則附加到SQL語句 where之後
        例如：$sql .= " order by id desc"
        2. 第二參數 可為條件句-兩者之間BETWEEN  特殊指定IN 
        或 限制句 如 排序ORDER BY 或 限制筆數LIMIT
        例如：$arg[1] = " order by id desc"
        例如：$sql = "select * from title order by id desc"
        */
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        // 步驟6
        // 共三組參數 $this->pdo // query($sql) 執行SQL查詢  
        // fetchAll 執行sql語句，並返回 全部資料，所有資料會放在一個陣列；
        // PDO::FETCH_ASSOC 轉成關聯陣列  只回傳帶欄位名稱的資料
        // 步驟2：a2s() 將陣列 轉為 SQL字串  最後結果要再轉回陣列
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4-5 查詢 資料筆數 select count(*) 
    // 之後7/1才補上的函數-進行more判斷並在db.php中增count函式
    // count() SQL內建函式 聚合函式
    function count(...$arg) {
        $sql = "select count(*) from $this->table ";

        // 處理第一個參數 
        // isset()  檢查是否成立 有/無傳入資料 ㄧ
        if (isset($arg[0])) {

            // is_array() 如果第一個參數是陣列
            if (is_array($arg[0])) {
                $tmp = $this->arraytosql($arg[0]);
                $sql = $sql . " where " . join(" AND ", $tmp);

                // 如果第一個參數不是陣列，則直接附加到SQL語句後
            } else {
                $sql .= $arg[0];
            }
        }

        // 處理第二個參數
        // 如果有第二個參數，則附加到SQL語句where之後
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        // fetchColumn() 只返回第一列的第一個欄位值
        // 例如：如果查詢結果是 10 筆資料，則返回 10
        // 執行sql語句，並返回該筆資料中指定欄位的資料， $n為欄位的索引值(0,1,2…)
        return $this->pdo->query($sql)->fetchColumn();

    }

    // 4-2 $Table->find($id)-查詢 符合條件的 "單筆資料/找一個" select *
    // 複製all()，變數改為($id)  刪除isset()
    /*
     * 找某個特定id的資料  回傳資料表 指定id的資料 
     * find() 函數 - 固定參數  VS 不定參數
     * $id 一定存在，因為是必要參數
     * 只需要檢查 $id「類型」，不用檢查「是否存在isset()」
     * find();           // ❌ 錯誤！缺少必要參數
     * find(1);          // ✓ 正確
     * find(['name' => 'John']); // ✓ 正確
     * 比較
     * all(...$arg)：不定參數 → 需要用 isset() 檢查參數是否存在
     * find($id)：固定參數 → 參數一定存在，只需檢查參數的內容/類型
     */
    function find($id)
    {
        $sql = "select * from $this->table ";  // 回傳：字串

        // 如果 $id 是陣列
        if (is_array($id)) {

            // 執行內部方法4-6 a2s()
            // 將陣列轉換為字串
            $tmp = $this->arraytosql($id);

            // 拚接 sql語句
            $sql = $sql .
                " where " . join(" AND ", $tmp);

            // 如果 $id 不是陣列  是其他類型
        } else {

            // 拚接 sql語句
            $sql .= " WHERE `id`='$id'";
        }

        //echo $sql;
        //將sql句子帶進pdo的query方法中，並以fetch的方式回傳一筆資料結果
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    // 4-4 儲存資料：update、insert
    // 先寫出update、insert 兩個部分
    /*
     * $array 要儲存的資料陣列
     * 利用新增和更新語法的特點，整合兩個動作為一個，
     * 簡化函式的數量並提高函式的通用性
     * $arg 必須是陣列，但考量速度，程式中沒有特別檢查是否為陣列
    // 更新
    UPDATE
        `students`
    SET
        `name` = 'bob-change'
    WHERE
        `students`.`id` = 2

    // 新增
    INSERT INTO
        `students` (`id`, `name`)
    VALUES
        (NULL, 'amy'),
        (NULL, 'bob')
    
    */
    function save($array)
    {
        // 先判斷有沒有id 決定 新增 或 更新
        // 如果 $array 中有 'id' 鍵
        if (isset($array['id'])) {

            // 步驟1 update set
            // 更新資料的 SQL 語句 UPDATE `table` SET
            $sql = " update $this->table set ";

            $tmp = $this->arraytosql($array);  // 將陣列轉換為字串

            // 拚接 SQL 語句
            // join()位置不同
            $sql .= join(" , ", $tmp) .
                " where `id`= '{$array['id']}' ";

            // 如果 $array 中 沒有 'id' 鍵    
        } else {

            // 步驟2 insert into
            // 新增資料
            // $cols 取得 欄位名稱
            $cols = join("`,`", array_keys($array));
            // array_keys()
            // 將陣列的鍵名 轉換為字串，並用逗號分隔
            // 例如 $array = [
            //     'name' => 'John',
            //     'age' => 25,
            //     'email' => 'john@example.com'
            // ];
            // 取得陣列key：將key或index取出為一個陣列

            // 輸出：name(`,`)age(`,`)age
            // 之後加上 前後引號(`$cols`) 就完美了


            // $values 取得 欄位值
            $values = join("','", $array);
            // 關聯陣列使用 join() ，PHP 只會使用值（value），會忽略鍵（key）
            // 另一個函式    也可以取得索引=>值
            // Array
            // (
            // [0] => name
            // [1] => age
            // )

            // 建立新增資料SQL語句 insert into 表/欄位/值
            // 預覽 SQL語法 INSERT INTO `ad` (`id`, `text`, `sh`) VALUES (NULL, NULL, NULL)
            $sql = "insert into $this->table (`$cols`) values('$values')";
        }

        // exec($sql) 
        // 執行sql語句，但不返回資料，而是返回影響的資料筆數，適合使用在"新增/更新"或"刪除"資料時
        return $this->pdo->exec($sql);
    }


    // 4-3 刪除資料
    // 複製 find()
    /* SQL語句
    DELETE FROM
        `students`
    WHERE
        `students`.`id` = 4;
    */
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

        // 查詢query($sql) 刪除fetch() 改成 執行exec($sql) 
        // 執行sql語句，但不返回資料，而是返回影響的資料筆數，適合使用在"新增，更新"或"刪除"資料時
        return $this->pdo->exec($sql);
    }


    // 4-6 簡稱 a2s()將陣列轉換為SQL字串 
    // 將陣列轉換為 SQL 條件字串
    // 例如：arraytosql(['id' => 1, 'name' => 'John'])
    // 輸出：['`id` = \'1\'', '`name` = \'John\'']
    // 用於生成 SQL 查詢條件
    // 這個函式會被 all()、find()、save() 和 del() 使用
    private function arraytosql($array)
    {
        // 步驟2：初始化一個空陣列 $tmp
        $tmp = [];

        // 步驟1：先寫 foreach 迴圈
        foreach ($array as $key => $value) {
            $tmp[] = " `$key` = '$value' ";
        }

        // 步驟3：回傳 $tmp 陣列
        // 將每個鍵值對轉換為 SQL 條件字串
        return $tmp;
    }
}

// 建立資料庫物件：物件被實例化(new DB) 大寫DB
/*
1. 使用 new語法 建立一個 DB連線物件，並將這個物件指定給一個 變數$var 或物件變數$Var 
類似 宣告$pdo= new DB($dsn,'root','')

 * 變數$Table(大寫開頭) = new DB('資料表名稱');
 * 資料表名稱 實務上 用複數 較理想['titles']  因應檢定考試取巧之需
 * 可與單數形式的資料欄位區分

 * 建立一個專門處理 [ title 資料表] 的 [ 物件 $Title ]
 * $Title 物件變數  ['title'] 數值/參數
 * 用法 $this->table = 
    $title = $Title->find($id)
 *  -> 是 PHP物件運算子，用來呼叫物件的方法或存取物件的屬性。
 */
$Title = new DB('title');  // 用複數較理想 要加s ['titles'] 
$Ad = new DB('ad');
$Mvim = new DB('mvim');
$Image = new DB('image');
$News = new DB('news');
$Admin = new DB('admin');
$Menu = new DB('menu');
$Total = new DB('total');
$Bottom = new DB('bottom');


// 網站訪客計數器
// 檢查是否為新訪客：檢查 Session 中是否有 'visit' 標記(變數/key值)
if (!isset($_SESSION['visit'])) {

    // 第一次來訪
    // 如果沒有設定，表示這是使用者第一次造訪網站

    // 如果是新訪客
    // 從資料庫取得 ID 為 1 的總訪問次數記錄
    // $Total 應該是一個資料庫操作類別的實例    
    $t = $Total->find(1);


    // 將總訪問次數加 1
    // $t (=$total) 是一個陣列，包含 資料庫記錄的各個欄位
    // 'total' 欄位儲存 總訪問次數
    $t['total']++;

    // 將更新後的資料存回資料庫
    $Total->save($t);

    // 在 Session 中設定 'visit' 標記為 1
    // 表示這個使用者已經被計算過了，避免重複計算
    $_SESSION['visit'] = 1;

}


/* 
// 網站訪客計數器
1. 檢查是否為新訪客：檢查 Session 中是否有 'visit' 標記
2. 如果是新訪客：
從資料庫取得目前的總訪問次數
將次數加 1
更新回資料庫
在 Session 中做標記，避免同一個訪客重複計算


// 第一次訪問
1. $_SESSION['visit'] 不存在 → 執行計數邏輯
2. 假設資料庫中 total = 100
3. 執行後：total = 101，$_SESSION['visit'] = 1


// 同一使用者再次訪問（重新整理頁面等）
$_SESSION['visit'] = 1 已存在 → 跳過計數邏輯，不重複加 1

*/