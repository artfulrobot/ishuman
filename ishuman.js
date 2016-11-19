(function ($) {

Drupal.behaviors.ishuman = {
  attach: function (context) {
    var inputs = $(context).find('input.ishuman');

    var update;
    update = function() {
      $.ajax({
        url: '/ishuman-ajax',
        success: function(text) {
          inputs.val(text);
        },
        error: function() {
          window.setTimeout(update, 10000);
        }
      });
    }
    if (inputs.length) {
      window.setTimeout(update, 10000);
      window.setInterval(update, 4*60000);
    }
  }
};

})(jQuery);

