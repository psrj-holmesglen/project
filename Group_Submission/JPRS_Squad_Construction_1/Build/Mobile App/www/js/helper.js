/**
 * @fileoverview Handles document load functions and global variables
 * @author Team Zelda
 */

/**
 * Creates a multiple choice question from the given data. The question is a
 * collapsible div with title text and separate control groups for each question
 * uses the following structure
 * <code>{
 *   "Title":"Question Text Goes Here",
 *   "ID":"id from database",
 *   "Options":[
 *     {
 *       "ID":"id from database",
 *       "text":"option text"
 *     },{
 *       "ID":"id from database",
 *       "text":"option text"
 *     }
 *   ]
 * }</code>
 * @param data {Object} the data object of the question
 * @param other  {boolean} Whether the last option is "other"
 */
function makeMCQuestion(data, other) {

  /**
   * Dive element containing the entire question. This is what will be returned.
   * @type {*|jQuery}
   */
  var cnt = $('<div>');

  /**
   * Title text of the question group.
   * @type {*|void|jQuery}
   */
  var title = $('<h2>', { // Creates element
    'class': 'wsn',     // Adds wsn class
    append: data.Title  // Adds title text
  });

  /**
   * Control group div for the question
   * @type {*|jQuery}
   */
  var ctrl = $('<fieldset>', {
    'class': 'control'
  });

  for (var i = data.Options.length - 1, o; o = data.Options[i]; i--) { //For each answer

    /**
     * Label for the answer's radio button
     * @type {*|void|jQuery}
     */
    var lbl = $('<label>').  // Creates the element
        attr('for', data.ID + '-' + o.ID). // Sets the for attribute
        append(o.Text);      // Sets the label text

    /**
     * The radio button representing the answer.
     * @type {*|jQuery}
     */
    var ans = $('<input>', { // Creates the element
      type: 'radio',      // Sets the type
      value: o.ID,
      name: data.ID,    // Sets the name
      id: data.ID + '-' + o.ID,         // Adds the id
      'class': 'f-trig'   // Adds class for auto collapsing
    });

    ctrl.prepend(ans);  // Adds the radio button to control group
    ctrl.prepend(lbl);  // Adds the label to control group=
  }

  if (other) {

    /**
     * The text field used in MC- types.
     * @type {*|jQuery}
     */
    var txf = $('<input>', { // Creates the element
      type: 'text',         // Sets the type
      name: data.id,      // Sets the name
      'class': 'f-trig'     // Adds class for auto collapsing
    });

    ctrl.prepend(txf);  // Adds the radio button to control group
  }

  cnt.prepend(ctrl);  // Adds control group to containing div
  cnt.prepend(title); // Adds question title to containing div

  return cnt;
}

/**
 * Creates an open response question from the given data. The question is a
 * collapsible div with title text and separate control groups for each question
 * uses the following structure
 * <code>{
 *   "Title":"Question Text Goes Here",
 *   "ID":"id from database"
 * }</code>
 * @param data {Object} the data object of the question
 */
function makeORQuestion(data) {

  /**
   * Dive element containing the entire question. This is what will be returned.
   * @type {*|jQuery}
   */
  var cnt = $('<div>', {          // Creates element
    'data-role': 'collapsible', // Adds collapsible data-role
    'data-collapsed': 'false'   // Sets non collapsed
  });

  /**
   * Title text of the question group.
   * @type {*|void|jQuery}
   */
  var title = $('<h2>', { // Creates element
    'class': 'wsn',     // Adds wsn class
    append: data.Title  // Adds title text
  });

  var ta = $('<textarea>', {
    name: data.ID,      // Sets the name
    rows: 4,
    'class': 'f-trig'     // Adds class for auto collapsing
  });

  cnt.prepend(ta);
  cnt.prepend(title); // Adds question title to containing div
  return cnt;
}

/**
 * Returns the value of the specified url query variable from the current page
 * @param variable The name of the query varable to retrieve
 * @returns {*} The value of the query variable
 * @param url The url to pull the variable from
 */
function getQueryVariable(variable, url) {
  /**
   * the url to pull the query out of
   */
  var query;
  if (url) { // if url supplied
    query = url.substring(url.indexOf('?') + 1);
  } else { // else use active page
    query = window.location.search.substring(1);
  }

  /**
   * array of variables passed in the url
   * @type {Array}
   */
  var vars = query.split('&');
  for (var i = vars.length - 1; i >= 0; i--) {
    /**
     * key value pair
     * @type {Array}
     */
    var pair = vars[i].split('=');
    if (pair[0] == variable) {
      return pair[1];
    }
  }

  // no variable found
  return false;
}

