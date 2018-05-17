$(function() {
  /**
   * INIT ACTION DELETE & EDIT BUTTONS
   */
  function initActionDeleteAndEdit() {
    // action delete
    $(".action-delete").click(function () {
      var id = $(this).attr('data-action-id');

      if (window.confirm("Bạn có chắc chắn muốn xoá không?")) {
        $.ajax({
          url: window.app.root_url + '/?resource=' + window.app.resourceName + '&action=actions&resourceId=' + id, 
          type: 'DELETE',
          success: function (result) {
            $('#row_' + id).remove();
          }
        });
      }
    });

    // action edit 
    $(".action-edit").click(function() {
      $('#photo_uploaded').attr('src', '');
      $('#photo_uploaded').hide();

      var id = $(this).attr('data-action-id');
      $('#action-save-button-id').attr('data-action-id', id);

      $('#updateResourceModal').modal('show');

      var form = $('#updateModalForm');
      var formData = new FormData(form);
      var fd = form.serializeArray();
      fd.forEach(function (v) {
        var inputVal = $('#row_' + id + ' .' + v.name).html();
        
        $('#updateResourceModal form input[name="' + v.name + '"]').val(inputVal);
        $('#updateResourceModal form select[name="' + v.name + '"]').val(inputVal);
      });
    });
  }
  initActionDeleteAndEdit();
  
  /**
   * UPDATE ROWS
   */
  function createRow(data, rows = [], selector, newId = '', additionJson = {}) {
    var result = {};
    $.each(data, function() {
      result[this.name] = this.value;
    });

    var newRowHTML = '<tr id="row_' + newId + '" data-addition-json="' + JSON.stringify(additionJson) + '">';

    rows.forEach(function (v) {
      if (v == 'id') {
        if (newId > 0) {
          result.id = newId;
        }

        newRowHTML += `<td><b>${result[v] ? result[v] : ''}</b></td>`;
      } else {
        if (v != 'image_url') {
          newRowHTML += `<td class="${v}">${result[v] ? result[v] : ''}</td>`;
        } else {
          newRowHTML += `
            <td class="${v} d-none" id="imgtbl_${newId}_url">${result[v] ? result[v] : ''}</td>
            <td class="product-img-tbl" id="imgtbl_${newId}"></td>
          `;
        }
      }
    });

    newRowHTML += `
      <td>
        <i class="action-delete fa fa-trash-o" aria-hidden="true" data-action-id="${newId}"></i>
        <i class="action-edit fa fa-pencil-square-o" data-action-id="${newId}"></i>
      </td>
    `;

    newRowHTML += '</tr>';

    $(selector).html($(selector).html() + newRowHTML);
    initActionDeleteAndEdit();
    updateImage();
  }

  function modifyRow(data, rows = [], rowId = '') {
    var result = {};
    $.each(data, function() {
      result[this.name] = this.value;
    });

    rows.forEach(function (v) {
      if (v != 'id') {
        $("#row_" + rowId + ' td.' + v).html(result[v]);
      }
    });

    initActionDeleteAndEdit();
  }

  /**
   * OTHER ACTIONS
   */
  // action new
  $(".action-new").click(function () {
    $("#updateModalForm").trigger('reset');
    $("#updateResourceModal").modal('show');
    $('#action-save-button-id').attr('data-action-id', 'new');
    $('#photo_uploaded').attr('src', '');
    $('#photo_uploaded').hide();
  });

  // action update/ create 
  $("#updateModalForm").on('submit', function(e) {
    var id = $('#action-save-button-id').attr('data-action-id');

    var form = $('#updateModalForm');
    var fd = form.serializeArray();
    if ($('#photo_uploaded').attr('src')) {
      fd.push({
        name: 'image_url',
        value: $('#photo_uploaded').attr('src')
      });
    }

    var url = '';
    var method = 'POST';

    if (id == 'new') {
      url = window.app.root_url + '/?resource=' + window.app.resourceName + '&action=actions';
    } else if (Number.isInteger(parseInt(id))) {
      url = window.app.root_url + '/?resource=' + window.app.resourceName + '&action=actions&resourceId=' + id;
      method = 'POST';
    }

    $.ajax({
      url: url, 
      type: method,
      data: fd,
      success: function (result) {
        if (result > 0) {
          window.alert('Cập nhật thành công!');
          $('#updateResourceModal').modal('hide');

          if (id == 'new') {
            createRow(fd, window.app.columns, '.data-table', result);
          } else if (Number.isInteger(parseInt(id))) {
            modifyRow(fd, window.app.columns, id);
          }
        } else {
          window.alert('Có lỗi xảy ra trong quá trình cập nhật!');
          console.log(result);
        }
      }
    });

    e.preventDefault();
    return false;
  });

  function updateImage() {
    $('.product-img-tbl').each(function() {
      var imgUrl = $('#' + $(this).attr('id') + '_url').html();

      if (imgUrl) {
        $(this).html(`<center><img src='${imgUrl}' style="height: 30px; width: 30px;"></center>`);
      } else {
        $(this).html('');
      }
    });
  }
  updateImage();
});