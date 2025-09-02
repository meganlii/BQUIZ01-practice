<?php
// 收後台./modal/title.php 新增網站標題圖片 送來的表單資料  寫到資料庫

include_once "db.php";
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";

// 步驟1
// 如果有上傳圖片就放上去
if (!empty($_FILES['img']['tmp_name'])) {

    move_uploaded_file($_FILES['img']['tmp_name'], "../images/" . $_FILES['img']['name']);
    $_POST['img'] = $_FILES['img']['name'];
}

// 所有上傳照片 預設不顯示 之後再手動調整
// $_POST['sh']=0;


// 步驟2
// 更改.\modal\title.php <form action=
$db=${ucfirst($_POST['table'])};


// 0700開始
// 步驟3
// 新增 if判斷式  變數$table 
// 只有title單選  其他複選  用判斷式隔開
// 如果資料表==title顯示0 否則顯示1
// 只有一個為0  其他大多為1
// 改成變數寫法
if ($table == 'title') {

    // 移進判斷式
    $_POST['sh'] = 0;
} else {
    $_POST['sh'] = 1;
}









// 步驟2
// $table 怎麼來的？ get送來  另外加上
// 路徑改成參數寫法 對應$table
// to('../backend.php?do=title');  單引號變數會失效 變成字串
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
(5) 用判斷式if / switch case、迴圈 排除特例或做特別處理
簡化重複多的程式碼

2.第23行
(1) 先從 .\api\insert_title.php
(2) 複製.\api\insert_title.php  更名為 .\api\insert.php

3.思考脈絡
一開始只能直覺寫 之後再整合 不可能一次寫對 寫最精簡的精華

// 步驟3
1. ucfirst大寫字串(UpperCase縮寫)  lcfirst小寫字串
2. php7.0新增 PHP ${  } 大括號 字串插值（string interpolation） 參考JS 模板字串：組合文字和變數
$table='title';
$db=${ucfirst($table)};
$db=$Title;

// 不需要步驟4
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

*/
</script>