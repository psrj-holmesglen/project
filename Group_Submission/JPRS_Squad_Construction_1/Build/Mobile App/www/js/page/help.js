/**
 * @fileoverview Handles document load functions and global variables
 * @author Team Zelda
 */

/**
 * index of current page
 * @type {number}
 */
var idx = 0;
/**
 * Array of text data for pages
 * @type {*[]|string}
 */
var data = [

  "Enter Conference token code that you have been supplied, and click Join Conference.",

    "You can press the button, circled in yellow, to access the navigation menu.<br><br>" +
    "You can also press the Prefs button (circled in red), which will bring up the application settings.",

  "When displayed, you may hide the navigation menu again by pressing the circled yellow button.",

    "In settings you can adjust automatic updates, if you want to download images and if you wish to re-run the" +
    " tutorial. Also available is the option to delete all application data, such as images.",

    "On Successful login, you will be displayed General Conference Information, with the organiser logo visible." +
    " To the bottom of the page is the footer navigation bar. On here are the four most commonly used sections" +
    " of the application for quick access.",

    "When viewing the Conference Schedule, if the Conference has enough sessions there will be multiple pages to" +
    " view. To navigate to the next part of the Schedule, click on the arrows that are circled in yellow on the" +
    " above image.",

    "Clicking on a session in the schedule will display all information about that session. The page will contain" +
    " a link to the session presenter (circled in yellow), and a link to provide feedback for this session" +
    " (circled in red).",

    "Clicking on the presenter link will display information on that presenter. Contained on the page will also" +
    " be a list of all sessions this presenter is in charge of, allowing you to click on any of them for" +
    " further information.",

    "Navigating to the Feedback, Polling, or QA pages without first entering your demographic information will" +
    " make the above message display. Clicking 'Ok' will take you to the demographic page. Demographic" +
    " information is only general, such as age group, gender, and profession. Your anonymity will be maintained.",

    "The Polling page will display the current session polling question, as displayed. However if there were" +
    " multiple sessions on at the same time, a list would be displayed where the user can select their " +
    "current session."

];

$(function () {

  // Next button
  $("#help-next").click(function () {
    switchPage(1);
  });
  // Prev button
  $("#help-back").click(function () {
    switchPage(-1);
  });
  // Finish button
  $("#help-finish").click(function () {
    if (confirm("Are you sure you wish to finish the tutorial?")) {
      eCon.local.firstRun = true;
      login();
    }
  });

  switchPage(0);

});

function switchPage(change) {

  idx += change;

  // Protect against array index out of bounds
  if (idx < 0) {
    idx = 0;
  } else if (idx >= data.length) {
    idx = data.length - 1;
  }

  // Change page content
  $('#help-img').attr('src', '../img/Help/' + idx);
  $('#help-text').html(data[idx]);

  // First Page
  if (idx == 0) {
    $('#help-back').hide();
  } else {
    $('#help-back').show();
  }

  // Last Page
  if (idx == data.length - 1) {
    $('#help-next').hide();
  } else {
    $('#help-next').show();
  }

}