/**
 * Takes a serialized form and fills forms in Dom with those values
 * @param pageId The id of the page whose forms are being filled
 */
function fillForm(pageId) {
  /**
   * The data to fill the form with
   */
  var data;

  if (pageId == 'feedback') {
    /**
     * The id query value for the current page
     */
    var id = getQueryVariable('id');
    data = eCon.local['form-' + pageId + '-' + id];
  } else {
    data = eCon.local['form-' + pageId];
  }

  if (data) {
    data = JSON.parse(data);
    $.each(data, function (i, o) {
      var $el = $('[name="' + o.name + '"]'),
          type = $el.attr('type');

      // Handles filling the value of the element and refreshing if needed
      switch (type) {
        case 'checkbox':
          $el.prop('checked', 'checked').checkboxradio('refresh');
          break;
        case 'radio':
          $el.filter('[value="' + o.value + '"]').prop('checked', 'checked').checkboxradio('refresh');
          break;
        default:
          $el.val(o.value);
      }
    });
  }
  $('#form-profile').val(eCon.local.Profile);
  $('#form-section').val($('#form-section').jqmData('value'));
}

/**
 * Handles logging of ajax request errors
 * @param xhr The request object or the response object
 * @param status The text status of the request
 * @param text The text error message of the request or the request object
 */
function ajaxLog(xhr, status, text) {
  console.log(JSON.stringify(xhr));
  console.log(status);
  console.log(JSON.stringify(text));
}

/**
 * takes the form and puts it in the correct format for the web service
 * @param form
 * @returns {*}
 */
function buildProfile(form) {
  var objs = [];
  for(var i = 0, item; item = form[i]; i++){
    var obj = {};
    obj[item.name] = item.value;
    objs.push(obj);
  }
  return JSON.stringify(objs);
}

/**
 * Handles the click event on images with the class
 * @param evt The event object
 */
function makeFullscreen(evt) {
  /**
   * the image that was clicked
   * @type {*|jQuery|HTMLElement}
   */
  var cur = $(this);

  /**
   * Modal div that will display the fullscreen image
   * @type {*|jQuery|HTMLElement}
   */
  var modal = $('<div>', {
    'class': 'div-modal',
    append: function () {
      return [
        // Image
        $('<img>', {
          src: cur.attr('src'),
          'class': 'img-modal'
        }),
        // helper span for centering
        $('<span>', {
          'class': "helper-modal"
        })
      ]
    }
  });

  // Click handler on the modal
  modal.click(function () {
    $(this).remove();
  });
  // Load into DOM
  cur.closest(':jqmData(role="page")').append(modal);
}

/**
 * Handles scrolling.
 */
function triggerScroll(evt) {
  $(evt.target).prev(':jqmData(role="collapsible")').collapsible('collapse');
  $('html, body').animate({ // Browsers are inconsistent with whether the body or the html tag handle scrolling
    scrollTop: $(evt.target).offset().top - $('#header').outerHeight() - 10
  });
}

/**
 * Handles the swipe event.
 * @param evt The event object
 */
function handleSwipe(evt) {

  /**
   * The active page
   * @type {*|jQuery}
   */
  var active = eCon.Container.pagecontainer('getActivePage');
  // if         no panel is open        and the active page allows the panel to open
  if (active.jqmData("panel") !== "open" && !active.jqmData('hide-panel') && eCon.swipe) {
    $("#nav-panel").panel("open");
  }
}

/**
 * Handles whether the user needs to log into a conference
 */
function login() {

  // User has not compeleted the tutorial
  if (!eCon.local.firstRun) {
    eCon.Container.pagecontainer('change', 'help.html');
    return;
  }

  /**
   * Variable tracking whether the user needs to log in
   * @type {boolean}
   */
  var login = true;


  if (eCon.local.ID) { // Previously logged into a conference
    if (moment(eCon.local.EXP).isAfter(moment())) { // Conference expiration is after now
      login = false;
    } else {
      eCon.local.ID = null;
      eCon.local.EXP = null;
      eCon.local.Profile = null;
      deleteData();
    }
  }

  if (!login) {
    $('body').pagecontainer('change', 'conference.html', {});
  } else {
    $('body').pagecontainer('change', 'login.html', {changeHash: 'false'});
  }
}

/**
 * Toggles the toolbars position
 */
function toggleToolbars() {
  $('#footer, #header').toolbar('toggle');
}
