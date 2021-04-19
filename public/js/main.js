$(document).ready(() => {
  $('#search-btn').click(() => {
    $('#search').toggle();
  });

  $('.form').submit(function (e) {
    return false;
  });
});
