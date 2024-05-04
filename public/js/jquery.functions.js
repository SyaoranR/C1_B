jQuery(document).ready(function() {
  $('[data-toggle="tooltip"]').tooltip();

  //----------------------------NOVO 5--------------------------------------

  // $(document).ready(function() {
  //     $("#text").markItUp(mySettings);
  // });

  //----------------------------NOVO 4--------------------------------------

  // InlineEditor
  //     .create(document.querySelector('#editor'))
  //     .catch(error => {
  //         console.error(error);
  //     });

  //------------------------NOVO 3 NOT WORKING------------------------------

  /*
  var toolbarOptions = [
      ['bold', 'italic', 'underline', 'strike'],
      ['blockquote', 'code-block'],
      [{ 'header': 1 }, { 'header': 2 }, { 'header': 3 }, { 'header': 4 }],
      [{ 'list': 'ordered' }, { 'list': 'bullet' }],
      [{ 'script': 'sub' }, { 'list': 'super' }],
      [{ 'indent': '-1' }, { 'indent': '+1' }, ],
      [{ 'directin': 'rtl' }],
      [{ 'size': ['small', false, 'large', 'huge'] }],
      ['link', 'image', 'video', 'formula'],
      [{ 'color': [] }, { 'background': [] }],
      [{ 'font': [] }],
      [{ 'align': [] }],
  ]

  var quill = new Quill('#editor', {
      modules: {
          toolbar: toolbarOptions
      },
      theme: 'snow'
  })
  */

  /*
  //-----------------------------NOVO 2------------------------------------
  
  tinymce.init({
      selector: 'textarea',
      plugins: [
          'advlist autolink link image lists charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
          'table emoticons template paste help'
      ],
      toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
          'forecolor backcolor emoticons | help',
      menu: {
          favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
      },
      menubar: 'favs file edit view insert format tools table help',
      content_css: 'css/content.css'
  });

  */


  //-----------------------------NOVO 1------------------------------------


  $('#summernote').summernote({
      toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']],
      ],
      /* 
      callbacks: {
          onImageUpload: function(files, editor, welEditable) {
              sendFile(files[0], editor, welEditable);
          }
      }
      */
  });

  /*
  function sendFile(file, editor, welEditable) {
      // var lib_url = '<?php echo BASE_URL."resources/library/upload_summernote.lib.php"; ?>';
      var lib_url = '<?php echo URL."../../app/Library/ImgUpload.php"; ?>';
      data = new FormData();
      data.append("file", file);
      $.ajax({
          data: data,
          type: "POST",
          url: lib_url,
          cache: false,
          processData: false,
          contentType: false,
          success: function(url) {
              var image = $('<img>').attr('src', url);
              $('.summernote_editor').summernote("insertNode", image[0]);
          }
      });
  }

  */

  $('#summernote').summernote({
      lang: 'pt-BR', // default: 'en-US'
      toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']]
      ],
  });


});