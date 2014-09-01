/**
 * @fileoverview Handles document load functions and global variables
 * @author Team Zelda
 */

$(function () {

  $('#qa').
    on('click', '#btn-refresh', updateQAList).
    change(function (evt) {

      var id = $(evt.target).val();
      console.log(id);
      if (id != "default") { // didn't select question

        $('#qa-submit').button('disable');
        $('#form-session').val(id);
        $('form').show();
        $('#feed').show();
        $('#qa-question').val('');
        $('#qa-approved').collapsible('collapse');

        updateQAList();
      }

    });

});

function updateQAList() {

  $('#btn-refresh').addClass('ui-state-disabled');

  $.getJSON(eCon.WebDataRoot + "question-answer/" + $('#form-session').val()).
    done(function (data, status, xhr) {
      var list = $('#qa-list').empty();
      for (var i = data.length - 1; i >= 0; i--) {
        list.prepend($('<li>', {
          'class': 'wsn',
          append: data[i].Question
        }))
      }
      list.listview('refresh');
      $('#qa-count').text(data.length);
    }).
    always(function (a, status, c) {
      $('#btn-refresh').removeClass('ui-state-disabled');
    }).
    fail(ajaxLog);

}