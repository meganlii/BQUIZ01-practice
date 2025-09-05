<?php
// 負責收 後台./modal/update_mvim.php 更新圖片 送來的表單資料  寫到資料庫
// 收資料 先新增兩個陣列變數 $_FILES['img']  $_POST['id']
// 更新功能獨立 編輯功能多為文字的顯示/刪除 所以兩個api處理頁面

include_once './db.php';

// 確認檔案是否上傳成功
if (!empty($_FILES['img']['tmp_name'])) {

  // 檔案移到暫存區
  move_uploaded_file($_FILES['img']['tmp_name'], "../images/" . $_FILES['img']['name']);

  // 步驟1：$Title 改成 $Mvim
  $row = $Mvim->find($_POST['id']);

  // 更改檔名  原檔名 改為 上傳的新檔名
  $row['img'] = $_FILES['img']['name'];
  // $_POST['img'] = $_FILES['img']['name'];
  // $_POST['sh'] = 0;

  // 步驟6：測試 更新圖片成功  正常實務上資料夾images圖片，應該重新改檔名
  // 步驟7：測試 新增1張圖片變成5張  因為使用原檔名，資料夾images圖片沒有新增，只有四個
  $Mvim->save($row);
}

// $Title->save($_POST);

// 步驟2：title 改成 mvim
to('../backend.php?do=mvim');