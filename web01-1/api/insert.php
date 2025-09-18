<?php
// 收後台./modal/title.php 新增網站標題圖片 送來的表單資料  寫到資料庫
// <form action="./api/insert.php" method="post">
// 新增功能獨立 其他表單欄位屬性有差異 text沒有文字 多了密碼欄位 網址欄位 之後再用if/switch調整即可
// 更新功能獨立 編輯功能多為文字的顯示/刪除 所以兩個api處理頁面

// 設定變數
// 陣列變數 $_POST['img']    key值/表單欄位名稱 <input type="file" name="img"
// 陣列變數 $_POST['table']  table=title
// <input type="hidden" name="table" value="title">

include_once "db.php";

dd($_POST);
dd($_FILES);

// echo "<pre>";
// print_r($_POST);
// print_r($_FILES);
// echo "</pre>";


// 步驟1
// 如果有上傳圖片就放上去  有/無   用!empty()不是空值確認  vs isset是否存在??
if (!empty($_FILES['img']['tmp_name'])) {

    move_uploaded_file($_FILES['img']['tmp_name'], "../images/" . $_FILES['img']['name']);
    $_POST['img'] = $_FILES['img']['name'];
}

// 步驟2
// 更改 .\modal\title.php <form action="./api/insert.php"
// 新增 隱藏欄位輔助 input:hidden
// <input type="hidden" name="table" value="title">
// 思考：簡化改成變數寫法 避免複製貼上打錯字


// 步驟5
// 獨立拿出$table兩段式處理 新增區域變數$table
// 先將table拿進來  表單頁面要帶value=資料表名稱(title或ad)
$table = $_POST['table'];
$db = ${ucfirst($table)};

// 步驟6
// 刪除之前兩個檔案 
// .\api\insert_title.php
// .\api\insert_ad.php


// 步驟3
// if判斷式 收$post陣列鍵值 變數寫法
// if ($table == 'title') { }
// 選單後面兩個功能 不須顯示帳號密碼 需另外處理
// if ($_POST['table'] == 'title') {
//     $_POST['sh'] = 0;
// } else {
//     $_POST['sh'] = 1;
// }

// 步驟5
// 1. 因應選單8-admin 資料表沒有sh欄位，if改成switch
// 2. 放變數$table 兩個case 其他預設

switch ($table) {
    case 'title':
        $_POST['sh'] = 0;
        break;
    case 'admin':
        # 沒有sh，不處理
        break;
    default:
        $_POST['sh'] = 1;
        break;
}


// 步驟4
// 此寫法 儲存會失敗 資料表沒有table欄位
// 值table 前面步驟功能已經處理完畢 需要移除 用unset
// 會影響to() $table  獨立拿出$table兩段式處理 回到步驟2
// 在 save() 時 不想包含 table 欄位
// 在此階段 刪除$_POST['table']的值 value=資料表名稱(title或ad) 不要存入資料庫 後面繼續沿用$table = $_POST['table']=資料表名稱(title或ad)
// 因為指定陣列key['table']，只會刪除指定元素，並不會刪除整個$_POST陣列，不影響$table變數使用
unset($_POST['table']);
// echo $table;

// 儲存表單所有內容
$db->save($_POST);


// 步驟2
// $table 怎麼來的？ get送來  另外加上
// 路徑改成參數寫法 對應$table=title或ab...等
// to('../backend.php?do=title');  單引號變數會失效 變成字串
// **不太懂 有兩個變數$table 刪除unset()之後  參考下方註解// 步驟3
// 要改成 雙引號 變數才會生效
to("../backend.php?do=$table");


?>

<script>
    /* 
1. 程式優化：再思考哪些功能可以合併，參6/27筆記-第120行
.\api\edit_ad.php
.\api\edit_title.php

.\api\insert_title.php
.\api\insert_ad.php
(1) 程式大多重複，只有少數不同的地方 可設參數
(2) 最後api只需要五個檔案，即可解決所有後台需求
(3) 功能變多10-20個時，逐個寫太花時間 也容易出錯 負擔加重
(4) 擴充功能 要刻畫面 寫api、modal 有更快方式解決
(5) 用判斷式if / switch case、迴圈 排除特例或做特別處理  簡化重複多的程式碼

2. 思考脈絡
* 一開始只能直覺寫 之後再整合 不可能一次寫對 寫最精簡的精華
* 未來遇到類似問題 只能不斷測試 程式最沒有成本

// 步驟1：第23行
(1) 先從 .\api\insert_title.php
(2) 複製 .\api\insert_title.php  更名為 .\api\insert.php


// 步驟3
1. ucfirst大寫字串(UpperCase縮寫)  lcfirst小寫字串
2. php7.0新增 PHP ${  } 大括號 字串插值（string interpolation） 參考JS 模板字串：組合文字和變數
$table='title';
$db=${ucfirst($table)};
$db=$Title;

// 不需要步驟4：儲存
物件用switch case
只用二選一的if不夠  改用switch case
其他表單欄位屬性有差異 多了密碼欄位 網址欄位  
欄位不同 post處理資料也不同
$Title->save($_POST);

switch ($table) {
    case 'ad':
        $Ad->save($_POST);
        break;
    
    case 'title':
        $Title->save($_POST);
        break;
    
    // default:
    //     # code...
    //     break;
}

// 步驟4
1.新增 if判斷式  變數$table 
2.只有title單選  其他複選  用判斷式隔開
3.如果資料表==title顯示0 否則顯示1
4.只有一個為0  其他大多為1
if ($table == 'title') {

    // 移進判斷式
    $_POST['sh'] = 0;
} else {
    $_POST['sh'] = 1;
}

// 步驟4：49行
1. 因為選單8-admin 資料表沒有sh欄位 但共用insert新增功能，F12會報錯 但不影響功能
參考6/27筆記-550行 截圖
2. ./api/insert.php 改成switch  也可用else if/比較麻煩
3. 複習if/真假二選一 跟switch/多選分配 條件式差異

*/
</script>