

    <ul class="nav navbar-nav navbar-right" style="text-align: center;padding-left: 1em">
        <form action="<?=base_url('user/login')?>" role="form" method="post" class="navbar-form row-center">
            <div class="form-group  label-floating">
                <input type="email" required value="mario.pcdl@gmail.com" name="email" placeholder="Email" class="form-control">
            </div>
            <div class="form-group label-floating">
                <input type="password"  required name="pass" value="mario1234" placeholder="Contraseña" class="form-control">
            </div>
            <button type="submit" class="btn btn-raised btn-sm btn-danger">Login</button>
            <p class="help-block error-block text-danger" style="display: none">You should really write something here</p>
        </form>
    </ul>
