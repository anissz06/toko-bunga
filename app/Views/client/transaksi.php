<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php if (session()->has('success')) : ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php elseif (session()->has('error')) : ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<div class="container-client">
    <div class="row-client">
        <div class="col" style="width:auto">
            <h3 style="display: flex;justify-content: center;align-items: center;margin-bottom:3">Detail Transaksi</h3>
            <br></br>

            <?php foreach ($transaksi as $t) : ?>
                <div class="card mb-3" style="border-radius:50px;">
                    <div class="row g-0" style="width:650px">
                        <div class="col-md-4" style="width:auto;border-radius:70px;">
                            <img src="/img/<?= $t['gambar']; ?>" class=" img-fluid" style="max-width: 200px; border-radius:50px;" alt="...">
                        </div>
                        <div class="col-md-8" style="padding-left: 10px;">
                            <div class="card-body">
                                <h5 class="card-title">nama Komik : <?= $t['nama']; ?></h5>
                                <p class="card-text">Harga Komik : <?= $t['harga']; ?></p>
                                <!-- Informasi lainnya -->
                                <p class="card-text"><small class="text-muted">Last added 1 mins ago</small></p>
                                <form action="<?= base_url('Transaksi/delete/' . $t['id']); ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-dark" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Delete</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach ?>
            <div class="card mb-3" style="border-radius:50px;">
                <div class="row g-0" style="width:650px">
                    <div class="col-md-4" style="width:auto;">

                        <img src=" /img/black.jpg" class="img-fluid" style="max-width: 70px; border-radius:50px;" alt="...">
                    </div>
                    <div class="col-md-8">
                        <h5 class=" card-body" style="display: flex;justify-content: center ;align-items:auto;border-radius:50px;">Total Harga : <?= $totalHarga; ?></h5>
                    </div>
                </div>
            </div>


            <!-- Button untuk memicu modal konfirmasi -->
            <button class="btn btn-outline-dark d-block mx-auto" onclick="konfirmasiPembayaran()">
                Bayar
            </button>

            <!-- Modal konfirmasi -->
            <div class="modal" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin melakukan pembayaran?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" onclick="pembayaranCekDulu()">Cek dulu</button>

                            <button type="button" class="btn btn-dark" onclick="pembayaranYa()">Ya</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="paymentInfoModal" tabindex="-1" role="dialog" aria-labelledby="paymentInfoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentInfoModalLabel">Informasi Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="/Transaksi/bayar" method="post" enctype="multipart/form-data" id="paymentForm">
                            <div class="modal-body">
                                <!-- Isi informasi rekening di sini -->
                                <p>Silakan transfer ke rekening AN. <b>Suci Annisa Zahra 15210287 BCA</b></p>
                                <p>Jumlah yang harus dibayar: <?= $totalHarga; ?> -</p>
                                <div class="form-group mb-3">
                                    <label for="jumlahTransfer">Bukti Transfer (Jpg/Jpeg)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-file"></i> <!-- Ganti "fa fa-file" dengan kelas ikon yang sesuai -->
                                        </span>
                                        <input type="file" class="form-control-file" id="buktiPembayaran" name="buktiPembayaran" required>
                                    </div>
                                </div>
                                <!-- Ganti informasi di atas sesuai kebutuhan -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark" onclick="pembayaranCekDulu()">Tutup</button>
                                <button type="submit" class="btn btn-outline-dark">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                function konfirmasiPembayaran() {
                    // Tampilkan modal konfirmasi
                    $('#confirmationModal').modal('show');
                }

                // function pembayaranYa() {
                //     // Sembunyikan modal konfirmasi
                //     $('#confirmationModal').modal('hide');

                //     // Tampilkan detail pembayaran
                //     $('#paymentSection').show();
                // }

                function pembayaranCekDulu() {
                    window.location.href = "<?php echo base_url('Transaksi/'); ?>";
                }

                // Fungsi untuk mengeksekusi ketika tombol "Ya" pada modal konfirmasi diklik
                function pembayaranYa() {
                    $('#paymentInfoModal').modal('show');
                }
            </script>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>