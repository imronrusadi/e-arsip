<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
<h1>Manajemen Data Kategori</h1>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i> Tambah data
            </button>
        </h3>

    </div>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <div class="card-body">
        <table id="kategori" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kategori as $k) : ?>
                    <tr>
                        <td><?= $k['nama_kategori']; ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" id="edit_kategori" data-toggle="modal" data-target="#exampleModal2" data-id="<?= $k['id_kategori']; ?>" data-nama="<?= $k['nama_kategori']; ?>"><i class="fas fa-edit"></i> Edit</button>
                            <form action="<?= base_url('hapuskat/' . $k['id_kategori']); ?>" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data Ini ?')">
                                <?= csrf_field(); ?>
                                <input type="hidden" value="_method" value="POST">
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('simpankat'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namakategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="namakategori" name="nama_kategori" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="<?= base_url('updatekat'); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body" id="modal-edit">
                    <div class="form-group">
                        <input type="hidden" name="idkategori" id="idkategori">
                        <label for="namakategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="namakategori" name="nama_kategori" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="edit" name="edit"><i class="far fa-save"></i> Edit</button>
                </div>
            </form>
        </div>
        <!-- Menampilkan data pada modal bootstraps -->
        <!-- panggil jquery -->
        <script src="<?= base_url(); ?>/dist/js/jquery-3.5.1.js"></script>
        <!-- script untuk menampilkan data pada form -->
        <script>
            $(document).on("click", "#edit_kategori", function() {
                var idkategori = $(this).data('id');
                var namakategori = $(this).data('nama');
                $("#modal-edit #idkategori").val(idkategori);
                $("#modal-edit #namakategori").val(namakategori);
            })
        </script>
    </div>
</div>

<?= $this->endsection(); ?>