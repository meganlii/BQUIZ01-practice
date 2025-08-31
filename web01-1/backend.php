<?php 
// 步驟11 在此載入 include_once 不在.\backend\title.php
include_once "./api/db.php"; 
?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0068)?do=admin&redo=title -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <title>卓越科技大學校園資訊系統</title>

  <!-- 步驟1 更新路徑 -->
  <link href="./css/css.css" rel="stylesheet" type="text/css">
  <script src="./js/jquery-3.4.1.js"></script>
  <script src="./js/js.js"></script>
</head>

<body>
  <!-- 步驟9-1 檢查參數cover  之前引入title.php頁面 onclick="op 執行淡入淡出-->
  <!-- 參數1 #cover 共3個 -->

  <!-- 彈出視窗 由js函式 op() 觸發  三個參數對照(x, y, url)  #cover/#cvr/#view.php?do=title -->
  <!-- 由JS觸發 在後台顯示 獨立存在 所以沒有共用到db.php函數檔 容易混淆 -->
  <div id="cover" style="display:none; ">
    <div id="coverr">

      <!-- 步驟10 cl 代表close -->
      <a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;"
        onclick="cl(&#39;#cover&#39;)">X</a>

      <!-- 參數2 #cvr -->
      <div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;">
      </div>

    </div>
  </div>

  <!-- 步驟4 刪除 iframe區 -->
  <!-- <iframe style="display:none;" name="back" id="back"></iframe> -->
  <div id="main">
    <a title="" href="?">
      <div class="ti" style="background:url(&#39;use/&#39;); background-size:cover;"></div>
      <!--標題-->
    </a>
    <div id="ms">
      <div id="lf" style="float:left;">

        <div id="menuput" class="dbor">
          <!--主選單放此-->
          <span class="t botli">後台管理選單</span>

          <!-- 步驟2 改成 ?do=admin&redo=title -->
          <!-- 步驟3 刪除 9組 admin&redo= -->
          <!-- <a href="?do=admin&redo=title"> -->
          <a style="color:#000; font-size:13px; text-decoration:none;" href="?do=title">
            <div class="mainmu">
              網站標題管理 </div>
          </a>
          <a style="color:#000; font-size:13px; text-decoration:none;" href="?do=ad">
            <div class="mainmu">
              動態文字廣告管理 </div>
          </a>
          <a style="color:#000; font-size:13px; text-decoration:none;" href="?do=mvim">
            <div class="mainmu">
              動畫圖片管理 </div>
          </a>
          <a style="color:#000; font-size:13px; text-decoration:none;" href="?do=image">
            <div class="mainmu">
              校園映象資料管理 </div>
          </a>
          <a style="color:#000; font-size:13px; text-decoration:none;" href="?do=total">
            <div class="mainmu">
              進站總人數管理 </div>
          </a>
          <a style="color:#000; font-size:13px; text-decoration:none;" href="?do=bottom">
            <div class="mainmu">
              頁尾版權資料管理 </div>
          </a>
          <a style="color:#000; font-size:13px; text-decoration:none;" href="?do=news">
            <div class="mainmu">
              最新消息資料管理 </div>
          </a>
          <a style="color:#000; font-size:13px; text-decoration:none;" href="?do=admin">
            <div class="mainmu">
              管理者帳號管理 </div>
          </a>
          <a style="color:#000; font-size:13px; text-decoration:none;" href="?do=menu">
            <div class="mainmu">
              選單管理 </div>
          </a>

        </div>
        <!-- 主選單 end -->


        <div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
          <span class="t">進站總人數 :
            1 </span>
        </div>
      </div>


      <div class="di"
        style="height:540px; border:#999 1px solid; width:76.5%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">

        <!--正中央-->
        <table width="100%">
          <tbody>
            <tr>
              <td style="width:70%;font-weight:800; border:#333 1px solid; border-radius:3px;" class="cent"><a
                  href="?do=admin" style="color:#000; text-decoration:none;">後台管理區</a></td>
              <td><button onclick="document.cookie=&#39;user=&#39;;location.replace(&#39;?&#39;)"
                  style="width:99%; margin-right:2px; height:50px;">管理登出</button></td>
            </tr>
          </tbody>
        </table>

        <!-- <?php include './backend/title.php'; ?> -->

        <!-- 步驟5 分離右半部區域 -->
        <!-- 左方選取不同選單 載入對應頁面 ?do=title -->
        <!-- 網址：example.com?do=admin
        $do = $_GET['do'] ?? 'title';  // 輸出 $do = 'admin' -->

        <?php
        // 步驟6 網頁傳值到後端  用get/$_GET 網址帶參數傳值 ?參數=值
        // 如果有do=ad，載入 $do = 'ad'
        // 如果沒有do參數  載入 $do = 'title'
        $do = $_GET['do'] ?? 'title';


        // $file = "./backend/" . $do . ".php";  改成合併寫法 雙引號內字串連接+大括號
        // ./backend 少/ 要留意  可用echo $file; 除錯
        // **除錯妙招** 複製老師寫法貼在下一行比對
        // 如果有do=ad，載入 $do=ad 載入檔案 ad.php
        // 如果沒有do參數，載入 $do=title 載入檔案 title.php

        $file = "./backend/{$do}.php";
        

        // 步驟7 內建函數 file_exists() 
        // 先打完if(file_exists($file)) 再加T/F { }else{ }
        // ad.php 還不存在  先載入 title.php
        // 選取變數：游標移到變數前方 alt+shift

        // 步驟8 複製title.php 更名為ad.php
        // 每個選單 拆開檔案  用網址帶參數切換
        if (file_exists($file)) {

          include $file;

        } else {
          
          // 步驟9-2 此頁引入 title.php頁面 onclick="op 由js函式 op() 觸發 彈出視窗
          include './backend/title.php';
        }
        ?>

        <!-- 步驟5 分離右半部區域 end -->

      </div>


      <div id="alt"
        style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
      </div>


      <script>
      $(".sswww").hover(
        function() {
          $("#alt").html("" + $(this).children(".all").html() + "").css({
            "top": $(this).offset().top - 50
          })
          $("#alt").show()
        }
      )
      $(".sswww").mouseout(
        function() {
          $("#alt").hide()
        }
      )
      </script>

    </div>
    <div style="clear:both;"></div>
    <div
      style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
      <span class="t" style="line-height:123px;"></span>
    </div>
  </div>

</body>

</html>