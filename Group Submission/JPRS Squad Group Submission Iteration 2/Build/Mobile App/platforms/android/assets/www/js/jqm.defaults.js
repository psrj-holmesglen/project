/**
 * @fileoverview Handles document load functions and global variables
 * @author Team Zelda
 */

$(document).bind('mobileinit', function () {

  // Beware transition 'none' causes issues with external panel
  $.mobile.defaultPageTransition = 'slide';

  // Sets the default data-theme
  $.mobile.page.prototype.options.theme = 'm';

  // Fixes misc navigation issues in web views
  $.mobile.phonegapNavigationEnabled = 'true';
});
