/**
 * @fileoverview Handles document load functions and global variables
 * @author Team Zelda
 */

$(function () {
  var form = $('#login-form');
  form.submit(function (evt) {
    evt.preventDefault();
    evt.stopPropagation();
    $.post(eCon.WebDataRoot +  'Login', form.serialize(), 'json').
        done(function (data, status, xhr) {
          if ($.isEmptyObject(data)) {
            alert('Wrong Login');
          } else {
            eCon.local.ID = data.ID;
            eCon.local.EXP = data.Exp;

            eCon.Container.pagecontainer('change', 'conference.html', {});
          }
        }).
        fail(ajaxLog).
        fail(function (xhr, status, error) {
          alert('Service Error');
        }
    );
  });
});
