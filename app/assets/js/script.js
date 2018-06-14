M.AutoInit();

/* $(document).ready(function(){
    $('.sidenav').sidenav();
  });
 */

$(document).ready(function(){
    $('.sidenav').sidenav({
        menuWidth: 300, // Default is 300
        edge: 'right', // Choose the horizontal origin
        closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
        draggable: true // Choose whether you can drag to open on touch screens
      }
    );
  });