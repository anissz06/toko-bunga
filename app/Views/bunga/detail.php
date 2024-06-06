<?= $this->extend('layout/templateadmin'); ?>
<?= $this->section('contentadmin') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Detail Komik</h2>
            <div class="card mb-3" style="border-radius: 50px; width: 750px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $produk['gambar']; ?>" class="img-fluid rounded-start" alt="..." style="border-radius: 50px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body" style="display: grid; grid-template-columns: 1fr;">
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                <div style="display: flex;">
                                    <div style="width: 120px;">Nama</div>
                                    <div>: <?= $produk['nama']; ?></div>
                                </div>
                                <div style="display: flex;">
                                    <div style="width: 120px;">Stok</div>
                                    <div>: <?= $produk['stok']; ?></div>
                                </div>
                                <div style="display: flex;">
                                    <div style="width: 120px;">Harga</div>
                                    <div>: <?= $produk['harga']; ?></div>
                                </div>
                                <div style="display: flex; flex-direction: column;">
                                    <div style="display: flex;">
                                        <div style="width: 120px;">Deskripsi</div>
                                        <div style="word-break: break-word;">:</div>
                                    </div>
                                    <div style="margin-left: 120px; margin-top: 5px;">
                                        <?= $produk['deskripsi']; ?>
                                    </div>
                                </div>

                                <div style="display: flex; gap: 10px; margin-top: 10px;">
                                    <div>
                                        <a href="/Admin/edit/<?= $produk['nama']; ?>" class="btn btn-outline-warning">Edit</a>
                                    </div>
                                    <div>
                                        <form action="/admin/delete/<?= $produk['id']; ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Delete</button>
                                        </form>
                                    </div>
                                </div>

                                <div style="margin-top: 10px;">
                                    <a href="/bunga" class="btn btn-outline-dark d-block mx-auto">Kembali ke daftar komik</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>