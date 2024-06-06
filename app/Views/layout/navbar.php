<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <img src="/img/logo.jpg" alt="Brand Image" width="30" height="30" class="d-inline-block align-top" loading="lazy" style="margin-right: 5px;">
        <a class="navbar-brand ml-3">Komikin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('Home/'); ?>">Home</a>
                </li>
            </ul>
            <?php if (session()->has('userData')) : ?>
                <ul class="navbar-nav" style="margin-left: -3cm;">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('Transaksi/'); ?>">Keranjang</a>
                    </li>
                    <li class="nav-item dropdown ms-auto" style="padding-right: 3cm;">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('DataCheckout/'); ?>">Riwayat Pembelian</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('Auth/logout'); ?>">Logout</a></li>
                        </ul>
                    </li>
                    <!-- Akhir bagian yang ingin dipindahkan ke sisi kanan -->
                </ul>
            <?php else : ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="<?= base_url('Auth/loginpage'); ?>" class="btn btn-outline-success">Login</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>