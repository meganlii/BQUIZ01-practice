<!-- 負責收./madal/title.php 送來的表單資料  寫到資料庫 -->
<?php

include_once "db.php";
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";


// 檔案上傳四步驟：檢查 / 移動 / 紀錄 / 存入資料庫
// 兩個陣列變數 $_FILES [' '] [' ']  / $_POST

// 步驟1 檢查 / !empty( ) 檢查是否有檔案上傳 
// $_FILES['img'] = 上傳的檔案資訊
// ['tmp_name'] = 檔案暫存區 / 當檔案上傳後會先存在暫存區  並由伺服器給予一組亂碼的檔名
// !empty() = 檢查是否「不是空的」 代表 上傳成功
// 意思：如果用戶真的有選檔案上傳，就執行下面的程式
if (!empty($_FILES['img']['tmp_name'])) {
    
    // 步驟2 移動 / move_uploaded_file( ) 移動 上傳完成檔案 到 指定目錄下，並指定檔名
    // 兩個參數 ( $from , $to )
    // 把檔案從暫存區移到 ../images/ 資料夾
    // $_FILES['img']['name'] = 檔案的原始名稱 可能帶副檔名
    // 合併寫法不知是否可行 "../images/{$_FILES['img']['name']}"
    move_uploaded_file($_FILES['img']['tmp_name'], "../images/".$_FILES['img']['name']);
    
    // 步驟3 記錄 / 記錄檔案名稱 $_POST 同$_FILES 屬於 陣列變數
    // 把右方檔案名稱 存到 $_POST['img'] 變數中 之後送到資料庫
    // $_POST['img'] 鍵值來自 <input type="file" name="img">
    // $_POST 一維陣列儲存表單欄位鍵值  鍵值是 欄位名稱['img']['text']
    // 補齊$_POST資料  對應資料表titles 欄位 ['img'] ['sh']
    $_POST['img']=$_FILES['img']['name'];
    $_POST['sh']=0;
}

// 步驟4 DB::save()
// 資料表目前是空的 需要先判斷資料表狀況 決定第一筆上傳資料開或關
// 要寫太多行程式 檢定不適合 改用最大可能性寫法
$Title->save($_POST);

// 步驟5 回到後台do=title
