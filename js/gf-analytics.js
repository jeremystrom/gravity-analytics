(function ($) {
  $(document).on('gform_confirmation_loaded', function (event, form_id) {
    var theLabel = window.gf_event_form_labels[form_id];
    if(typeof ga == 'function') {
      ga("send", "event", "Forms", "Submission", theLabel);
    } else  if(typeof _gaq == 'object') {
      _gaq.push(['_trackEvent', 'Forms', 'Submission', theLabel]);
    }
  });
})(jQuery);