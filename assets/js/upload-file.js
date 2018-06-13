$(function() {
  $('#photo-upload').on('change', function() {
    var file_data = $('#photo-upload').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    console.log(form_data);                        
    $.ajax({
      url: window.app.root_url + '/?resource=admin/upload-files&action=upload',
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,                         
      type: 'post',
      success: function(res) {
        console.log(res);

        if (res == '-1') {
          window.alert('Đây không phải là file ảnh hợp lệ!');
        } else if (res == '-2') {
          window.alert('File tải lên quá lớn!');
        } else if (res == '-3') {
          window.alert('Không phải là file ảnh, đuôi mở rộng của file phải là .jpg, .jpeg, .png!');
        } else {
          $('#photo-upload').hide();
          $('#image_url').val(res);
          $('#photo_uploaded').attr('src', res);
          $('#photo_uploaded').show();
        }
      }
    });
  });
})