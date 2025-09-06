<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">動畫圖片管理</p>

  <form method="post" action="./api/edit.php">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="80%">動畫圖片</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
          <td>更動</td>
        </tr>

        <?php
        // $rows=$Title->all();
        $rows = ${ucfirst($do)}->all();

        foreach ($rows as $row) :
        ?>
        <tr>
          <td>
            <img src="./images/<?= $row['img']; ?>" style="width:120px">
          </td>
          <td>
            <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? "checked" : ""; ?>>
          </td>
          <td>
            <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
          </td>

          <td>
            <input type="button" value="更換動畫"
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
              value="新增動畫圖片">
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

// 步驟1
由上而下修改
1. 複製 .\backend\title.php 更名為mvim.php
2. 02行 修改表單 欄位名稱  沒有規定標題
3. 08行 移除text 修改欄位寬度比例%  80/10/10
4. 不用改 action  table名稱$do會動態生成mvim
5. 24行 移除text
6. 22行 自行設定圖片大小 不是長條形  改成長方形 w120px 移除高度-會等比縮放
7. 移除<td>比例  會隨<tbody><td>第一行標題縮放
8. 25行 改成checkbox  sh[]
9. 33行 onclick還沒有設定更新模組 手動改成./modal/update_mvim.php
10 53行/32行  value="新增動畫圖片"  value="更換動畫"

// 步驟2
1. 記得db.php加上 DB物件 $Mvim
後面還有七個功能，可一次全部加上

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