<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; height: 100vh;">
    <a href="home_admin.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4">Dashboard Admin</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="home_admin.php" class="nav-link active" aria-current="page">
                <i class="bi bi-house"></i> Home
            </a>
        </li>
        <li>
            <a href="tambah_produk.php" class="nav-link text-dark">
                <i class="bi bi-plus-square"></i> Tambah Produk
            </a>
        </li>
        <li>
            <a href="lihat_produk.php" class="nav-link text-dark">
                <i class="bi bi-box"></i> Lihat Produk
            </a>
        </li>
        <li>
            <a href="logout.php" class="nav-link text-dark">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>Admin</strong>
        </a>
    </div>
</div>

<style>
    /* CSS for sidebar */
    .bg-light {
        background-color: #f8f9fa !important;
    }
    .nav-link.active {
        background-color: #007bff;
        color: #fff;
    }
    .nav-link:hover {
        background-color: #0056b3;
        color: #fff;
    }
</style>
