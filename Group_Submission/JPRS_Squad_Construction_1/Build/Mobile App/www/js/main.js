/**
 * @fileoverview Handles document load functions and global variables
 * @author Team Zelda
 */

/**
 * Object representing the application containing properties and objects:
 * <ul>
 * <li>local: global variable for the localStorage object</li>
 * <li>WebDataRoot: The url of the server root where we are pulling our data from</li>
 * <li>LocalDataRoot: The url for the local folder where we are storing our data</li>
 * <li>WebPostRoot: The url of the server where we are sending submitted forms</li>
 * <li>WebImageRoot: The url of the server where we are downloading images from</li>
 * <li>LocalImageRoot: The folder name for where we are storing images locally</li>
 * </ul>
 */
var eCon = {
  local: window.localStorage,
  WebDataRoot: "http://econ.robfaie.net/root/WEB_SERVICE/",
  LocalDataRoot: "cdvfile://localhost/persistent/Conference/",
  WebPostRoot: "http://econ.robfaie.net/root/WEB_SERVICE/",
  WebImageRoot: "http://econ.robfaie.net/root/WEB_SERVICE/image/",
  LocalImageRoot: "/img/",
  swipe: false
};

// jQuery Ready function - Single run initalizations
$(function () {

  // defaults for settings
  eCon.local.auto_update = eCon.local.auto_update || "always";
  eCon.local.img_download = eCon.local.img_download || "always";

  // pagecontainer widget
  eCon.Container = $('body');

  // initialize toolbars
  $('#footer, #header').toolbar({ tapToggle: false });

  // initialize panel
  $('#nav-panel').panel({
    // fix for toolbars not animating with panel
    beforeopen: toggleToolbars,
    close: toggleToolbars,
    classes: {
      modal: 'needsclick ui-panel-dismiss'
    }
  });
  $('#panel-list').listview();

  $('#header-back').hide();
  $('#header-panel').hide();

  // Page Container Events
  $(window).on('pagecontainerbeforetransition', containerBeforeTransition); // Before the app attempts to change page
  $(window).on('pagecontainerload', containerLoad);                         // After the app has loaded a page from disc
  $(window).on('pagecontainerbeforeshow', containerBeforeShow);             // Before the app displays a page on screen
  $(window).on('pagecontainertransition', containerTransition);             // After the app has completed a change page

  // Universal handlers
  eCon.Container.submit(postData);                                // Form submissions - except when handled on individual page
  eCon.Container.on('collapsibleexpand', triggerScroll);          // Opening of collapsible widget
  eCon.Container.on('click', '.img-fullscreen', makeFullscreen);  // Clicking on images with the class `img-fullscreen`
  eCon.Container.on('swiperight', handleSwipe);                   // User swipes to the right

  // An image fails to load
  document.body.addEventListener('error', downloadImg, true);
});

/**
 * Handles the failure of an image to load by hiding it and attempting to download the image from the server
 * @param evt The event object
 */
function downloadImg(evt) {
  // If not an image don't do anything
  if (evt.target.nodeName != "IMG") {
    return;
  }

  /**
   * The active page
   * @type {*|jQuery}
   */
  var page = eCon.Container.pagecontainer('getActivePage');
  /**
   * The element that triggered the event
   * @type {*|jQuery}
   */
  var target = $(evt.target).hide();
  // Show sponsor label
  if (page.attr('id') == "sponsor-list") {
    $(evt.target).next().show().removeClass('ui-hide');
  }

  /**
   * FileTransfer object that will handle downloading the image
   * @type {FileTransfer}
   */
  var fileTransfer = new FileTransfer();
  /**
   * The local location of the image
   * @type {string}
   */
  var src = target.attr('src');
  /**
   * The encoded url of the image on the server
   * @type {string}
   */
  var uri = encodeURI(eCon.WebImageRoot + src.substr(src.lastIndexOf('img/') + 4, src.lastIndex));

  // Handle image download settings
  if (eCon.local.img_download == 'always' || navigator.connection.type == Connection.WIFI) {

    fileTransfer.download(
      uri, // source location
      src, // destination location
      function (entry) { // Success
        // Refresh image
        target.attr('src', src);
        // Show image
        target.show();

        // Hide sponsor label
        if (page.attr('id') == "sponsor-list") {
          $(evt.target).next().hide().addClass('ui-hide');
        }
      },
      function (error) { // Failure
        console.log(JSON.stringify(error));
      }
    );

  }
}

/**
 * Handle the page container before transition event. Here we navigation to certain pages
 * @param evt The event object
 * @param ui Object given by jQuery holding various options and objects
 */
