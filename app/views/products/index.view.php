<div>
  <div class="pull-right">
    <button class="btn btn-primary action-new">
      Thêm sản phẩm mới
    </button>
  </div>

  <h3>Tất cả sản phẩm</h3>
</div>

<script>
  window.app.resourceName = 'admin/products';
  window.app.columns = ['id', 'image_url', 'name', 'price', 'sku', 'stock'];
</script>

<table class="table table-striped table-bordered dtbl">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col" class="d-none">Image URL</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">SKU</th>
      <th scope="col">Stock</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class="data-table">
    <?php foreach ($products as $product) { ?>
      <tr id="row_<?php echo $product['id']; ?>">
        <th scope="row"><?php echo $product['id']; ?></th>
        <td class="image_url d-none" id="imgtbl_<?php echo $product['id'] ?>_url"><?php echo $product['image_url']; ?></td>
        <td class="product-img-tbl" id="imgtbl_<?php echo $product['id']; ?>"></td>
        <td class="name"><?php echo $product['name']; ?></td>
        <td><span class="price numericElem"><?php echo number_format($product['price'], 0); ?></span>đ</td>
        <td class="sku"><?php echo $product['sku']; ?></td>
        <td class="stock"><?php echo $product['stock']; ?></td>
        <td>
          <i class="action-delete fa fa-trash-o" aria-hidden="true" data-action-id="<?php echo $product['id']; ?>"></i>
          <i class="action-edit fa fa-pencil-square-o" data-action-id="<?php echo $product['id']; ?>"></i>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<div class="modal fade" id="updateResourceModal" tabindex="-1" role="dialog" aria-labelledby="updateProductModalTitle" aria-hidden="true">
  <form id="updateModalForm">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm sản phẩm mới</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body p-4">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <input type="text" class="form-control" placeholder="Tên sản phẩm (*)" style="font-weight: bold;" required="required" name="name">
              <small id="passwordHelpBlock" class="form-text text-muted">
                Vui lòng nhập tên sản phẩm.
              </small>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-6">
              <input type="text" class="form-control number" placeholder="Giá sản phẩm (*)" required="required" name="price">
              <small id="passwordHelpBlock" class="form-text text-muted">
                Giá sản phẩm phải là số.
              </small>
            </div>

            <div class="form-group col-lg-6">
              <input type="text" class="form-control" placeholder="SKU (*)" required="required" name="sku">
              <small id="passwordHelpBlock" class="form-text text-muted">
                Mã đơn vị giữ hàng phải là chữ.
              </small>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-6">
              <input type="number" class="form-control" placeholder="Số sản phẩm tồn kho (*)" required="required" name="stock">
              <small id="passwordHelpBlock" class="form-text text-muted">
                Số sản phầm còn trong kho phải là số.
              </small>
            </div>

            <div class="form-group col-lg-6">
              <input type="file" class="form-control" id="photo-upload">
              <img src="" id="photo_uploaded" style="width: 100px; height: 100px;">
              <small id="passwordHelpBlock" class="form-text text-muted">
                Upload ảnh sản phẩm.
              </small>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary action-save-update" id="action-save-button-id" data-action-id="new">Lưu thay đổi</button>
        </div>
      </div>
    </div>
  </form>
</div>