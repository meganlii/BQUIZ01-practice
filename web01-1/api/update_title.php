<?php
// 負責收 後台./madal/update_title.php 更新圖片 送來的表單資料  寫到資料庫
// 收資料 先新增兩個陣列變數 $_FILES['img']  $_POST['id']
// 步驟1：套用 .\api\insert_title.php
include_once './db.php';

// 步驟2：確認檔案是否上傳成功
if (!empty($_FILES['img']['tmp_name'])) {

  // 步驟3：檔案移到暫存區
  move_uploaded_file($_FILES['img']['tmp_name'], "../images/" . $_FILES['img']['name']);

  // 步驟：檔名是否相同

  // 步驟4：拿出原本資料
  $row=$Title->find($_POST['id']);

  // 步驟5：更改檔名  原檔名 改為 上傳的新檔名
  // $_POST['img'] = $_FILES['img']['name'];
  $row['img'] = $_FILES['img']['name'];

  $_POST['sh'] = 0;

}

$Title->save($_POST);

to('../backend.php?do=title');
