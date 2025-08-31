<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">網站標題管理</p>

  <form method="post" action="./api/edit_title.php">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="45%">網站標題</td>
          <td width="23%">替代文字</td>
          <td width="7%">顯示</td>
          <td width="7%">刪除</td>
          <td></td>
        </tr>

        <?php
        $rows = $Title->all();
        foreach ($rows as $row) :
        ?>
        <tr>
          <td width="45%">
            <img src="./images/<?= $row['img']; ?>" style="width:300px;height:30px">
          </td>
          <td width="23%">
            <input type="text" name="text[]" value="<?= $row['text']; ?>">
          </td>
          <td width="7%">
            <input type="radio" name="sh" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? "checked" : ""; ?>>
          </td>
          <td width="7%">
            <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
          </td>

          <td>
            <input type="button" value="更新圖片"
              onclick="op('#cover','#cvr','./modal/update_title.php?id=<?= $row['id']; ?>')">
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
          <td width="200px">
            <input type="button" onclick="op('#cover','#cvr','./modal/title.php')" value="新增網站標題圖片">
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
// 此頁 include 到 後台./backend.php-149行 可吃到db.php資料
// 位置 ./backend/title.php 後台右半部版型區 
// 有兩個<table>

// 步驟1：第50行
// onclick="op  op = open  彈出視窗
1. onclick="op('#cover','#cvr','./modal/title.php')"
由js函式op() 觸發 彈出視窗  並載入 ./modal/title.php 內容(原為view.php)

2. 來自上一層backend.php <div id="cover  對照js檔案 function op(x, y, url)
對照三個參數(x, y, url)  #cover / #cvr / #view.php?do=title 
打開F12 查看ajax用法 點下後產生xhr請求


// 步驟2
// 更改 onclick路徑 ./當前目錄  以backend.php角度來看
* onclick="op('#cover','#cvr','view.php?do=title')"
* onclick="op('#cover','#cvr','./modal/title.php')"


// 步驟3：第4行
// 整理<form>參數  不會特別寫<tbody> <form method="post" target="back" action="?do=tii">
1. 移除 target="back"  之前iframe使用

2. 更改 action="?do=tii" 表單資料post送到api處理 不要塞在一個檔案處理
單一頁面多功能：原指reload後 繼續在當前頁處理新增修改
表單送出後，會重新載入當前頁面，但加上 ?do=tii 參數 (留在當前頁，加上參數)
網址變成 ./backend/title.php?do=tii
加上參數 讓程式知道要處理 tii 功能 "正在處理標題設定..."
PHP 接收到 $_GET['do'] = 'tii'; // 從網址參數來的 
$_POST['title'] = '用戶輸入的內容';  // 從表單來的
AI猜測 tii可能是 標題圖片 (Title Image) 的簡寫


// 步驟4：迴圈循環動態生成欄位
// 在第一個<tbody> 輸出上傳圖片資料 複製第一段<tr class="yel">

// 步驟4：第二段<tr>前後
// 加上迴圈
// 第二段<tr>前後 加上迴圈指令在<tr>每列逐筆顯示資料
// 第17行 <tr class="yel">
1. 移除背景圖 class="yel"

2. 這兩段php程式碼，特別用$rows命名 有特別意義：反映資料庫中「行（row）」的概念
從資料庫取得所有標題資料，存到$rows陣列中
$rows = $Title->all();     // 取得所有「列」資料  // 取得所有 rows（所有列）
foreach ($rows as $row) :  // 遍歷每一「列」 // 每個 $row 代表表格中的一列資料
$rows：複數形式，表示多筆資料（多個資料列）
$row：單數形式，表示單筆資料（單個資料列）

+----+-----------+--------+
| id | title     | status |  ← 這是一個 row
+----+-----------+--------+  
| 1  | 網站標題1  | 1      |  ← 這是一個 row  
| 2  | 網站標題2  | 0      |  ← 這是一個 row
+----+-----------+--------+

3. <input>屬性 加上變數 name=text[]多筆資料加上陣列 id改成預設值value=  留意不要寫錯欄位  變數語法不要遺漏符號
欄位1-圖片檔名img  <img> 題目沒要求置中  變數$row['img']
欄位2-替代文字text  加上input:text 可編輯欄位 直接輸入文字修改
欄位3-顯示sh  新增單選圓框 input:radio
欄位4-刪除del  新增多選方框 input:checkbox
欄位5-更新圖片  新增按鈕 input:button 先寫value="更新圖片" 顯示按鈕文字即可

4. F12 確認欄位value值
5. 新增 另外三張圖片
6. 欄位3-顯示sh  加上 checked判斷式 三元運算式 
7. post送到api處理 編輯./api/edit_title.php
8. 三個<input>屬性 name改成空陣列寫法 裝多筆資料 name="text[]" "sh[]" "del[]"
可能會同時送出多筆資料，所以欄位屬性加上陣列
sh[]只會有一筆，可以不需要陣列

// 步驟5：第40行 input:hidden
// 迴圈結束前 加上hidden_id  辨識所有異動項目
1. 先判斷是否需要刪除  不用考慮更新或其他異動
2. 每筆資料都有一個對應的id，後端才知道要編輯那一筆

// 步驟6：第34行
// 新增 更新圖片 彈出視窗 <input type="button" value="更新圖片">
1. 彈出視窗的js函式onclick=op() 套用 到更新圖片按鈕中 
2. 複製 ./modal/title.php 更名update_title.php
修改表單內容 更新h3、action= 移除替代文字  新增改成更新

// 步驟7
// 點選後要知道 更新哪一筆(id)？ 送到api才能處理
1. 在op函式 路徑加上參數id及參數table，讓載入的頁面可以判別是那一筆資料的請求

2. 兩個頁面修改 op()路徑 加上參數
./backend/title.php  ./modal/update_title.php 加上 ?id= < ?=$row['id'];?>
./modal/update_title.php  <input>用hidden_id+$_GET['id'] 還是 在連結放網址get id？

兩者皆可。表單已經使用post送資料 就不用網址get id
之後傳送圖片就會帶id  即可知道是哪一張圖片要更新

3. get/post網頁傳值：後台右半部title.php [更新圖片]按鈕路徑-設?id參數 -> 路徑開啟modal彈出視窗-> 最後點選[更新] -> 表單action用post送到./api/update_title.php -> 圖片帶id
此處不用session，因為會一直紀錄資料

// 步驟8
// 新增./api/update_title.php

*/
</script>

<?php
// 用 PHP 註解或放在 footer 比較安全  此頁回上一層找cover 加上註解畫面會跑掉
// 盡量避免在<form> <table> → <tr> 中間直接加 HTML 註解，尤其是多層 include 的情況
// 移除&#39 --> 單引號' ' 標籤內有單雙引號時使用 html_entities
// https://www.w3schools.com/html/html_entities.asp

?>