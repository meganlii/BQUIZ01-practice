<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">進佔總人數管理</p>

  <form method="post" action="./api/edit_column.php">
    <table width="50%" style="margin:auto">
      <tbody>
        <tr class="yel">
          <td width="50%">進佔總人數</td>
          <td width="50%">
            <?php
            
            // Array
            // (
            //     [id] => 1
            //     [total] => 200
            // )
            // ${ucfirst($do)}->find(1)['total'] 
            // 得到上方$row陣列 再加上key['total'] 得到 value=200 
            // 也可分開寫：將得到的陣列結果 另設變數$row 對應下方 $row['id']
            // find(1) 等同 $_POST['id']
            $row = ${ucfirst($do)}->find(1); 
            // dd($row)
            ?>

            <input type="text" name="total" value="<?= $row['total'] ;?>" style="width:90%">
            <input type="hidden" name="id" value="<?= $row['id']; ?>">
          </td>
        </tr>
      </tbody>
    </table>

    <table style="margin-top:40px; width:70%;">
      <tbody>
        <tr>
          <input type="hidden" name="table" value="<?= $do; ?>">

          <td width="200px">
            <!-- <input type="button" onclick="op('#cover','#cvr','./modal/< ?= $do; ?>.php?table=< ?= $do; ?>')"
              value="新增動態文字廣告"> -->
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


// 步驟1：第7行
// 由上而下修改
1. <p>標題：進佔總人數管理
2. <tbody> 表單只有2個欄位 移除刪除
3. <table width="100%"> 改成 50%
表格置中  margin:auto
4. 修改欄位寬度比例 剩下一半 改成 50/50，實際只有25%
比例沒有生效  應該是下面php指令干擾 刪除後就正常顯示


// 步驟2：刪除用不到欄位
1. 16行/33行 只有一欄數字 不需要foreach 
2. 20行 複製input到 09行<td>裡面
3. 18-28行 <tr>整列不需要  保留30行id
4. 08行 動態文字廣告 改成 進佔總人數
5. 46行 移除<input>按鈕 新增動態文字廣告 不要動到外面 <td>  才不會影響其他兩個按鈕置中

// 步驟3
1. 09行 value要改成進佔總人數，如何拿到？
2. 套用${ucfirst($do)} 拿到物件$Total  造成下面<table>消失？
改用$do 測試正常
<input type="text" name="text[]" value="< ?= $do ?>" style="width:90%">
3. 14行 註解php
4. name="id[]"移到 12行

// 步驟4：24行
1. ${ucfirst($do)} 只有拿到物件$Total 如何拿到特定一筆資料
2. 改成${ucfirst($do)}->find(1) 得到陣列  出現錯誤訊息提示 Array to string conversion
3. 要再加上key['total'] 得到 value=200
4. 24行/25行 取消陣列 name="text[]改為 name="total"  name="id[]" 改為 name="id"



// 步驟5
1. 只有一筆資料 獨立寫edit功能：其他都是多筆資料編輯 post送出後生成多維陣列 無法共用 api\edit.php
2. 04行 新增 api\edit_column.php
<form method="post" action="./api/edit_column.php">
3. 此表 沒有新增功能



--------------------------
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
複製 .\backend\ad.php 更名為 news.php

// 步驟10
複製 .\backend\ad.php 更名為 total.php

*/
</script>

<?php
// 用 PHP 註解或放在 footer 比較安全  此頁回上一層找cover 加上註解畫面會跑掉
// 盡量避免在<form> <table> → <tr> 中間直接加 HTML 註解，尤其是多層 include 的情況
// 移除&#39 --> 單引號' ' 標籤內有單雙引號時使用 html_entities
// https://www.w3schools.com/html/html_entities.asp

?>