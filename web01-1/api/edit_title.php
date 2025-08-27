<?php
include_once './db.php';
// F12預覽畫面 網址輸入 api/edit_title.php
// to("../backend.php?do=title");
// dd($_POST);

foreach ($_POST['id'] as $key => $id) {
  if(isset($_POST['del']) && in_array($id,$_POST['del'])) {

  $Title->del($id);

  }else{

  $row=$Title->find($id);
  dd($row);
  $row['text']=$_POST['text'][$key];
  $row['sh']=($_POST['sh']==$id)?1:0;
  $Title->save($row);
  dd($row);

  }

}

// to("../backend.php?do=title");

?>

<script>
/** 
* 步驟1：先dd陣列
* 步驟2：foreach、if + isset()網頁傳值先判斷預設值
(1)foreach ($_POST['id'] as $key => $id)  
關聯陣列/變數 ['id']取出 $key跟 $id
(2)isset($_POST['del']) ['del']是否存在  確認是否刪除必要性
(3)in_array($id,$_POST['del']
再確認迴圈的['id']有沒有在['del']陣列裡面
(4)isset()跟in_array()先後順序 不可顛倒
(5)不寫第二個foreach ($_POST['del'] as $id)
程式碼只需跑4次  不用跑6次

* 步驟3：$row=$Title->find($id);
查詢 符合id的 "單筆資料"  回傳資料表 指定id的資料

* 步驟4：$row['sh']=($_POST['sh']==$id)?1:0;  三元運算式

* 步驟5：$Title->save($row)  如何知道新增或更新
留意$key是變數，不用再加單引號

* 步驟6：手動資料庫將其中一筆改為顯示 ['sh']=1

* 步驟7：出現意外狀況 程式寫完後，要先執行刪除 再點選單選框就正常
剛寫完測試 點選單選框後，按下"修改確定"後，單選框顯示會消失不見


* 備註：檢定寫法是全部跑一次 全部處理
實務上要多寫很多檢查程式 自動判斷資料有無如何處理 或定位有變更才處理
規模不同 解決問題步驟有差異
*/
</script>