/**
 * @fileoverview Handles document load functions and global variables
 * @author Team Zelda
 */

$(function () {
  $(window).on('pagecontainerbeforehide',       function () { console.log('pagecontainerbeforehide');       });
  $(window).on('pagecontainerbeforeload',       function () { console.log('pagecontainerbeforeload');       });
  $(window).on('pagecontainerbeforeshow',       function () { console.log('pagecontainerbeforeshow');       });
  $(window).on('pagecontainerbeforetransition', function () { console.log('pagecontainerbeforetransition'); });
  $(window).on('pagecontainerchangefailed',     function () { console.log('pagecontainerchangefailed');     });
  $(window).on('pagecontainerhide',             function () { console.log('pagecontainerhide');             });
  $(window).on('pagecontainerload',             function () { console.log('pagecontainerload');             });
  $(window).on('pagecontainerloadfailed',       function () { console.log('pagecontainerloadfailed');       });
  $(window).on('pagecontainershow',             function () { console.log('pagecontainershow');             });
  $(window).on('pagecontainertransition',       function () { console.log('pagecontainertransition');       });
});