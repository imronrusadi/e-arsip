<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
<h1>Halaman Utama</h1>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" aria-hidden="true"></button>
    <h5><i class="icon fas fa-info"></i> Selamat Datang</h5>
    Aplikasi E Arsip SMK Negeri 1 Lubuk Basung
</div>
<?= $this->endSection(); ?>