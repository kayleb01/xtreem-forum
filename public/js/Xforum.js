var tokenn = $('meta[name="csrf-token"]').attr('content');
  
    $('a.unhide').click( function(e) {
      e.preventDefault();
      var mod = $(this).attr('id');
      $('.thread-content-'+mod).summernote({focus: true});
      $('#'+mod).hide();
      $('#ave'+mod).show();
      $('#cancel'+mod).show();
     });

    function ajax_it(mod, route, data){
      
      if (mod && route) {
          // var method1 = "<";
           $.ajax({
            method:'get',
            url: route + mod,
            data: {token:tokenn, id:mod, body:data, _method:"put"},
           
            success: function(data) {
              var editId  = $(this).attr('edit');
              $('#'+mod).hide();
              $('edit'+mod).toggle();
              $('#cfa'+mod).html(data);
            },
            error:function(argument) {
              console.log('An error was encountered '+argument);
            },
            
          });
      }
    }
// OnSubmit Upload the images

// $('a.ave').on('click', function(e){
//    e.preventDefault();
//    var threadID = $(this).attr('id');
//    var ID = $(this).attr('data-id');
//    var markup = $('div.thread-content-'+ID).summernote('code');
//   $('.thread-content-'+ID).summernote('destroy');
//    $('a.unhide').show();
//    $(this).hide();
//    $('a.cancel').hide();
//    ajax_it(ID, '/xf/modify/', markup);
// });

// //When the cancel button is clicked
// //destroy the texteditor and show the modify link
// $('a.cancel').on('click', function(e){
//   e.preventDefault();
//   var ID = $(this).attr('data-id');
//   $('div.thread-content-'+ID).summernote('destroy');
//   $(this).hide();
//   $('a.ave').hide();
//   $('a.unhide').show();
// });

// $(document).ready(function() {
//   $('.textarea').summernote({ toolbar:[
//     // [groupName, [list of button]]
//     ['style', ['bold', 'italic', 'underline']],
//     ["insert", ["link", "picture", "video",'emoji']],
   
//   ]   
//   });
// });


// $('.quote').unbind().bind('click',function() {
//   event.preventDefault();
//   var Id = $(this).attr('data-id');
//   var pane = $(this).closest('div.panel-body-' + Id);
//   author = pane.find('.username').html();
//   post = pane.find('.thread-content-'+Id).html();

//   try {
//     $('#editor').focus();
//   } catch (e) {}

//   editor = $('#editor');
//   hm='<div class="bbcode_quote">';
//   hm+='<div class="bbcode_quote_head">@'+author+':</div>';
//   hm+='<div class="bbcode_quote_body">'+post+'</div>';
//   hm+='</div><br/>';

//   if (editor.summernote("")) {
//     action = 'code';
//   } else {
//     action = 'pasteHTML';
//   }

// try {
//     editor.summernote('focus');
//   } catch(e) {}
//   editor.summernote(action, hm);
// });

  function actOnLikes(commentId, url) {
   var commentId = parseInt(commentId);
   $('span.Like-'+commentId).text(+ 1);
   $.ajax({
            method:'get',
            url: url,
            data: {token:tokenn, commentId:commentId, _method:"put"},
            success: function(data) {
              $('#ike_text'+commentId).text("");
              if(data.message == 'like'){
                  $('span.Like-'+commentId).text(data.likes ++);
                  $('#ike_text'+commentId).html('Unlike');
              }
              if(data.message == 'Unlike'){
                  $('span.Like-'+commentId).text(data.likes --);
                  $('#ike_text'+commentId).html('Like');
              }
            },
            error:function(argument) {
              console.log('An error was encountered '+argument);
            },
            
          });
  }

//fix image
$("img").on("click", "img.bbcode_img", function(e) {
  popup_image(this.src);
});

$('a[data-notify]').click(function(){
   var id = $(this).attr('data-notify');
   $.ajax({
    method:'get',
    url:'/user/notification/'+id,
    data:{'id': id, _token:tokenn, _method:'delete'},
    cache:false,
    success:function(){
      console.log('Notification marked');
    }, 
    error:function(data){
      console.log('An error was encountered, Notification not marked');
    }
   });

});

$('.sq').on('keydown', function() {
  var query = $(this).val()
  $.ajax({
    url:'/xf/search',
    data:{'q':query, _token:tokenn},
    method: 'GET',
    cache: false,
    success: function(data) {
      console.log(data);
    },
  });
});




 $(function() {
    var // Define maximum number of files.
        max_file_number = 4,
        $form = $('form'), 
        $file_upload = $('#file', $form),
        $button = $('.f', $form); 

    $file_upload.on('change', function () {
      var number_of_images = $(this)[0].files.length;
      if (number_of_images > max_file_number) {
        alert(`You can upload maximum ${max_file_number} files.`);
        $(this).val('');
        $button.prop('disabled', 'disabled');
      } else {
        $button.prop('disabled', false);
      }
    });
  });