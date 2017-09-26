<div class="row">
    <div class="col-md-6 offset-md-3">
        <span class="anchor" id="formLogin"></span>

        <!-- form card login -->
        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0">Login</h3>
            </div>
            <div class="card-block">

                <div class="alert alert-danger" role="alert" style="display: none">
                </div>

                <form action="<?= URL ?>login/postLogin" method="POST" class="form" role="form" autocomplete="off" id="formLogin">
                    <div class="form-group">
                        <label for="uname1">Username: admin</label>
                        <input type="text" class="form-control" name="username" id="uname1" required="">
                    </div>
                    <div class="form-group">
                        <label>Password: 123456</label>
                        <input type="password" class="form-control" id="password" name="password" required="" autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn btn-success btn-lg float-right">Login</button>
                </form>
            </div>
            <!--/card-block-->
        </div>
        <!-- /form card login -->
    </div>
</div>