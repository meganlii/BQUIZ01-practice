<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">選單管理</p>

  <form method="post" action="./api/edit.php">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="30%">主選單名稱</td>
          <td width="30%">選單連結網址</td>
          <td width="10%">次選單數</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
          <td width="10%">
            <!-- 移除路徑參數 讓彈出視窗可正常顯示 -->
            <!-- 測試OK 先註解 -->
            <!-- <input type="button" value="編輯次選單" onclick="op('#cover','#cvr','./modal/submenu.php')"> -->
          </td>
          <!-- <td width="10%">編輯次選單</td> -->
        </tr>

        <?php
        $rows = ${ucfirst($do)}->all();
        // $rows = ${ucfirst($do)}->all();

        foreach ($rows as $row) :
        ?>
          <tr>
            <td>
              <input type="text" name="text[]" value="<?= $row['text']; ?>" style="width:90%">
            </td>
            <td>
              <input type="text" name="href[]" value="<?= $row['href']; ?>" style="width:90%">
            </td>

            <td>3.次選單數</td>

            <td>
              <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? "checked" : "" ;?> >
            </td>
            <td>
              <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
            </td>
            <!-- <td>6.增加按鈕-編輯次選單</td> -->
            <td>
              <input type="button" value="編輯次選單"
                onclick="op('#cover','#cvr','./modal/submenu.php?id=<?= $row['id']; ?>&table=<?= $do; ?> ')">
              <!-- onclick="op('#cover','#cvr','./modal/update_title.php?id=< ?= $row['id']; ?>&table=< ?= $do; ?> ')"> -->
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
            <input type="button" onclick="op('#cover','#cvr','./modal/<?= $do; ?>.php?table=<?= $do; ?>')"
              value="新增主選單">
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

// 步驟1
複製/修改 .\backend\admin.php 更名為 .\backend\menu.php

// 步驟2：第7行
// 由上而下修改
1. <p> 50行 修改標題  選單管理
2. <tbody> 表單6個欄位 更名
3. 08行 修改欄位寬度比例 改成30/30  移除sh顯示欄位
4. 30行 複製1個<td> 複製多選框改成sh 
5. 24行 修改2個<td> 更改type=text name=text href
6. 68行 新增主選單

// 步驟3
1. 第六個欄位有 按鈕-編輯次選單 到title複製onclick()
onclick="op('#cover','#cvr','./modal/update.php?id=< ?= $row['id']; ?>&table=< ?= $do; ?> ')">
2. 更名為 編輯次選單
3. 彈出視窗 獨立給一個檔案 submenu.php - 老師會花半天說明原理
複製./modal/update.php 更名為 ./modal/submenu.php

// 步驟4
1. 13行 複製到上方表格標題欄位 測試是否正常顯示
出現錯誤訊息  無法顯示彈出視窗
2. 移除路徑參數 ?id=< ?= $row['id']; ?>&table=< ?= $do; ?> 
讓彈出視窗可正常顯示
3. ./modal/submenu.php 15行 21行也先註解

// 步驟5
複製/修改 .\modal\admin.php 更名為 .\modal\menu.php

// 步驟6
1. 測試新增功能 顯示功能沒有預設打勾 回到.\backend\menu.php 
2. 38行 加上php變數< ?=($row['sh'] == 1) ? "checked" : "" ;?>
本來checked 直接加在標籤內不用加雙引號
3. 新增兩個主選單：管理登入、網站首頁  
4. 新增兩個連結網址：?do=login  index.php   寫變數？

// 步驟7
修改 編輯功能 ./api/edit.php
1. 複製admin兩個 $row 更名為text href
2. 複製default一個 $row['sh']
這段忘記什麼意思？
$row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;


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
修改 ./backend/ad.php   ./modal/ad.php
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