<?php
// 錄音檔 0624-8 完成網站標題管理修改資料功能(D)
// 寄件人/收後台 .\backend\title.php 表單 編輯/顯示/刪除
// <form method="post" action="./api/edit_title.php">
// 之前有加hidden id，辨識異動項目  api就可編輯
// F12預覽畫面 網址輸入 api/edit_title.php

// 其他資料夾modal、backend檔案 送到api處理  要以backend.php角度來看跟api關係  屬於./當前目錄  web01-1目錄 
// api處理完了，資料夾api內的檔案跟backend.php關係 則是回上一層  用../  回到後台
// to("../backend.php?do=title");

include_once './db.php';

// dd陣列  印出 表單收到資料
dd($_POST);

// 步驟1
// (1) 先從 .\api\edit_title.php
// (2) 複製 .\api\edit_title.php  更名為 .\api\edit.php

// 步驟2
// 差別在資料表不同 $Title 或 $Ad
// 先將table拿進來  表單頁面要帶value=資料表名稱(title或ad)
$table=$_POST['table'];
$db=${ucfirst($table)};


// 步驟3
// $Title 全部改用$db 代替
// foreach、if + isset()網頁傳值先判斷預設值

foreach ($_POST['id'] as $key => $id) {

  // * isset()跟in_array() 搭配使用 
  if(isset($_POST['del']) && in_array($id,$_POST['del'])) {
  $db->del($id);
  }else{

  // 處理編輯  取出資料查詢符合id的"單筆資料"  回傳資料表 指定id資料
  $row=$db->find($id);
  
  // 印出 從資料表拿出的$row
  dd($row);

  
  // 步驟4
  // $row['text']  $row['sh']
  // 有的沒有['text']欄位  後面選單['text']是路徑不是文字
  // 同insert.php作法 用判斷式  
  // 較複雜改用switch 拆開有差異的地方 只有第8.9個 管理者/選單管理 不同
  
  
  // 步驟5：先列出table  複製7個
  switch ($table) {

    // 步驟5-1：放上此頁title兩行
    case 'title':
      $row['text']=$_POST['text'][$key];
      $row['sh']=($_POST['sh']==$id)?1:0;
      break;
    
    // 步驟5-2：複製ad兩行貼過來
    // api\edit_ad.php
    case 'ad':
    $row['text'] = $_POST['text'][$key];
    $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
    break;
    
    case 'mvim':
      # code...
      break;
    case 'image':
      # code...
      break;
    case 'news':
      # code...
      break;
    case 'admin':
      # code...
      break;
    case 'menu':
      # code...
      break;  

  }

// 步驟6
// 修改 .\backend\title.php  .\backend\ad.php
// 新增 隱藏欄位輔助 input:hidden
// 修改 表單路徑
// <form method="post" action="./api/edit.php">
// 刪除 兩個頁面 ./api/edit_title.php  ./api/edit_ad.php 



  // 如何知道新增或更新？因為有id
  $db->save($row);

  // 印出 存到資料表的$row
  dd($row);

  }

}

// 步驟3：回到$table
to("../backend.php?do=$table");

?>

<script>
/** 
//  $row['text']=$_POST['text'][$key];
資料庫的替代文字  對應$_POST表單送來的資料  對照截圖看

// $row['sh']=($_POST['sh']==$id)?1:0;
ad複選寫法 二維陣列  $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
title單選寫法 一維陣列只有值  三元運算式  條件式用兩個等號=
*/
</script>