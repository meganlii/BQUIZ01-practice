<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">頁尾版權管理</p>

  <form method="post" action="./api/edit_column.php">
    <table width="50%" style="margin:auto">
      <tbody>
        <tr class="yel">
          <td width="50%">頁尾版權：</td>
          <td width="50%">
            <?php
            $row = ${ucfirst($do)}->find(1);
            // dd($row)
            ?>

            <input type="text" name="bottom" value="<?= $row['bottom']; ?>" style="width:90%">
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
所以<form> action="./api/edit_ad.php"  ./不是  ../
此頁 include 到 後台./backend.php-149行 可吃到db.php資料
位置 ./backend/title.php 後台右半部版型區

// 複習歸納
1. $row = ${ucfirst($do)}->find(1)
2. value 設定陣列/key/資料表欄位 "< ?= $row['bottom']; ?>"




------------------
// 步驟0
1. 複製 .\backend\total.php 更名為 bottom.php
2. 頁尾版權區和total.php頁面結構一樣，直接複製後修改套用

// 步驟1
1. 15行 修改資料表名稱 bottom
2. api如果寫正確 測試即可成功

---------------
// 步驟1：第7行
// 由上而下修改
1. <p>標題：頁尾版權管理
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




*/
</script>

<?php
// 用 PHP 註解或放在 footer 比較安全  此頁回上一層找cover 加上註解畫面會跑掉
// 盡量避免在<form> <table> → <tr> 中間直接加 HTML 註解，尤其是多層 include 的情況
// 移除&#39 --> 單引號' ' 標籤內有單雙引號時使用 html_entities
// https://www.w3schools.com/html/html_entities.asp

?>