<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <!-- 步驟0：測試頁  更名為 動態文字廣告管理 -->
  <!-- 先不複製其他7個頁面 每頁互動方式不同要改變 避免混淆 -->
  <!-- 總共9個 7個差不多 另外2個有異動 -->

  <!-- 步驟1：複製 .\backend\title.php ctrl+a全選後貼上 -->

  <p class="t cent botli">最新消息管理</p>

  <form method="post" action="./api/edit.php">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="80%">最新消息內容</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
          <td></td>
        </tr>

        <?php
        $rows = ${ucfirst($do)}->all();
        // $rows = ${ucfirst($do)}->all();

        foreach ($rows as $row) :
        ?>
        <tr>
          <td>
            <textarea name="text[]" style="width: 90%;height: 60px;"><?= $row['text']; ?></textarea>
            <!-- <input type="text" name="text[]" value="< ?= $row['text']; ?>" style="width:90%"> -->
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
          <input type="hidden" name="table" value="<?= $do; ?>">

          <td width="200px">
            <input type="button" onclick="op('#cover','#cvr','./modal/<?= $do; ?>.php?table=<?= $do; ?>')"
              value="新增最新消息">
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
// 所以<form> action="./api/edit_ad.php"  ./不是  ../
// 此頁 include 到 後台./backend.php-149行 可吃到db.php資料
// 位置 ./backend/title.php 後台右半部版型區

// 步驟1
複製 .\backend\ad.php 更名為news.php

// 步驟2
由上而下修改

1. 修改表單 欄位名稱
08行/14行/56行
最新消息管理/最新消息內容/新增最新消息

2. 28行 <input>改成<textarea>  </textarea>
不要斷行  不要加字
value="< ?= $row['text'] 寫到前後標籤中間 不用寫value=
設定高度60px


// 步驟3
// CURD 增C、改U  刪查/編輯功能
不須更新 update

// 步驟4
測試insert功能  新增modal
55行 onclick已經設定 新增模組-自動帶入參數 
1. 複製 .\modal\ad.php  更名為 news.php


// 步驟5
測試edit功能 修改 .\api\edit.php
新增最新消息內容後 可刪除 但顯示功能沒有變更  還沒有更新edit功能 


*/
</script>

<?php
// 用 PHP 註解或放在 footer 比較安全  此頁回上一層找cover 加上註解畫面會跑掉
// 盡量避免在<form> <table> → <tr> 中間直接加 HTML 註解，尤其是多層 include 的情況
// 移除&#39 --> 單引號' ' 標籤內有單雙引號時使用 html_entities
// https://www.w3schools.com/html/html_entities.asp

?>