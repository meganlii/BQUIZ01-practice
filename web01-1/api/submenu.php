<?php include_once './db.php';

// 不需要另外新增物件 $Submenu 隸屬 $Menu下 id=0 次選單模式

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

// 步驟1：設定main_id

// 步驟2：
// 1. if判斷：如果['text2']存在就新增 沒有就編輯
if (isset($_POST['text2'])) {

 // 2.foreach：取出['text2']索引key+value $key=$text
 // ['text2']['href2']成對出現，共用索引值$key 根據$key找出['href2']的$text


 // 3. 取出 ['href2']索引key+value $key=$href 
 // if判斷：如果$text不等於空白(有新增的意思)
 // $href值 從['href2'][$key]取得


 // 4. 資料表名稱table用不到 只有一個menu
 // 直接將變數直接寫成陣列形式 存入物件$Menu
 // 不在外面新增一個陣列變數先寫好

}else {
 # code...
}