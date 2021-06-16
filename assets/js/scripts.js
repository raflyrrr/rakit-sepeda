(function ($) {
  "use strict";
  $(".quant-input .plus").click(function () {
    var val = $(this).parent().next().val();
    val = parseInt(val) + 1;
    $(this).parent().next().val(val);
  });
  $(".quant-input .minus").click(function () {
    var val = $(this).parent().next().val();
    if (val > 0) {
      val = parseInt(val) - 1;
      $(this).parent().next().val(val);
    }
  });
})(jQuery);
