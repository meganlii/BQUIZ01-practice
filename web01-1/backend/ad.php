<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <!-- 步驟0：測試頁  更名為 動態文字廣告管理 -->
  <!-- 先不複製其他7個頁面 每頁互動方式不同要改變 避免混淆 -->
  <!-- 總共9個 7個差不多 另外2個有異動 -->

  <!-- 步驟1：複製 .\backend\title.php ctrl+a全選後貼上 -->

  <p class="t cent botli">動態文字廣告管理</p>

  <form method="post" action="./api/edit_ad.php">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="80%">動態文字廣告</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
          <td></td>
        </tr>

        <?php
        $rows = $Ad->all();
        foreach ($rows as $row) :
        ?>
        <tr>
          <td>
            <input type="text" name="text[]" value="<?=$row['text'];?>" style="width:90%">
          </td>
          <td>
            <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? "checked" : ""; ?>>
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
          <td width="200px">
            <input type="button" onclick="op('#cover','#cvr','./modal/ad.php')" value="新增動態文字廣告">
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
/**
// 路徑 ./當前目錄  以backend.php角度來看
// 此頁 include 到 後台./backend.php-149行 可吃到db.php資料
// 位置 ./backend/title.php 後台右半部版型區


// 步驟2：由上而下修改
// 第7行 
1.<p>標題
2.<tbody> 表單只有三個欄位 移除替代文字
3.修改欄位寬度 剩下60% 改成 80-10-10


// 步驟3：迴圈循環動態生成欄位資料 
// 第23行
1. 複製第一段<tr class="yel"> 貼到第二段<tr>
不需要寬度比例  會以第一段為主
2. 選取整個<tr>後ctrl+c 再選取第二段ctrl+v 比較不會亂掉
3. 移除 class="yel"
4. 更改foreach參數 $Ad->all() db.php增加$Ad=new DB('ad');

// 步驟4：資料庫新增資料表
複製titles >操作>copy table > 
1. 勾選第一個/僅結構  不要第二個/結構和資料  
2. 刪除img
3. 修改備註為 動態文字廣告


// 步驟4：修改foreach資料 <input> 
// 第26行
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
1. 之前複製title.php 已經帶hidden_id  aip就可進行編輯
2. action="./api/edit_title.php" 改為 edit_ad.php
3. 複製貼上 .\api\edit_title.php 更名為 edit_ad.php

 */
</script>

<?php
// 用 PHP 註解或放在 footer 比較安全  此頁回上一層找cover 加上註解畫面會跑掉
// 盡量避免在<form> <table> → <tr> 中間直接加 HTML 註解，尤其是多層 include 的情況
// 移除&#39 --> 單引號' ' 標籤內有單雙引號時使用 html_entities
// https://www.w3schools.com/html/html_entities.asp

?>