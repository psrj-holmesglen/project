/**
 * @fileoverview Handles document load functions and global variables
 * @author Team Zelda
 */

$(function () {

  $('#poll').change(function (evt) {
    var tar = $(evt.target);

    // if radio change, enable submit
    if (tar.is(":radio") && eCon.local.Profile) {
      $('#poll-submit').button('enable');
    }

    // if select change show question
    if (tar.attr('id') == "poll-select") {

      var data = tar.val().split('-');
      if (data[0] != "default") { // didn't select question

        $('div.question').hide(); // Hide all questions
        $('#q-' + data[0]).show(); // Show selected question
        $('#poll-form').show().each (function(){ // Reset form
          this.reset();
        });
        $('#poll-submit').button('disable');
        $('#form-session').val(data[1]);
      }
    }

  });
});