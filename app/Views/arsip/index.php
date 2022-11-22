<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
<h1>Halaman Arsip</h1>
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
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <?php
    $errors = session()->getFlashdata('errors');
    if (!empty($errors)) : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Terjadi Kesalahan!</h5>
            <?php
            foreach ($errors as $key => $value) { ?>
                <li><?= esc($value); ?></li>
            <?php } ?>
        </div>
    <?php endif; ?>

    <div class="card-body">
        <table id="arsip" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID Arsip</th>
                    <th>Kategori</th>
                    <th>No Arsip</th>
                    <th>Nama Arsip</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arsip as $a) : ?>
                    <tr>
                        <td><?= $a['id_arsip']; ?></td>
                        <td><?= $a['nama_kategori']; ?></td>
                        <td><?= $a['no_arsip']; ?></td>
                        <td><?= $a['nama_arsip']; ?></td>
                        <td><?= $a['deskripsi']; ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                            <button type="button" class="btn btn-sm btn-warning" id="edit_arsip" data-toggle="modal" data-target="#exampleModal2" data-id="<?= $a['id_arsip']; ?>" data-idkat="<?= $a['id_kategori']; ?>" data-kategori="<?= $a['nama_kategori']; ?>" data-noarsip="<?= $a['no_arsip']; ?>" data-nama="<?= $a['nama_arsip']; ?>" data-deskripsi="<?= $a['deskripsi']; ?>" data-iddept="<?= $a['id_dept']; ?>" data-dept="<?= $a['nama_dep']; ?>"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash d-inline"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->

</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tambaharsip'); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <?php
                    helper('text');
                    $no_arsip = date('ymds') . '-' . random_string('alnum', 5);
                    ?>

                    <div class="form-group">
                        <label>ID Arsip</label>
                        <input type="text" class="form-control" id="id_arsip" name="id_arsip" value="<?= $no_arsip; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($Kat as $k) : ?>
                                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No Arsip</label>
                        <input type="text" class="form-control" id="no_arsip" name="no_arsip">
                    </div>
                    <div class="form-group">
                        <label>Nama Arsip</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Departemen</label>
                        <select class="form-control" name="departemen">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($Dept as $d) : ?>
                                <option value="<?= $d['id_dept']; ?>"><?= $d['nama_dep']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Upload File</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                        <label class="text-danger">File Harus Format .pdf dan ukuran Max. 2 Mb</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary d-inline-flex">Simpan</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Arsip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-edit">
                <form action="<?= base_url('updatearsip'); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <?php
                    // helper('text');
                    // $no_arsip = date('ymds') . '-' . random_string('alnum', 5);
                    ?>
                    <input type="hidden" name="fileLama" value="<?= $a['file']; ?>">
                    <div class="form-group">
                        <label>ID Arsip</label>
                        <input type="text" class="form-control" name="id_arsip" id="idArsip" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori" id="kat">
                            <option></option>
                            <option value="">-- Pilih --</option>
                            <?php foreach ($Kat as $k) : ?>
                                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No Arsip</label>
                        <input type="text" class="form-control" id="noArsip" name="no_arsip">
                    </div>
                    <div class="form-group">
                        <label>Nama Arsip</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Departemen</label>
                        <select class="form-control" name="departemen" id="departemen">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($Dept as $d) : ?>
                                <option value="<?= $d['id_dept']; ?>"><?= $d['nama_dep']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Upload File</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                        <label class="text-danger">File Harus Format .pdf dan ukuran Max. 2 Mb</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary d-inline-flex">Simpan</button>
                    </div>
            </div>
            </form>
        </div>
        <script src="<?= base_url(); ?>/dist/js/jquery-3.5.1.js"></script>

        <script>
            $(document).on("click", "#edit_arsip", function() {
                var idArsip = $(this).data('id');
                var idKat = $(this).data('idKat');
                var kat = $(this).data('kategori');
                var noArsip = $(this).data('noarsip');
                var nama = $(this).data('nama');
                var desk = $(this).data('deskripsi');
                var iddept = $(this).data('iddept');
                var dept = $(this).data('dept');
                $("#modal-edit #idArsip").val(idArsip);
                $("#modal-edit #kat option").attr("value", idKat);
                $("#modal-edit #noArsip").val(noArsip);
                $("#modal-edit #nama").val(nama);
                $("#modal-edit #deskripsi").val(desk);
                // $("#modal-edit #departemen").val(dept);
                $("#modal-edit #departemen").attr("value", dept);

                // function getSelectValue() {
                //     var selectedValue = document.getElementById("kat").value;
                // }
            })
        </script>
    </div>
</div>


<?= $this->endSection(); ?>