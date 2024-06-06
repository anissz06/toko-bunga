<?= $this->extend('layout/templateauth'); ?>

<?= $this->section('content'); ?>
<?= csrf_field(); ?>
<div class="container-auth">
    <div class="row">
        <div class="col">
            <form action="/Auth/register" method="post">
                <div class="form-tittle">
                    <h1 style="display: flex;align-items: center;justify-content: center;">Register</h1>
                </div>

                <div class="form-group mt-3">
                    <label for="InputEmail1">Username</label>
                    <input type="nama" class="form-control <?= validation_show_error('username') ? 'is-invalid' : ''; ?>" placeholder="Masukkan Username" value="<?= old('username') ?>" name="username" autofocus>
                    <?php if (validation_show_error('username')) : ?>
                        <div class="invalid-feedback">
                            <?= validation_show_error('username') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group mt-3">
                    <label for="InputEmail1">Email</label>
                    <input type="email" class="form-control <?= validation_show_error('email') ? 'is-invalid' : ''; ?>" aria-describedby="emailHelp" placeholder="Masukkan email" value="<?= old('email') ?>" name="email">
                    <?php if (validation_show_error('email')) : ?>
                        <div class="invalid-feedback">
                            <?= validation_show_error('email') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group mt-3">
                    <label for="InputEmail1">Alamat Rumah</label>
                    <input type="alamat" class="form-control <?= validation_show_error('alamat') ? 'is-invalid' : ''; ?>" aria-describedby="alamatHelp" placeholder="Masukkan alamat" value="<?= old('alamat') ?>" name="alamat">
                    <?php if (validation_show_error('alamat')) : ?>
                        <div class="invalid-feedback">
                            <?= validation_show_error('alamat') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group mt-3">
                    <label for="InputEmail1">No. Telp</label>
                    <input type="no_telp" class="form-control <?= validation_show_error('no_telp') ? 'is-invalid' : ''; ?>" aria-describedby="no_telpHelp" placeholder="Masukkan nomor telpon" value="<?= old('no_telp') ?>" name="no_telp">
                    <?php if (validation_show_error('no_telp')) : ?>
                        <div class="invalid-feedback">
                            <?= validation_show_error('no_telp') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group mt-3">
                    <label for="InputPassword1">Password</label>
                    <input type="password" class="form-control <?= validation_show_error('password') ? 'is-invalid' : ''; ?>" placeholder="Masukkan Password" value="<?= old('password') ?>" name="password">
                    <?php if (validation_show_error('password')) : ?>
                        <div class="invalid-feedback">
                            <?= validation_show_error('password') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="text-center">
                    <button type="submit" name="register" class="btn btn-primary mt-4">Sign Up</button>
                    <p style=" margin-top:6px">Sudah punya akun? <a href="<?= base_url('Auth/loginpage'); ?>">Login</a></p>
                </div>
            </form>


        </div>
    </div>
</div>
<!-- In your view file -->

<?= $this->endSection(); ?>