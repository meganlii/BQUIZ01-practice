<?php
// 負責收 後台./modal/update_title.php 更新圖片 送來的表單資料  寫到資料庫
// 收資料 先新增兩個陣列變數 $_FILES['img']  $_POST['id']
// 更新功能獨立 編輯功能多為文字的顯示/刪除 所以兩個api處理頁面

// 套用 .\api\insert_title.php  更名 .\api\update_title.php
include_once './db.php';

// 步驟1
// 設定$table
$table = $_POST['table'];
$db = ${ucfirst($table)};

// 步驟2
// 物件改成變數$db


// 確認檔案是否上傳成功
if (!empty($_FILES['img']['tmp_name'])) {


  // 檔案移到暫存區
  move_uploaded_file($_FILES['img']['tmp_name'], "../images/" . $_FILES['img']['name']);


  // 拿出原本資料 單筆資料 所以不用$rows
  // $row資料表-行變數 $row['id'] 用法參考.\backend\title.php
  $row = $db->find($_POST['id']);


  $row['img'] = $_FILES['img']['name'];
  // $_POST['img'] = $_FILES['img']['name'];
  // $_POST['sh'] = 0;

  
  $db->save($row);
}

// $Title->save($_POST);

// 步驟3
// title改成 $table  改成雙引號
to("../backend.php?do=$table");

// 步驟4
// 刪除之前兩個檔案.\api\update_title.php  .\api\update_mvim.php