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

  // 步驟4：拿出原本資料 單筆資料 所以不用$rows
  // $row資料表-行變數 $row['id'] 用法參考.\backend\title.php
  $row=$Title->find($_POST['id']);

  // 步驟5：更改檔名  原檔名 改為 上傳的新檔名
  // 上傳的新檔名 取代 原檔案
  
  // *如果上傳的新檔名=原檔名  不刪除  
  // 檔名不同要刪除  但也可能別筆資料對應到同檔名不能刪除-不懂
  // *實務：共用檔案，檔名會出現問題。同新增檔案補充作法
  // 不管檔名是否重複 圖片一樣檔名都不同 檔名都需要重新編碼/使用$file md5 確保每次都不同
  // *檢定：會有重複檔案/檔名問題 檔案蓋來蓋去，以檢定來說 不更改檔名不會有衝突
  
  $row['img'] = $_FILES['img']['name'];
  // $_POST['img'] = $_FILES['img']['name'];
  // $_POST['sh'] = 0;

  $Title->save($row);

}

// $Title->save($_POST);

to('../backend.php?do=title');
