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
        $rows=$Title->all();
        foreach ($rows as $row) :
        ?>
        <tr>
          <td width="45%">
            <img src="./images/<?=$row['img'];?>" style="width:300px;height:30px">
          </td>
          <td width="23%">
            <input type="text" name="text" value="<?= $row['text'];?>">
          </td>
          <td width="7%">
            <input type="radio" name="sh" value="<?=$row['id'];?>"
            <?= ($row['sh']==1)?"checked":"" ;?>
            >
          </td>
          <td width="7%">
            <input type="checkbox" name="del" value="<?=$row['id'];?>">
          </td>
          
          <td>
            <input type="button" value="更新圖片">
          </td>
        </tr>

        <?php
        endforeach;
        ?>
        
      </tbody>
    </table>
    
    <table style="margin-top:40px; width:70%;">
      <tbody>
        <tr>
          <td width="200px">
            <input type="button" 
            onclick="op('#cover','#cvr','./modal/title.php')" 
            value="新增網站標題圖片">
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
// 路徑 ./當前目錄  以backend.php角度來看
// 此頁 include 到 後台./backend.php-149行 可吃到db.php資料
// 位置 ./backend/title.php 後台右半部版型區 

// 步驟1 onclick="op  op = open  彈出視窗
/*
* onclick="op('#cover','#cvr','./modal/title.php')"
* 由js函式op() 觸發 彈出視窗  並載入 ./modal/title.php 內容(原為view.php)
* 來自上一層backend.php <div id="cover  對照js檔案 functionop(x, y, url)
* 對照三個參數(x, y, url)  #cover / #cvr / #view.php?do=title 
* 打開F12 查看ajax用法 點下後產生xhr請求

// 步驟2 更改 onclick路徑 ./當前目錄  以backend.php角度來看
* onclick="op('#cover','#cvr','view.php?do=title')"
* onclick="op('#cover','#cvr','./modal/title.php')"
*/


// 步驟3 整理<form>參數
// <form method="post" target="back" action="?do=tii">
/* 
1. 不會特別寫<tbody>
2. 要在<tbody> 輸出上傳圖片資料 放第二段<tr class="yel">
3. 移除 target="back"  之前iframe使用
4. 更改 action="?do=tii" 表單資料post送到api處理 不要塞在一個檔案處理
單一頁面多功能：原指reload後 繼續在當前頁處理新增修改
表單送出後，會重新載入當前頁面，但加上 ?do=tii 參數 (留在當前頁，加上參數)
網址變成 ./backend/title.php?do=tii
加上參數 讓程式知道要處理 tii 功能 "正在處理標題設定..."
PHP 接收到 $_GET['do'] = 'tii'; // 從網址參數來的 
$_POST['title'] = '用戶輸入的內容';  // 從表單來的
AI猜測 tii可能是 標題圖片 (Title Image) 的簡寫
*/

// 步驟4 <tr>前後 加上迴圈指令在<tr>每列逐筆顯示資料
// <tr class="yel">
/* 
1. 移除背景圖 class="yel"
2. 這兩段php程式碼，特別用$rows命名有特別意義
從資料庫取得所有標題資料，存到$rows陣列中
$rows = $Title->all();  // 取得所有「列」資料
foreach ($rows as $row) :  // 遍歷每一「列」
3. 欄位加上變數  id改成預設值value=  留意不要寫錯欄位  變數語法不要遺漏符號
欄位1-圖片：<img>
題目沒要求置中
欄位2-替代文字: 加上input:text 可編輯欄位 直接輸入文字修改
欄位3-顯示 新增單選圓框 input:radio
欄位4-刪除 新增多選方框 input:checkbox
欄位5-更新圖片  新增按鈕 input:button 先寫value="更新圖片" 顯示按鈕文字即可
4. F12確認欄位value值
5. 新增另外三張圖片
6. 欄位3-顯示sh  加上 checked判斷式 三元運算式 
*/
</script>

<?php
// 用 PHP 註解或放在 footer 比較安全  此頁回上一層找cover 加上註解畫面會跑掉
// 盡量避免在<form> <table> → <tr> 中間直接加 HTML 註解，尤其是多層 include 的情況
// 移除&#39 --> 單引號' ' 標籤內有單雙引號時使用 html_entities
// https://www.w3schools.com/html/html_entities.asp

?>