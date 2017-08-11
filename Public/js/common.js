  function message_s(message) {
    new $.zui.Messager(message, {
      icon: 'check-circle', // 定义消息图标
      type: 'success', //定义类型
      placement: 'top' // 定义显示位置
    }).show();
  }

  function message_e(message) {
    new $.zui.Messager(message, {
      icon: 'warning-sign', // 定义消息图标
      type: 'danger', //定义类型
      placement: 'top' // 定义显示位置
    }).show();
  }

  function adjust() {
    width = $(window).width();
    if (width < 780) {
      $(".body-main").addClass("phone-page");
    } else {
      $(".body-main").removeClass("phone-page");
    }
  }

  $(document).ready(function() {

    // 自适应代码
    window.onresize = adjust;
    adjust();
    $(".left-toggle").click(function() {
      width = $(window).width();
      var main = $(".body-main");
      if (width < 780) {
        if (main.is('.left-nav-show')) {
          main.removeClass("left-nav-show");
        } else {
          main.addClass("left-nav-show");
        }
      }
    });

    $("input.check").click(function() {
      if ($(this).is(':checked')) {
        $('input[name="ids"]').each(function(i) {
          $(this).prop('checked', true);
        });
      } else {
        $('input[name="ids"]').each(function(i) {
          $(this).prop('checked', false);
        });
      }
    });

    $('input[name="ids"]').click(function() {
      if (!$(this).is(':checked')) {
        $("input.check").prop('checked', false);
      }
    });

  })