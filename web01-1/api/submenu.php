<?php include_once './db.php';

// 不需要另外新增物件 $Submenu 隸屬 $Menu下 id=0 次選單模式
// 此頁路徑 <form action="./api/submenu.php" method="post" >

/*
// foreach 將陣列中的每一個元素，拆成「鑰匙」和「值」兩部分
1. 索引陣列：陣列只有值value  輸出索引(0/1/2)+值
$fruits = ["apple", "banana", "orange"];
foreach ($fruits as $key => $value) {
    echo "鑰匙: $key, 值: $value\n";
}
// 輸出結果： 
// 鑰匙: 0, 值: apple
// 鑰匙: 1, 值: banana  
// 鑰匙: 2, 值: orange

2. 關聯陣列：陣列有key+value
$student = [
    "name" => "小明",
    "age" => 20,
    "grade" => "A"
];

foreach ($student as $key => $value) {
    echo "鑰匙: $key, 值: $value\n";
}

// 輸出結果：
// 鑰匙: name, 值: 小明
// 鑰匙: age, 值: 20
// 鑰匙: grade, 值: A
*/

dd($_POST);
/*
Array
(
    [text] => Array
        (
            [0] => 1
        )

    [href] => Array
        (
            [0] => a
        )

    [text2] => Array
        (
            [0] => 2
            [1] => 3
            [2] => 4
        )

    [href2] => Array
        (
            [0] => b
            [1] => c
            [2] => d
        )

    // 將主選單id  [id] => 4 存入資料表 'main_id'欄位
    // 透過$main_id = $_POST['id'];  save('main_id' => $main_id)
    [id] => 4
    [table] => menu
)
*/

// 步驟1：設定main_id
// 來自modal\submenu.php<input type="hidden" name="main_id" value="<?= $_GET['id']; ? >">
$main_id = $_POST['main_id'];


// 步驟2
// 1. if判斷：如果['text2']存在就新增 沒有就編輯
if (isset($_POST['text2'])) {

    // 2. foreach
    // 48行 取出['text2']索引key+value $key=$text
    // 55行 ['text2']與['href2']成對出現，共用索引值$key 根據$key找出['href2']的$text
    foreach ($_POST['text2'] as $key => $text) {

        // 3. if判斷
        // 取出 ['href2']索引key+value  $key = $href 
        // if判斷：如果$text不等於空白(有新增的意思)
        // $href值 從['href2'][$key]取得    
        if ($text != "") {
            $href = $_POST['href2'][$key];

            // 4. 資料表名稱table用不到 只有一個menu
            // 直接將變數直接寫成陣列形式 存入物件$Menu
            // 不在外面新增一個陣列，對應資料表三個欄位 存入相對應三組變數$text $href $main_id
            // $Menu->save([]);
            $Menu->save(
                [
                    'text' => $text,
                    'href' => $href,
                    'main_id' => $main_id,

                    // 加上1 資料表sh欄位=1 不顯示null空值
                    'sh'=> 1
                ]
            );
        }
    }
}

// to('../backend/menu.php');
to("../backend.php?do=menu");

// 步驟3
/*
1. 剛才新增的次選單  不應該出現在  主選單畫面
2. 主次選單差異在main_id  主選單main_id=0
3. 回到 backend\menu.php  修改23行
$rows = ${ucfirst($do)}->all();
$rows = ${ucfirst($do)}->all(['main_id'=>0]);
*/

