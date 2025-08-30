<?php
// 錄音檔 0624-8 完成網站標題管理修改資料功能(D)
// 收後台 .\backend\ad.php 表單 編輯/顯示/刪除
// <form method="post" action="./api/edit_ad.php">
// 之前有加hidden id，辨識異動項目  api就可編輯
// F12預覽畫面 網址輸入 api/edit_ad.php

// to("../backend.php?do=ad");
// dd($_POST);

include_once './db.php';

// dd陣列  印出 表單收到資料
dd($_POST);

foreach ($_POST['id'] as $key => $id) {
  
  
  if(isset($_POST['del']) && in_array($id,$_POST['del'])) {
    
  // 步驟1：將所有 $Title 改成 $Ad
  $AD->del($id);

  }else{

  // 步驟：
  $row=$AD->find($id);
  
  // 印出 從資料表拿出的$row
  dd($row);

  // 步驟：$row['text']是資料庫的替代文字  對應  $_POST表單送來的資料  對照截圖看
  $row['text']=$_POST['text'][$key];


  // *****從這邊開始
  // 步驟2：修改$row['sh'] 可多選  之前sh不是陣列sh[]
  // in_array() 確認迴圈['id'] 是否在  $_POST['sh']陣列裡面
  $row['sh']=($_POST['sh']==$id)?1:0;

  // 步驟6：如何知道新增或更新？因為有id
  $AD->save($row);

  // 印出 存到資料表的$row
  dd($row);

  }

}

// 步驟2：do=title 改成 do=ad
to("../backend.php?do=ad");

?>

<script>
/** 
1. 出現意外狀況 程式寫完後，要先執行刪除 再點選單選框就正常
剛寫完測試 點選單選框後，按下"修改確定"後，單選框顯示會消失不見
(有可能 同時選到顯示跟刪除)

2. 檢定與實務差異：檢定寫法是全部跑一次 全部處理
實務上要多寫很多檢查程式 自動判斷資料有無如何處理 或定位有變更才處理
規模不同 解決問題步驟有差異

*/
</script>