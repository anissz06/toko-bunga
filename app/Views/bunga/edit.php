<?= $this->extend('layout/templateadmin'); ?> #Kita kasih tau CI kalo kita bakalan render template
<?= $this->section('contentadmin') ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Ubah data produk</h2>
            <!--Validation Flash data ditampilin, pake cara kayak daftar produk -->

            <form action="/admin/update/<?= $produk['id']; ?>" method="post">
                <?= csrf_field(); ?> <!-- Agar form tidak diinput dari mpihak ketiga -->

                <input type="hidden" name="slug" value="<?= $produk['nama']; ?>">
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= (old('nama')) ? old('nama') : $produk['nama']; ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('nama'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="deskripsi" class="col-sm-2 col-form-label">deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?= (old('deskripsi')) ? old('deskripsi') : $produk['deskripsi']; ?></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="genre" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " id="stok" name="stok" value="<?= (old('stok')) ? old('stok') : $produk['stok']; ?>">
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="genre" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " id="harga" name="harga" value="<?= (old('harga')) ? old('harga') : $produk['harga']; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="gambar" class="col-sm-2 col-form-label">gambar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " id="gambar" name="gambar" value="<?= (old('gambar')) ? old('gambar') : $produk['gambar']; ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>