<div class="pb-3">
  <div class="pull-right">
    <button class="btn btn-primary action-new-order">
      <i class="fa fa-plus"></i>
    </button>
  </div>

  <h3>QUẢN LÝ ĐƠN HÀNG</h3>
  <hr>
</div>

<script>
  window.app.resourceName = 'admin/don-hang';
  window.app.columns = ['id', ''];
  window.app.users = `<?php echo json_encode(CommonModel::stmtToArray($users, JSON_UNESCAPED_UNICODE)); ?>`;
  window.app.products = <?php echo json_encode(CommonModel::stmtToArray($products, JSON_UNESCAPED_UNICODE)); ?>;
</script>

<table class="table table-bordered dtbl">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Khách hàng</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Tổng tiền</th>
      <th scope="col">Ngày mua</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class="data-table">
    <?php foreach ($orders as $order) { ?>
      <tr id="row_<?php echo $order['oid']; ?>">
        <th scope="row" class="text-center"><?php echo $order['oid']; ?></th>
        <td class="name"><?php echo $order['user_name']; ?></td>
        <td class="sum_quantity"><?php echo $order['count_products']; ?> sản phẩm</td>
        <td class="sum_price"><?php echo number_format($order['sum_price'], 0); ?>đ</td>
        <td class="buy_date"><?php echo $order['ocreated_at']; ?></td>
        <td class="text-center">
          <i class="action-view-order fa fa-book" aria-hidden="true" data-action-id="<?php echo $order['oid']; ?>" data-toggle="modal" data-target="#viewOrderId<?php echo $order['oid']; ?>"></i>
          <i class="action-delete fa fa-trash-o" aria-hidden="true" data-action-id="<?php echo $order['oid']; ?>"></i>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<div class="modal fade" id="updateResourceModal" tabindex="-1" role="dialog" aria-labelledby="updateProductModalTitle" aria-hidden="true">
  <div id="createOrderModalForm">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Đơn hàng mới</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body p-4">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <!-- <input type="text" class="form-control" placeholder="Họ và tên (*)" style="font-weight: bold;" required="required" name="name"> -->
              <select name="user_id" class="form-control">
                <?php foreach ($users as $user) { ?>
                  <option value="<?php echo $user['id']; ?>">
                    <?php echo $user['name']; ?> (<?php echo $user['username']; ?> - <?php echo $user['email']; ?>)
                  </option>
                <?php } ?>
              </select>
              <small id="passwordHelpBlock" class="form-text text-muted">
                Vui lòng chọn người mua hàng.
              </small>
            </div>

            <div class="form-group col-lg-12 text-muted">
              <hr/>
              <b class="form-text">Sản phẩm trong đơn hàng</b>
            </div>
          </div>

          <div id="product-lines"></div>

          <div class="form-row">
            <div class="form-group col-lg-6">
              <button type="button" class="btn btn-sm btn-secondary add-product-into-order">+ Thêm mới</button>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-9 text-align-right">
              <div class="form-text">Tổng tiền hóa đơn phải thanh toán:</div>
            </div>

            <div class="form-group col-lg-3">
              <div class="form-text">
                <b id="total_sum_price">0</b>đ
              </div>
            </div>
          </div>

          <div class="form-row form-horizontal">
            <div class="col-lg-9 text-align-right">
              <label class="control-label" style="margin-top: 6px;">Khách hàng trả:</label>
            </div>

            <div class="col-lg-3">
              <input type="text" class="form-control" name="customer_paid" value="0" />
            </div>
          </div>

          <div class="form-row form-horizontal mt-1">
            <div class="col-lg-9 text-align-right">
              <label class="control-label" style="margin-top: 6px;">Nhân viên trả lại:</label>
            </div>

            <div class="col-lg-3">
              <input type="text" class="form-control" name="customer_return" value="0" disabled="disabled" />
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary action-save-update-order">Lưu thay đổi</button>
        </div>
      </div>
    </div>
  </div>

  <div class="d-none" id="sp-selector">
    <div class="form-group col-lg-6">
      <!-- <input type="text" class="form-control" placeholder="Họ và tên (*)" style="font-weight: bold;" required="required" name="name"> -->
      <select name="product_id" class="form-control">
        <?php foreach ($products as $product) { ?>
          <option value="<?php echo $product['id']; ?>">
            <?php echo $product['name']; ?> (<?php echo $product['sku']; ?>)
          </option>
        <?php } ?>
      </select>
    </div>

    <div class="form-group col-lg-3">
      <input type="number" class="form-control" placeholder="Số lượng (*)" required="required" name="quantity" />
    </div>

    <div class="form-group col-lg-3">
      <input type="text" class="form-control number" placeholder="Thành tiền" required="required" name="sum_price" disabled="disabled" />
    </div>
  </div>
</div>

<?php foreach ($orders as $order) { ?>
  <div class="modal fade" id="viewOrderId<?php echo $order['oid']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateProductModalTitle" aria-hidden="true">
    <div>
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Chi tiết đơn hàng #<?php echo $order['oid']; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body p-4">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-12"><b>Khách hàng:</b> <?php echo $order['user_name']; ?> (<?php echo $order['username']; ?>)</div>
              </div>

              <div class="row">
                <div class="col-lg-6"><b>Email:</b> <?php echo $order['email']; ?></div>
                <div class="col-lg-6"><b>Điện thoại:</b> <?php echo (@$order['phone_number']) ? @$order['phone_number'] : '---'; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-12"><b>Ngày tạo đơn hàng:</b> <?php echo $order['ocreated_at']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <hr/>
                  <b class="form-text text-muted">Sản phẩm trong đơn hàng</b>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td scope="col"></th>
                        <th scope="col">Tên mặt hàng</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                      </tr>
                    </thead>
                    <tbody class="data-table">
                      <?php foreach ($ordersProducts as $product) { ?>
                        <?php if ($product['oid'] == $order['oid']) { ?>
                          <tr>
                            <td><center><a href='<?php echo $product['image_url']; ?>' target='_blank'><img src='<?php echo $product['image_url']; ?>' style="height: 50px; width: 50px;"></a></center></td>
                            <td><?php echo $product['pname']; ?></td>
                            <td><?php echo $product['quantity']; ?></td>
                            <td><?php echo number_format($product['sum_price'], 0); ?>đ</td>
                          </tr>
                        <?php } ?>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>