function containerBeforeTransition(evt, ui) {

  /**
   * Url object for the source page
   */
  var from = $.mobile.path.parseUrl(eCon.Container.pagecontainer('getActivePage').jqmData('url'));
  /**
   * Url object for the destination page
   */
  var to = $.mobile.path.parseUrl(ui.toPage.jqmData('url'));
  /**
   * variable to control whether to prevent the transition or not
   * @type {boolean}
   */
  var prevent = false;

  if (to.filename == 'index') { // All navigation to the index page does not include initial load
    prevent = true;
  } else if (to.filename == 'login.html' && from.filename != 'index' && from.filename != 'help.html') { // navigation to login page except from index
    prevent = true;
  }

  if (prevent) {
    evt.preventDefault();
    window.history.go(1); // Resync browser history with jqm history
  }

  eCon.swipe = false;
  $('#header-panel').addClass('ui-state-disabled');
}

/**
 * Handle the container load event. Here we load additional data and run the template
 * @param evt The event object
 * @param ui Object given by jQuery that holds the loaded page and loading options
 */
function containerLoad(evt, ui) {
  /**
   * The page loaded
   * @type {*|jQuery|HTMLElement}
   */
  var page = $(ui.page);
  /**
   * The id of the loaded page
   * @type {string}
   */
  var pageId = page.attr('id');
  /**
   * The name of the file containing data if needed
   * @type {string}
   */
  var dataFile = page.jqmData('json');
  /**
   * The value of the update data setting
   * @type {*|eCon.local.auto_update|string}
   */
  var update = eCon.local.auto_update;
  /**
   * Variable tracking whether to download from server
   * @type {boolean}
   */
  var getWeb = true;
  /**
   * Concatenated url of the local data file
   * @type {string}
   */
  var localUrl = eCon.LocalDataRoot + eCon.local.ID + "/" + dataFile;
  /**
   * Concatenated url of the server data file
   * @type {string}
   */
  var webUrl = encodeURI(eCon.WebDataRoot + eCon.local.ID + "/" + dataFile);


  if (dataFile) {
    evt.preventDefault();
  } else { // No templating to do
    return;
  }

  // Determine to fetch data from web or local
  if (navigator.connection.type == Connection.NONE) { // No connection
    getWeb = false;
  } else if (update == 'wifi' && navigator.connection.type != Connection.WIFI) { // WiFi setting, but no WiFi
    getWeb = false;
    //             time is set           now                     time last fetched     30 seconds
//  } else if (eCon.local[dataFile] && moment().isBefore(moment(eCon.local[dataFile]).add('s', 30))) { // Fetched from web too recently
//    console.log('too soon');
//    getWeb = false;
  }

  // Download the data if needed
  $.Deferred(function (dfd) {

    if (getWeb) {
      /**
       * FileTransfer object handling the downloading of the data file.
       * @type {FileTransfer}
       */
      var fileTransfer = new FileTransfer();

      fileTransfer.download(
        webUrl,             // Source
        localUrl,           // Destination
        function (entry) {  // Success
          eCon.local[dataFile] = moment();
          dfd.resolve();
        },
        function (error) {  // Failure
          dfd.reject();
        }
      );
    } else {
      dfd.resolve();
    }

    return dfd.promise();

    // Wait for data to download
  }).then(function () {
    // Insert page into DOM running scripts
    page.appendTo($('body'));
    /**
     * The directive that tells Pure how to fill the template
     * @type {object}
     */
    var directive = eCon[pageId + '-pure'];
    // Load data from disc
    $.getJSON(localUrl).
      done(function (data, status, xhr) {
        // Filter data if needed.
        var templateData = filterTemplateData(data, pageId, ui);
        // Perform actual template rendering.
        page.find(':jqmData(role="content")').render(templateData, directive);
        // Remove directive from memory. We don't need it anymore.
        eCon[pageId + '-pure'] = null;
        // Page change event chain doesn't continue until we resolve or reject the deferred.
        ui.deferred.resolve(ui.absUrl, ui.options, page);
      }).
      fail(ajaxLog).
      fail(function (xhr, status, text) {
        // Page change event chain doesn't continue until we resolve or reject the deferred.
        ui.deferred.reject(ui.absUrl, ui.options);
      }
    );
  });

}

/**
 * Handles page container before show event. Here we do page specific ui modifications.
 * @param evt The event object
 * @param ui Object given by jQuery containing options and previous page
 */
