// JavaScript Document
$(document).ready(function (e) {
  $(".mainmu").mouseover(function () {
    $(this).children(".mw").stop().show();
  });
  $(".mainmu").mouseout(function () {
    $(this).children(".mw").hide();
  });
});

function lo(x) {
  location.replace(x);
}

// if省略寫法 沒有{ }  else
// 三個參數  fadeIn() 淡入/漸變
function op(x, y, url) {
  $(x).fadeIn();

  if (y) $(y).fadeIn();


  if (y && url) $(y).load(url);
}

// function op(x, y, url) {
//   $(x).fadeIn();

//   if (y) {
// 			$(y).fadeIn();
// 		}

//   if (y && url) {
// 			$(y).load(url);
// 		}
// }

// 淡出
function cl(x) {
  $(x).fadeOut();
}
