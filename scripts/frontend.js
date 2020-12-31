// This script is loaded both on the frontend page and in the Visual Builder.

jQuery(function ($) {
  var videoPlayer = $('#videoPlayer');
  $(videoPlayer).click(function (e) {

    var video = $(this).get(0);
    if (video.paused === false) {
        video.pause();
        $('#btn-play').show();
    } else {
        video.play();
        $('#btn-play').hide();
    }

    return false;

  });
});
