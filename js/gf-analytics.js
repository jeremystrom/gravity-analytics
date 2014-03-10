(function ($) {
  $(document).on('gform_confirmation_loaded', function (event, form_id) {
    if(typeof ga == 'function') {
      var theLabel = window.gf_event_form_labels[form_id];
      ga("send", "event", "Forms", "Submission", theLabel);
    }
  });
})(jQuery);