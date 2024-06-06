<?= $this->extend('layout/templateauth'); ?>

<?= $this->section('content'); ?>

<div class="container-auth">
    <div class="row">
        <div class="col">
            <?= csrf_field(); ?>

            <form action="/Auth/login" method="POST">
                <div class="form-tittle ">
                    <h1 style="display: flex; align-items: center; justify-content: center;">Login</h1>
                </div>

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('pesan') ?>
                    </div>
                <?php endif; ?>

                <div class="form-group mt-3">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control <?= validation_show_error('username') ? 'is-invalid' : ''; ?>" aria-describedby="emailHelp" placeholder="Masukkan username" name="username" value="<?= old('username') ?>" autofocus>
                    <?php if (validation_show_error('username')) : ?>
                        <div class="invalid-feedback">
                            <?= validation_show_error('username') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group mt-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control <?= validation_show_error('password') ? 'is-invalid' : ''; ?>" placeholder="Masukkan Password" value="<?= old('password') ?>" name="password">
                    <?php if (validation_show_error('password')) : ?>
                        <div class="invalid-feedback">
                            <?= validation_show_error('password') ?>
                        </div>
                    <?php endif; ?>
                </div>


                <div class="text-center">
                    <input type="submit" name="login" class="btn btn-primary mt-4" value="login">
                    <p style="margin-top: 6px">Belum punya akun? <a href="<?= base_url('Auth/registerpage'); ?>">Register</a></p>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- In your view file -->

<?= $this->endSection(); ?>