<!-- 負責收./madal/title.php 送來的表單資料  寫到資料庫 -->
<?php

include_once "db.php";
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";


// 陣列$_FILES [' '] [' ']
// 三步驟：檢查 / 移動 / 紀錄

// 步驟1 檢查 / !empty( ) 檢查是否有檔案上傳 
// $_FILES['img'] = 上傳的檔案資訊
// ['tmp_name'] = 檔案暫存區 / 當檔案上傳後會先存在暫存區  並由伺服器給予一組亂碼的檔名
// !empty() = 檢查是否「不是空的」
// 意思：如果用戶真的有選檔案上傳，就執行下面的程式
if(!empty($_FILES['img']['tmp_name'])){
    
    // 步驟2 移動 / move_uploaded_file( ) 移動 上傳完成檔案 到 指定目錄下，並指定檔名
    // 兩個參數 ( $from , $to )
    // 把檔案從暫存區移到 ../images/ 資料夾
    // $_FILES['img']['name'] = 檔案的原始名稱 可能帶副檔名
    move_uploaded_file($_FILES['img']['tmp_name'], "../images/".$_FILES['img']['name']);
    
    // 步驟3 記錄 / 記錄檔案名稱
    // 把右方檔案名稱 存到 $_POST['img'] 變數中
    $_POST['img']=$_FILES['img']['name'];
}
