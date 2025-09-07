<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">校園映像圖片管理</p>

  <form method="post" action="./api/edit.php">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="80%">校園映像圖片</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
          <td></td>
        </tr>

        <?php
        // $rows=$Title->all();
        $rows = ${ucfirst($do)}->all();

        foreach ($rows as $row) :
        ?>
        <tr>
          <td>
            <img src="./images/<?= $row['img']; ?>" 
            style=" width:120px;height:68px; ">
          </td>
          <td>
            <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? "checked" : ""; ?>>
          </td>
          <td>
            <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
          </td>

          <td>
            <input type="button" value="更換圖片"
              onclick="op('#cover','#cvr','./modal/update.php?id=<?= $row['id']; ?>&table=<?= $do; ?> ')">
          </td>
        </tr>

        <input type="hidden" name="id[]" value="<?= $row['id']; ?>">

        <?php
        endforeach;
        ?>

      </tbody>
    </table>

    <table style="margin-top:40px; width:70%;">
      <tbody>
        <tr>
          <input type="hidden" name="table" value="<?= $do; ?>">

          <td width="200px">
            <!-- <input type="button" onclick="op('#cover','#cvr','./modal/<?= $do; ?>.php?table=<?= $do; ?>')" -->
            <input type="button" onclick="op('#cover','#cvr','./modal/<?= $do; ?>.php?table=<?= $do; ?>')"
              value="新增校園映像圖片">
          </td>

          <td class="cent">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
          </td>

        </tr>
      </tbody>
    </table>

  </form>
</div>

<script>
/*
// 位置 ./backend/title.php 後台右半部版型區 
// 此頁 include 到 後台./backend.php-149行 可吃到db.php資料
// 有兩個<table>

// 路徑 屬於./當前目錄  web01-1目錄  以backend.php角度來看  
// 所以<form> action="./api/edit_title.php"  用./  不是../
// 其他資料夾modal、backend檔案 送到api處理  要以backend.php角度來看跟api關係  屬於./當前目錄  web01-1目錄 
// api處理完了，資料夾api內的檔案跟backend.php關係 則是回上一層  用../  回到後台

// 步驟0
複製 .\backend\mvim.php 更名為image.php

// 步驟1
由上而下修改

1. 修改表單 欄位名稱
02行/08行/32行/54行
校園映像圖片管理/校園映像圖片/更換圖片/新增校園映像圖片

2. 33行 onclick已經設定更新模組-自動帶入參數 
./modal/update.php

// 步驟2
1. 記得db.php加上 DB物件 $Image
後面還有七個功能，可一次全部加上

// 步驟3
1. 22行 後台圖片大小有規範  後台管理顯示大小為 100*68 像素。
style="width:100px" 
置中失效 可能要設在別處？？
text-align:center / align-items: center / vertical-align:middle 

// 步驟4
// CURD 增C、改U  刪查/編輯功能
不須更新 update

// 步驟5
insert功能  新增modal
複製 .\modal\mvim.php  更名為 image.php

// 步驟6
edit功能
新增圖片後，顯示功能無法修改  還沒有更新edit功能 
修改 .\api\edit.php


----以下不須更動，已經用變數取代
2. 複製 .\modal\update_title.php 更名為 .\modal\update_mvim.php 

// 步驟3
6/27-5 整併更新圖片api為一支
1. 新增 <input type="hidden" name="table" value= 
2. 回到 .\backend\title.php 設定onclick路徑參數
3. 33行 新增onclick參數 &table= < ?= $do; ?>
參考52行 

// 步驟4
修改 33行 onclick路徑
沒有改成$do參數  避免一行程式 重複帶一樣參數

*/
</script>

<?php
// 用 PHP 註解或放在 footer 比較安全  此頁回上一層找cover 加上註解畫面會跑掉
// 盡量避免在<form> <table> → <tr> 中間直接加 HTML 註解，尤其是多層 include 的情況
// 移除&#39 --> 單引號' ' 標籤內有單雙引號時使用 html_entities
// https://www.w3schools.com/html/html_entities.asp

?>