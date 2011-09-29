/* Author: Alexey Plutalov
  Simple script for centered error message.
*/

function center_message() {
  var window_height = $(window).height();
  var message_height = $('#error-message').height();
  var margin = (window_height - message_height) / 3;
  $('#error-message').css('margin-top', margin);
  return;
}























