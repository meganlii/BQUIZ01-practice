<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">管理者帳號管理</p>

  <form method="post" action="./api/edit.php">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="40%">帳號</td>
          <td width="40%">密碼</td>
          <td width="10%">刪除</td>
        </tr>

        <?php
        $rows = ${ucfirst($do)}->all();
        // $rows = ${ucfirst($do)}->all();

        foreach ($rows as $row) :
        ?>
          <tr>
            <td>
              <input type="text" name="acc[]" value="<?= $row['acc']; ?>" style="width:90%">
            </td>
            <td>
              <input type="password" name="pw[]" value="<?= $row['pw']; ?>" style="width:90%">
            </td>
            <td>
              <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
            </td>
            <td></td>
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
            <input type="button" onclick="op('#cover','#cvr','./modal/<?= $do; ?>.php?table=<?= $do; ?>')"
              value="新增管理者帳號">
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
// 路徑 ./當前目錄  以backend.php角度來看
// 所以<form> action="./api/edit_ad.php"  ./不是  ../
// 此頁 include 到 後台./backend.php-149行 可吃到db.php資料
// 位置 ./backend/title.php 後台右半部版型區

// 步驟0：複製 .\backend\ad.php ctrl+a全選後貼上

// 步驟1：第7行
// 由上而下修改
1. <p> 50行 修改標題
2. <tbody> 表單只有三個欄位 移除替代文字
3. 08行 修改欄位寬度比例 改成 40-40-10  移除sh顯示欄位
4. 23行 複製後 type="password" name改成acc[] pw[]

// 步驟2
1. 複製/修改 .\modal\ad.php 更名為 .\modal\admin.php

// 步驟3
修改 編輯功能 ./api/edit.php
1. 欄位不是text 獨立加上兩行 
2. 複製title $row 更名為acc pw

// 步驟4
複製/修改 .\backend\admin.php 更名為 .\backend\menu.php


備註
1. 檔案改好之後，後台無法正常顯示  因為資料庫沒有更新資料表
2. 後面增加功能很快  可套用前面模組  調整視覺項目/表格較麻煩

----------------------
// 步驟2：第23行 
// 迴圈循環動態生成欄位資料
1. 複製第一段<tr class="yel"> 貼到第二段<tr>
移除<td>比例  會隨<tbody><td>第一行標題縮放
不需要寬度比例  會以第一段為主
2. 選取整個<tr>後ctrl+c 再選取第二段ctrl+v 比較不會亂掉
3. 移除 class="yel"
4. 更改foreach參數 $Ad->all() db.php增加$Ad=new DB('ad');

// 步驟3：
// 資料庫 新增資料表
複製titles >操作>copy table > 
1. 勾選第一個/僅結構  不要第二個/結構和資料  
2. 刪除img
3. text 備註為 動態文字廣告


// 步驟4：第26行
// 修改foreach資料 <input>
1. name=text[]多筆資料加上陣列
2. name="sh"加上陣列[]  改成checkbox
3. <input> 本身有寬度 要另設style="width=90%"固定(沒有全部對齊th)  沒改會變成一半4
width=90%打錯  應為半形冒號 width:90%
style="text-align:center" 失效

// 步驟5：修改第二個table onclick=op()
1. 路徑改成 ./modal/ad.php
2. value= 改成 "新增動態文字廣告"


// 步驟6：彈出視窗
新增.\modal\ad.php

// 步驟7：測試可新增動態文字廣告 處理編輯功能
1. 之前複製title.php 已經帶hidden_id  api就可進行編輯
2. action="./api/edit_title.php" 改為 edit_ad.php
3. 複製貼上 .\api\edit_title.php 更名為 edit_ad.php

// 步驟8
修改 ./backend/ad.php  ./modal/ad.php
1. 53行：此頁 onclick路徑加上  ?table= < ?=$do; ?>
title.php  改成 < ?=$do; ?>.php
onclick="op('#cover','#cvr','./modal/title.php ?table= < ?=$do; ?>')" 
2. 彈出頁面24行 modal\title.php  接收
<input type="hidden" name="table" value="< ?=$_Get['table'];?>">

// 步驟9
複製 .\backend\ad.php 更名為news.php

*/
</script>

<?php
// 用 PHP 註解或放在 footer 比較安全  此頁回上一層找cover 加上註解畫面會跑掉
// 盡量避免在<form> <table> → <tr> 中間直接加 HTML 註解，尤其是多層 include 的情況
// 移除&#39 --> 單引號' ' 標籤內有單雙引號時使用 html_entities
// https://www.w3schools.com/html/html_entities.asp

?>