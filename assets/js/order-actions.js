$(function () {
  $(".action-new-order").click(function () {
    $("#updateModalForm").trigger('reset');
    $("#updateResourceModal").modal('show');
    $('.add-product-into-order').click();
  });

  function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
  }

  function updatePrices() {
    var lineId = 0;

    var productSlc = $('#product-lines select[name="product_id"]');
    var quantitiesTxt = $('#product-lines input[name="quantity"]');
    var totalPricesTxt = $('#product-lines input[name="sum_price"]');

    var totalPriceAll = 0;

    productSlc.each(function() {
      var qT = $(quantitiesTxt[lineId]);
      var pT = $(totalPricesTxt[lineId]);
      var dT = $(productSlc[lineId]);

      var calPrice = parseInt(qT.val()) * parseInt(window.app.products[dT.val()].price);
      if (calPrice != 'NaN') {
        pT.val(addCommas(calPrice));
        totalPriceAll += calPrice;
      } else {
        pT.val('0');
      }

      lineId++;
    });

    $('#total_sum_price').html(addCommas(totalPriceAll));

    var paidAmount = $('input[name="customer_paid"]');
    var returnAmount = $('input[name="customer_return"]');
    var paidAmountVal = parseInt(paidAmount.val().split(',').join(''));

    if (paidAmount.val()) {
      var lA = '';
      if (paidAmountVal > totalPriceAll) {
        lA = paidAmountVal - totalPriceAll;
        $('.action-save-update-order').removeAttr('disabled');
      } else if (paidAmountVal == totalPriceAll) {
        lA = '0';
        $('.action-save-update-order').removeAttr('disabled');
      } else if (paidAmountVal < totalPriceAll) {
        lA = '0';
        $('.action-save-update-order').attr('disabled', 'disabled');
      }

      returnAmount.val(lA);
    }
  }

  function saveOrder() {
    var lineId = 0;
    var saveBody = {};
    var productSlc = $('#product-lines select[name="product_id"]');
    var quantitiesTxt = $('#product-lines input[name="quantity"]');
    var userSlc = $('#createOrderModalForm select[name="user_id"]');

    var sendData = {
      user_id: $(userSlc[0]).val(),
      products: [],
      quantities: []
    }

    productSlc.each(function() {
      sendData.products.push($(productSlc[lineId]).val());
      sendData.quantities.push($(quantitiesTxt[lineId]).val());

      lineId++;
    });

    $.ajax({
      url: window.app.root_url + '/?resource=' + window.app.resourceName + '&action=actions', 
      type: 'POST',
      data: sendData,
      success: function (result) {
        if (result > 0) {
          window.alert('Lưu đơn hàng thành công!');
          location.reload();
        } else {
          window.alert('Có lỗi xảy ra trong quá trình lưu đơn hàng!');
          console.log(result);
        }
      }
    });

    e.preventDefault();
    return false;
  }

  function updateEvent() {
    $('#product-lines').on('keyup', 'input[name="quantity"]', function() {
      updatePrices();
    });

    $('body').on('keyup', 'input[name="customer_paid"]', function() {
      updatePrices();
    });

    $('#createOrderModalForm').on('click', '.action-save-update-order', function() {
      saveOrder();
    });
  }
  updateEvent();

  $('.add-product-into-order').click(function () {
    var newLine = `<div class="form-row product-line">${$('#sp-selector').html()}</div>`;
    $('#product-lines').append(newLine);

    updateEvent();
  });
});