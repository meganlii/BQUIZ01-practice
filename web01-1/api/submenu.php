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

/*
// 步驟1：設定 新增功能
1. 設定main_id
2. 來自modal\submenu.php<input type="hidden" name="main_id" value="<?= $_GET['id']; ? >">
*/
$main_id = $_POST['main_id'];


/*
// 步驟4：設定 編輯功能-先處理 刪除
1. isset()：需先判斷是否有id 有可能在沒有資料下新增
沒有id就是做下面的新增 從F12可看出 新增只會出現main_id 不會出現後來加的id
2. foreach
3. if判斷：是否有資料需要刪除  要刪除就不編輯
(vs) 編輯 先判斷有沒有刪除 isset($_POST['del'])
(vs) 新增 先判斷有沒有空白 $text != ""
4. isset() && in_array(兩個參數：變數,陣列) 搭配使用
是否有$_POST['del']存在，有表示有資料要刪除
以及 這筆id是否在陣列裡面

5. else{} 設定 編輯功能
(1) find($id)
(2) 列出變更項目兩個：$row['text'] $row['href']
是否要顯示變更？題目沒講？ 不用管顯示問題
*/

if (isset($_POST['id'])) {
    foreach ($_POST['id'] as $key => $id) {
        if ( isset($_POST['del']) && in_array($id,$_POST['del']) ) {
            $Menu->del($id);
        }else {
            $row=$Menu->find($id);
            $row['text']=$_POST['text'][$key];
            $row['href']=$_POST['href'][$key];
            $Menu->save($row);
        }
    }
}



/*
// 步驟2：設定 新增功能
1. if判斷：如果['text2']存在就新增 沒有就編輯

2. foreach
48行 取出['text2']索引key+value $key=$text
55行 ['text2']與['href2']成對出現，共用索引值$key 根據$key找出['href2']的$text

// 參考6/30 excel筆記190行
表單欄位 name=[   ]空陣列
name="text[ ]"  "sh[ ]"     "del[ ]"
依照表單欄位名稱  產生多組  索引陣列
表單欄位名稱 [text] => Array
輸入3組input  name=[text]
輸出 數字索引+value 呈現
體現 陣列放多筆資料的功能
[text] => Array
(
    [0] => 111
    [1] => 222
    [2] => 333
)

3. if判斷
取出 ['href2']索引key+value  $key = $href 
if判斷：如果$text不等於空白(有新增的意思)
$href值 從['href2'][$key]取得

4. 資料表名稱table用不到 只有一個menu
直接將變數直接寫成陣列形式 存入物件$Menu
不在外面新增一個陣列，對應資料表三個欄位 存入相對應三組變數$text $href $main_id
$Menu->save([]);

5. sh加上1 
資料表sh欄位=1 不顯示null空值

*/

if (isset($_POST['text2'])) {
    foreach ($_POST['text2'] as $key => $text) {
        if ($text != "") {
            $href = $_POST['href2'][$key];
            $Menu->save(
                [
                    'text' => $text,
                    'href' => $href,
                    'main_id' => $main_id,
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

// 步驟4：設定 編輯功能
1. isset()：需先判斷是否有id 有可能在沒有資料下新增
沒有id就是做下面的新增 從F12可看出 新增只會出現main_id 不會出現後來加的id

// 補充
1. 實務做法：前端提醒使用者，次選單不可空白 或者勾選刪除


*/

