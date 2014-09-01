/**
 * @fileoverview Handles document load functions and global variables
 * @author Team Zelda
 */

function deleteData() {

  // Internal Persistent File System.  -  /data/data/au.edu.holmesglen.econference/files/files/ (on an HTC One)
  window.requestFileSystem(window.PERSISTENT, 0, function (fs) {

    // AppData "root"  -  Makes it easy to clear all app data via settings
    fs.root.getDirectory('Conference', {create: false}, function (de) {

      de.removeRecursively(function() {
        alert('Application data deleted');
        eCon.local.ID = null;
        eCon.local.EXP = null;
        eCon.local.Profile = null;
        navigator.app.exitApp();
      }, errorFile);

    }, errorFile);
  }, errorFile);
}

/**
 * Login function for cordova file methods.
 * @param e
 */
function errorFile(e) {
  console.log('Error: ' + JSON.stringify(e));
}

/**
 * Universal form submission handler. It will post the form, serialize it, and store it in local storage
 * @param evt
 */
function postData(evt) {
  evt.preventDefault();

  /**
   * The active jquery mobile page
   * @type {*|jQuery}
   */
  var page = $('body').pagecontainer('getActivePage');
  /**
   * The form inside the active page
   * @type {*|jQuery}
   */
  var form = page.find('form');

  // Send data to the server
  $.post(eCon.WebPostRoot + form.jqmData('action'), form.serialize()).
    done(function (data, status, xhr) {
      alert('Thank you for your submission');
      history.back();
    }).
    fail(ajaxLog).
    fail(function (xhr, status, error) {
      alert('Submission failed. Try again later');
    });

  /**
   * The id of the active page
   */
  var pageId = page.attr('id');
  // Many feedback forms so store by id
  if (pageId == 'feedback') {
    var id = getQueryVariable('id');
    eCon.local['form-' + pageId + '-' + id] = JSON.stringify(form.serializeArray());
    if ($(page).find('form').jqmData('type') == 'Demographic') {
      eCon.local.hasProfile = true;
    }
  } else {
    eCon.local['form-' + pageId] = JSON.stringify(form.serializeArray());
  }

  // clear Q&A form
  if (pageId == 'qa') {
    $('#qa_Question').val("");
  }
}