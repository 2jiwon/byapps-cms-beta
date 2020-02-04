// if(Util.getCookie('aside') == 'on' && $('#sidebar').length != 0) {
//   $("body").toggleClass("open");
// }
// $('.top_btn').click( function () {
//   $( 'html, body' ).animate( { scrollTop : 0 }, 400 );
//   return false;
// });

$("#sidebar-close,#sidebar-toggle").click(function (e) {
  $("body").toggleClass("open");
  if($("body").attr('class')=="open") {
    sidebarOpen();
  } else {
    sidebarClose();
  }
});
var aaa;
function setUserInfo(mem_id){
  $.ajax({
    url: '/user/'+mem_id,
    datatype:'json',
    success:function(response){
      aaa = response;
      $('#user-info').html(response);
      sidebarOpen();
      $('#nav-cc-tab').click();
    }
  })
}

function sidebarOpen() {
  $('#content').attr("class","col-md-8 p-0");
  $('#topnav').attr("class","col-md-8 p-0");
  $("#sidebar").attr("class","col-md-4");
  $("#sidebar").css("display","block");
  $("#sidebar-toggle").hide();

  setCookie('sidebar', 'open', 1);
}

function sidebarClose() {
  $('#content').attr("class","col-md-12 p-0");
  $('#topnav').attr("class","col-md-12 p-0");
  $("#sidebar").attr("class","col-md-0");
  $("#sidebar").css("display","none");
  $("#sidebar-toggle").show();

  setCookie('sidebar', 'close', 1);
}

function setCookie(name, value, days) {
      if (days) {
          var date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          var expires = "; expires=" + date.toGMTString();
      }
      else
        var expires = "";
      document.cookie = name + "=" + value + expires + "; path=/";
  }
