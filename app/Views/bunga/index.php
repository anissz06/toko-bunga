<?= $this->extend('layout/templateadmin'); ?>
<?= $this->section('contentadmin') ?>

<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1>Daftar Komik</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-centered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 10%;" class="text-center">Nomor</th>
                            <th scope="col" style="width: 15%;" class="text-center">gambar</th>
                            <th scope="col" style="width: 15%;" class="text-center">nama</th>
                            <th scope="col" style="width: 15%;" class="text-center">More</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($produk as $p) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $i++; ?></th>
                                <td class="text-center"><img src="/img/<?= $p['gambar']; ?>" alt="" class="sampul" style="width: 75px;"></td>
                                <td class="text-center"><?= $p['nama']; ?></td>
                                <td class="text-center">
                                    <a href="/bunga/<?= $p['nama']; ?>" class="btn btn-outline-secondary">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>