<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">網站標題管理</p>
  
  <form method="post" target="back" action="?do=tii">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="45%">網站標題</td>
          <td width="23%">替代文字</td>
          <td width="7%">顯示</td>
          <td width="7%">刪除</td>
          <td></td>
        </tr>
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
// 此頁include 到後台backend.php-149行 

// 第22行 
// 步驟1 onclick="op  op = open  彈出視窗
// 由js函式op() 觸發 彈出視窗  並載入 ./modal/title.php 內容 (原為view.php)
// 三個參數對照(x, y, url)  #cover/#cvr/#view.php?do=title 
// 來自上一層backend.php <div id="cover  對照js檔案 function op(x, y, url)
// 打開F12 查看ajax用法 點下後產生xhr請求 

// 步驟2 更改 onclick路徑 ./當前目錄  以backend.php角度來看
// onclick="op('#cover','#cvr','view.php?do=title')"
// onclick="op('#cover','#cvr','./modal/title.php')"
</script>

<?php
// 用 PHP 註解或放在 footer 比較安全  此頁回上一層找cover 加上註解畫面會跑掉
// 盡量避免在<form> <table> → <tr> 中間直接加 HTML 註解，尤其是多層 include 的情況
// 移除&#39 --> 單引號' ' 標籤內有單雙引號時使用 html_entities
// https://www.w3schools.com/html/html_entities.asp

?>