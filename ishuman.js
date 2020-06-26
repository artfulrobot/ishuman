(function ($) {

Drupal.behaviors.ishuman = {
  attach: function (context) {
    var inputs = $(context).find('input.ishuman');

    var update;
    update = function() {
      $.ajax({
        url: '/ishuman-ajax?nocache=' + Date.now() + Math.random(),
        success: function(text) {
          inputs.val(text);
        },
        error: function() {
          // If error, try again in 5s.
          window.setTimeout(update, 50000);
        }
      });
    }
    if (inputs.length) {
      // Async load inital key after 2s
      window.setTimeout(update, 2000);
      // Update key every 4 mins.
      window.setInterval(update, 4*60000);
    }
  }
};

})(jQuery);

