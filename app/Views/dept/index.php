<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
<h1>Manajemen Data Departement</h1>
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
        <table id="dept" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama Departement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dept as $d) : ?>
                    <tr>
                        <td><?= $d['nama_dep']; ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" id="edit_kategori" data-toggle="modal" data-target="#exampleModal2" data-id="<?= $d['id_dept']; ?>" data-nama="<?= $d['nama_dep']; ?>"><i class="fas fa-edit"></i> Edit</button>
                            <form action="<?= base_url('hapusdept/' . $d['id_dept']); ?>" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data Ini ?')">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Departement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('simpandept'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaDept">Nama Departement</label>
                        <input type="text" class="form-control" id="namaDept" name="nama_dep" required>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Departement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="<?= base_url('updatedept'); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body" id="modal-edit">
                    <div class="form-group">
                        <input type="hidden" name="idDept" id="idDept">
                        <label for="namaDept">Nama Departement</label>
                        <input type="text" class="form-control" id="namaDept" name="nama_dep" required>
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
                var iddept = $(this).data('id');
                var namadept = $(this).data('nama');
                $("#modal-edit #idDept").val(iddept);
                $("#modal-edit #namaDept").val(namadept);
            })
        </script>
    </div>
</div>

<?= $this->endsection(); ?>