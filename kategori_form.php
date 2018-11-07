<?php 
  include "koneksi.php";
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_buku = mysql_query("SELECT * FROM kategori_buku_ref WHERE kategoriBukuId='$id'")or die(mysql_error());
    while($data = mysql_fetch_array($query_buku)){
      $id = $data['kategoriBukuId'];
      $kode = $data['kategoriBukuKode'];
      $nama = $data['kategoriBukuNama'];
    }
  } else {
    $id = '';
    $kode = '';
    $nama = '';
  }
?>

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-plus-square-o"></i> <b>Tambah</b> <small>Kategori Buku</small></h3>
  </div>
  <!-- /.box-header -->
    <!-- form start -->
      <form action="kategori_form.php" method="post" name="form1" class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Kode</label>
            <div class="col-sm-6">
              <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
              <input type="text" class="form-control" name="kode" value="<?php echo $kode ?>" placeholder="Kode Kategori Buku">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" placeholder="Nama Kategori Buku">
            </div>
          </div>
        </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-10 col-sm-offset-2">
          <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Simpan</button> 
          <a href="<?php $base_url ?>kategori_view.php?tipe=list" class="btn btn-warning"><i class="fa fa-reply-all"></i> Batal</a>
        </div>
      </div>
    <!-- /.box-footer -->
  </form>
</div>

<?php 
if(isset($_POST['submit'])) {
  $id         = $_POST['id'];
  $kode       = $_POST['kode'];
  $nama       = $_POST['nama'];

  if(isset($id) && $id != '' && !is_null($id)) {
    mysql_query("
      UPDATE `kategori_buku_ref`
      SET 
        kategoriBukuKode = '$kode', 
        kategoriBukuNama = '$nama'
      WHERE kategoriBukuId = '$id'");

    header("location: kategori_view.php?tipe=list&msg=update");
  } else {
    mysql_query("
      INSERT INTO `kategori_buku_ref` 
        (`kategoriBukuKode`, `kategoriBukuNama`) 
      VALUES 
        ('$kode', '$nama')"
      );

    header("location: kategori_view.php?tipe=list&msg=add");
  }
}
?>