function containerBeforeShow(evt, ui) {

  /**
   * The active page
   */
  var active = eCon.Container.pagecontainer('getActivePage');

  $('[data-role="navbar"]').find('a.ui-btn-active').removeClass('ui-btn-active');
  $(':jqmData(role="collapsible"):first-child').collapsible('expand');

  //Add page title to header
  var current = $(active).jqmData('title');
  $("[data-role='header'] h1").text(current);

  // Fix for navbar buttons on schedule page rendering incorrectly
  $('.nav-btn').removeClass('ui-btn-icon-top');

  $('.ui-hide').hide();

  // Hides footer on any page with data-hide-footer="true"
  if (active.jqmData('hide-footer')) {
    $('#footer').hide();
  } else {
    $('#footer').show();
  }

  // Fills in feedback forms with previously entered data
  fillForm(active.attr('id'));
  // Handles disabling of submit buttons that require demographics to be set
  if (!eCon.local.Profile) {
    $('.needs-profile').button('disable');
  } else {
    $('.needs-profile').button('enable');
  }

  /**
   * The back button in the header
   * @type {*|jQuery|HTMLElement}
   */
  var btnBack = $('#header-back');
  /**
   * The nav panel button in the header
   * @type {*|jQuery|HTMLElement}
   */
  var btnPanel = $('#header-panel');

  // The desired header button to be show
  switch (active.jqmData('btn-left')) {

    case "back":
      btnBack.show();
      btnPanel.hide();
      break;

    case "panel":
      btnBack.hide();
      btnPanel.show();
      break;

    default:
      btnBack.hide();
      btnPanel.hide();
      break;

  }
}

/**
 * Handles
 */
function containerTransition() {
  /**
   * Message to be used in the confirm dialog.
   */
  var msg;
  switch (eCon.Container.pagecontainer('getActivePage').attr('id')) {

    case 'qa':
      msg = "You must fill out demographic information before submitting a question. " +
        "Would you like to fill out demographic information now?";
      break;

    case 'poll':
      msg = "You must fill out demographic information before answering a poll. " +
        "Would you like to fill out demographic information now?";
      break;

    case 'conference-feedback':
      // Falls through
    case 'session-feedback':
      msg = "You must fill out demographic information before submitting feedback. " +
        "Would you like to fill out demographic information now?";
      break;

    case 'schedule':
      console.log($('#schedule-nav').html());
      break;

    default:
      msg = null;
      break;
  }
  if (msg && !eCon.local.Profile && confirm(msg)) {
    eCon.Container.pagecontainer('change', 'demographics.html');
  } else {
    eCon.swipe = true;
    $('#header-panel').removeClass('ui-state-disabled');
  }
}

/**
 * Filters the data specifically for the page
 * @param data The data loaded from disc
 * @param pageId The page the data will be used on
 * @param ui The Object containing event related data
 * @returns {*}
 */
function filterTemplateData(data, pageId, ui) {

  /**
   * The id passed in the page url if it exists
   * @type {string}
   */
  var dataId = getQueryVariable('id', ui.absUrl);
  /**
   * data to return
   */
  var filteredData;

  switch (pageId) {

    case 'conference-feedback':
    // Falls through
    case 'session-feedback':
    // Falls through
    case 'speaker':
    // Falls through
    case 'sponsor':
      // Basic filter by ID
      return $.grep(data, function (n, i) {
        return ( n.ID == dataId );
      })[0];
    // Break

    case 'demographic':
      // Filtering by Type
      return $.grep(data, function (n, i) {
        return ( n.Type == 'Demographic' );
      })[0];
    // Break

    case 'schedule':
      if (dataId) { // Filters by ID if it exists (next and prev buttons)
        filteredData = $.grep(data, function (n, i) {
          return ( n.ID == dataId );
        })[0];
      } else { // Otherwise tries to filter by time (in active conference)
        filteredData = $.grep(data, function (n, i) {
          if (n.Sessions) {
            return (
              // First session start time          now
              moment(n.Sessions[0].Start).isBefore(moment()) &&
              // Last session end time                              now
              moment(n.Sessions[n.Sessions.length - 1].End).isAfter(moment())
              );

          } else {
            return false;
          }
        });
        if (filteredData.length <= 0) { // All else fails filter first section
          filteredData = data[0];
        }
      }

      // sets Prev and Next for use in schedule navbar
      var index = $.inArray(filteredData, data);
      filteredData.Prev = (index > 0) ? data[index - 1].ID : null;
      filteredData.Next = (index < data.length - 1) ? data[index + 1].ID : null;
      return filteredData;
    // Break

    case 'session':
      // Filters by session ID but in every section
      for (var i = data.length - 1; i >= 0; i--) {
        if (data[i].Sessions) {
          filteredData = $.grep(data[i].Sessions, function (n, i) {
            return ( n.ID == dataId );
          });
          if (filteredData.length > 0) { // If we found a matching session
            filteredData = filteredData[0];
            break;
          }
        }
      }
      return filteredData;
    // Break

    case "feedback-list":
      filteredData = $.grep(data, function (n, i) {
        return ( n.Type == 'conference' );
      });
      return filteredData;
    // Break

    default:
      // No filter
      return data;
    // Break

  }
}

/**
 * Handles the deviceready event fired by Cordova
 */
function deviceReady() {

  // Initial login
  login();
  // Initialize Fastclick plugin
  FastClick.attach(document.body);
}

document.addEventListener('deviceready', deviceReady, false);
