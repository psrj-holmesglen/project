/**
 * @fileoverview Handles document load functions and global variables
 * @author Team Zelda
 */

$(function () {
  /**
   * jQuery selection of the auto update setting
   * @type {*|jQuery|HTMLElement}
   */
  var auto_update = $("#auto-update-pref");
  /**
   * jQuery selection of the image download setting
   * @type {*|jQuery|HTMLElement}
   */
  var img_download = $("#img-dl-pref");

  // Set value to stored value or default
  auto_update.val(eCon.local.auto_update);
  img_download.val(eCon.local.img_download);

  // Update stored value
  auto_update.change(function (evt) {
    eCon.local.auto_update = auto_update.val();
  });
  img_download.change(function (evt) {
    eCon.local.img_download = img_download.val();
  });

  $('#btn-clear-data').click(function (evt) {
    evt.preventDefault();
    if (confirm('Are you sure you want to clear all application data?')) {
      deleteData();
    }
  });

});
