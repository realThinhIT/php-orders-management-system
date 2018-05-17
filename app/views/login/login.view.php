<div class="col-lg-6 m-auto">
  <div class="login-card card card-default">
    <div class="card-header">
      <b>Sign In</b>
    </div>
    <div class="card-body">
      <form role="form" method="POST">
        <fieldset>
          <div class="form-group">
            <input class="form-control" placeholder="E-mail/ Username" name="email" type="text" autofocus="" required="required">
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Password" name="password" type="password" value="" required="required">
          </div>
          
          <!-- Change this to a button or input when using this as a form -->
          <button class="btn btn-primary">Login</button> <a href="<?php echo $g->router->url('login', 'register'); ?>" class="btn btn-secondary">Đăng kí</a>
        </fieldset>
      </form>
    </div>
  </div>
</div>