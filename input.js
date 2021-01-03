$(function(){
  $('.upload_text').val('please upload or paste code');
  $('.input_file').change(function(){
    var i = $(this).val();
    $('.upload_text').val(i);
  });
});
