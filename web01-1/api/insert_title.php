<!-- 負責收./madal/title.php 送來的表單資料  寫到資料庫 -->
<?php

include_once "db.php";
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";

// 步驟1 !empty() 檢查是否有檔案上傳 
// 步驟2 $_FILES
// 如果不是空值 執行 移動上傳檔案函數到 資料夾images


if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../images/".$_FILES['img']['name']);
    $_POST['img']=$_FILES['img']['name'];
}
