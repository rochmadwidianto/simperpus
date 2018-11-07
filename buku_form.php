<?php 
  include "koneksi.php";
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_buku = mysql_query("SELECT * FROM buku_ref WHERE bukuId='$id'")or die(mysql_error());
    while($data = mysql_fetch_array($query_buku)){
      $id = $data['bukuId'];
      $kode = $data['bukuKode'];
      $judul = $data['bukuJudul'];
      $pengarang = $data['bukuPengarang'];
      $penerbit = $data['bukuPenerbit'];
      $kategori = $data['bukuKategoriBukuId'];
    }
  } else {
    $id = '';
    $kode = '';
    $judul = '';
    $pengarang = '';
    $penerbit = '';
    $kategori = '';
  }
?>

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-plus-square-o"></i> <b>Tambah</b> <small>Anggota</small></h3>
  </div>
  <!-- /.box-header -->
    <!-- form start -->
      <form action="buku_form.php" method="post" name="form1" class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Kode</label>
            <div class="col-sm-6">
              <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
              <input type="text" class="form-control" name="kode" value="<?php echo $kode ?>" placeholder="Kode Buku">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="judul" value="<?php echo $judul ?>" placeholder="Judul Buku">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Pengarang</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="pengarang" value="<?php echo $pengarang ?>" placeholder="Pengarang">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Penerbit</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="penerbit" value="<?php echo $penerbit ?>" placeholder="Penerbit">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Kategori</label>
            <div class="col-sm-6">
              <select class="form-control" name="kategori">
                <?php 
                  include "koneksi.php";
                  $query_kategori = mysql_query("SELECT * FROM kategori_buku_ref")or die(mysql_error());
                  $nomor = 1;
                  while($data = mysql_fetch_array($query_kategori)){
                  ?>
                    <option <?php echo $data['kategoriBukuId'] == $kategori ? 'selected' : '' ?> value="<?php echo $data['kategoriBukuId'] ?>"><?php echo $data['kategoriBukuNama']; ?></option>
                  <?php 
                  } ?>
              </select>
            </div>
          </div>
        </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-10 col-sm-offset-2">
          <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Simpan</button> 
          <a href="<?php $base_url ?>buku_view.php?tipe=list" class="btn btn-warning"><i class="fa fa-reply-all"></i> Batal</a>
        </div>
      </div>
    <!-- /.box-footer -->
  </form>
</div>

<?php 
if(isset($_POST['submit'])) {
  $id         = $_POST['id'];
  $kode       = $_POST['kode'];
  $judul      = $_POST['judul'];
  $pengarang  = $_POST['pengarang'];
  $penerbit   = $_POST['penerbit'];
  $kategori   = $_POST['kategori'];

  if(isset($id) && $id != '' && !is_null($id)) {
    mysql_query("
      UPDATE `buku_ref`
      SET 
        bukuKode = '$kode', 
        bukuJudul = '$judul', 
        bukuPengarang = '$pengarang', 
        bukuPenerbit = '$penerbit', 
        bukuKategoriBukuId = '$kategori' 
      WHERE bukuId = '$id'");

    header("location: buku_view.php?tipe=list&msg=update");
  } else {
    mysql_query("
      INSERT INTO `buku_ref` 
        (`bukuKode`, `bukuJudul`, `bukuPengarang`, `bukuPenerbit`, `bukuKategoriBukuId`, `bukuTanggalInput`) 
      VALUES 
        ('$kode', '$judul', '$pengarang', '$penerbit', '$kategori', NOW())"
      );

    header("location: buku_view.php?tipe=list&msg=add");
  }
}
?>