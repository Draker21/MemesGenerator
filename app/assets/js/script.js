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

    $('#file-input').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          $('#output_img').html(''); //clear html of output element
          var data = $(this)[0].files; //this file data
         
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element
                      $('#output_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              } else{
                alert("Format incompatible. Veuillez choisir une image.");
                $("file-input").value="";
              }
          });
         
      }else{
          alert("Votre navigateur ne supporte pas l'API de fichier. Veuillez le mettre à jour."); //if File API is absent
      }
    });
});