<div>
  <div class="pull-right">
    <button class="btn btn-primary action-new">
      Thêm người dùng mới
    </button>
  </div>

  <h3>Tất cả người dùng</h3>
</div>

<script>
  window.app.resourceName = 'admin/users';
  window.app.columns = ['id', 'name', 'email', 'username', 'telephone_number', 'position'];
</script>

<table class="table table-striped table-bordered dtbl">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Username</th>
      <th scope="col">Telephone Number</th>
      <th scope="col">Position</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class="data-table">
    <?php foreach ($users as $user) { ?>
      <tr id="row_<?php echo $user['id']; ?>">
        <th scope="row"><?php echo $user['id']; ?></th>
        <td class="name"><?php echo $user['name']; ?></td>
        <td class="email"><?php echo $user['email']; ?></td>
        <td class="username"><?php echo $user['username']; ?></td>
        <td class="telephone_number"><?php echo $user['telephone_number']; ?></td>
        <td class="position"><?php echo $user['position']; ?></td>
        <td>
          <i class="action-delete fa fa-trash-o" aria-hidden="true" data-action-id="<?php echo $user['id']; ?>"></i>
          <i class="action-edit fa fa-pencil-square-o" data-action-id="<?php echo $user['id']; ?>"></i>
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
          <h5 class="modal-title">Thêm người dùng mới</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body p-4">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <input type="text" class="form-control" placeholder="Họ và tên (*)" style="font-weight: bold;" required="required" name="name">
              <small id="passwordHelpBlock" class="form-text text-muted">
                Vui lòng nhập họ tên người dùng (*)
              </small>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-12">
              <input type="email" class="form-control" placeholder="Email (*)" required="required" name="email">
              <small id="passwordHelpBlock" class="form-text text-muted">
                Vui lòng nhập email của người dùng (*)
              </small>
            </div>

            <div class="form-group col-lg-6">
              <input type="text" class="form-control" placeholder="Tên truy cập (*)" required="required" name="username">
              <small id="passwordHelpBlock" class="form-text text-muted">
                Tên truy cập phải là chuỗi kí tự (*)
              </small>
            </div>

            <div class="form-group col-lg-6">
              <select name="position" class="form-control">
                <option value="user">User</option>
                <option value="admin">Admin</option>
              </select>

              <small id="passwordHelpBlock" class="form-text text-muted">
                Vui lòng chọn role cho user.
              </small>
            </div>

            <div class="form-group col-lg-6">
              <input type="text" class="form-control" placeholder="Địa chỉ" name="telephone_number" pattern="0[0-9]{9}">
              <small id="passwordHelpBlock" class="form-text text-muted">
                Vui lòng nhập địa chỉ nhà.
              </small>
            </div>

            <div class="form-group col-lg-6">
              <input type="text" class="form-control" placeholder="Số điện thoại" name="telephone_number" pattern="0[0-9]{9}">
              <small id="passwordHelpBlock" class="form-text text-muted">
                Vui lòng nhập số điện thoại <br /><i>Theo dạng 09xxxxxxxx</i>.
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