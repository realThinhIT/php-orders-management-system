<div>
  <h3>Đơn hàng của tôi</h3>
</div>

<script>
  window.app.resourceName = 'admin/orders';
  window.app.columns = ['id', ''];
  window.app.users = `<?php echo json_encode(CommonModel::stmtToArray($users, JSON_UNESCAPED_UNICODE)); ?>`;
  window.app.products = <?php echo json_encode(CommonModel::stmtToArray($products, JSON_UNESCAPED_UNICODE)); ?>;
</script>

<table class="table table-striped table-bordered dtbl">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Ngày mua</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Tổng tiền</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class="data-table">
    <?php foreach ($orders as $order) { ?>
      <tr id="row_<?php echo $order['oid']; ?>">
        <th scope="row"><?php echo $order['oid']; ?></th>
        <td class="buy_date"><?php echo $order['ocreated_at']; ?></td>
        <td class="sum_quantity"><?php echo $order['count_products']; ?> sản phẩm (SL: <?php echo $order['sum_quantity']; ?>)</td>
        <td class="sum_price"><?php echo number_format($order['sum_price'], 0); ?>đ</td>
        <td>
          <i class="action-view-order fa fa-book" aria-hidden="true" data-action-id="<?php echo $order['oid']; ?>" data-toggle="modal" data-target="#viewOrderId<?php echo $order['oid']; ?>"></i>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

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
                        <th scope="col">Tên mặt hàng</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                      </tr>
                    </thead>
                    <tbody class="data-table">
                      <?php foreach ($ordersProducts as $product) { ?>
                        <?php if ($product['oid'] == $order['oid']) { ?>
                          <tr>
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