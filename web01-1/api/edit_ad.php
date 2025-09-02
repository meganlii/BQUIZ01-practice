<?php
// 詳解另參 錄音檔 0624-8 完成網站標題管理修改資料功能(D)
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

  // isset()跟in_array() 搭配使用 
  if (isset($_POST['del']) && in_array($id, $_POST['del'])) {

    // 步驟1：將所有 $Title 改成 $Ad
    $Ad->del($id);
  } else {

    $row = $Ad->find($id);

    // 印出 從資料表拿出的$row
    dd($row);

    // $row['text']資料庫的替代文字改為完成動態文字廣告  對應  $_POST表單送來的資料  對照截圖看
    $row['text'] = $_POST['text'][$key];

    // 步驟2：修改$row['sh'] 可多選  之前sh不是陣列sh[]
    // 修改三元運算式

    // 寫法1：$row['sh']=($_POST['sh']==$id)?1:0;
    // 要加上in_array() 確認迴圈['id'] 是否在$_POST['sh']陣列裡面 ~ 還要搭派isset()是否存在 一起使用

    // 寫法2：$row['sh']=($in_array($id,$_POST['sh']))?1:0; 
    // (1)還是有問題，如果全部都不勾選 值沒有送出去$_POST['sh']會變成undefined
    // (2)要加上isset()判斷，同上方寫法if($_POST['del']

    // 寫法3：先判斷 顯示是否存在 if如果有存在且有id才設為1 不存在則為0。如果全部都沒勾選 沒有資料送出->全部不存在->全部不顯示

    $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;


    // 步驟6：如何知道新增或更新？因為有id
    $Ad->save($row);

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

3. 思考程式優化：再思考哪些功能可以合併，參6/27筆記-第120行


*/
</script>