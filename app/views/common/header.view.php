<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://keenthemes.com/preview/metronic/theme/assets/layouts/layout/css/layout.min.css">
    <link rel="stylesheet" href="<?php echo $root_url; ?>/assets/css/main.css">
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

    <title><?php echo @$pageTitle; ?></title>

    <script>window.app = {}; window.app.root_url = '<?php echo $root_url; ?>'; </script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Quản lý đơn hàng</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $g->router->url('homepage', 'index'); ?>">Trang chủ</a>
          </li>

          <?php if (@$g->currentUser['position'] == 'admin') { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $g->router->url('admin/products'); ?>">Sản phẩm</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?php echo $g->router->url('admin/users'); ?>">Người dùng</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?php echo $g->router->url('admin/orders'); ?>">Đơn hàng</a>
            </li>
          <?php } ?>

          <?php if (@$g->currentUser['position'] == 'user') { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $g->router->url('admin/orders'); ?>">Đơn hàng</a>
            </li>
          <?php } ?>
        </ul>

        <?php if (@$g->currentUser) { ?> 
        <div class="nav-item dropdown pull-right">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Xin chào <?php echo @$g->currentUser['username']; ?>!
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo $g->router->url('login', 'logout'); ?>">Đăng xuất</a>
          </div>
        </div>
        <?php } ?>
      </div>
    </nav>

    <div class="container" style="padding-top: 20px;">