<?php 
  include "koneksi.php";
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_tarif = mysql_query("SELECT * FROM tarif_ref WHERE tarifId='$id'")or die(mysql_error());
    while($data = mysql_fetch_array($query_tarif)){
      $id = $data['tarifId'];
      $buku = $data['tarifBukuId'];
      $pinjam = $data['tarifPinjam'];
      $terlambat = $data['tarifTerlambat'];
      $rusak = $data['tarifRusak'];
      $ganti = $data['tarifGanti'];
    }
  } else {
    $id = '';
    $buku = '';
    $pinjam = '';
    $terlambat = '';
    $rusak = '';
    $ganti = '';
  }
?>

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-plus-square-o"></i> <b>Tambah</b> <small>Anggota</small></h3>
  </div>
  <!-- /.box-header -->
    <!-- form start -->
      <form action="tarif_form.php" method="post" name="form1" class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Buku</label>
            <div class="col-sm-5">
              <select class="form-control" name="buku">
                <?php 
                  include "koneksi.php";
                  $query_buku = mysql_query("SELECT * FROM buku_ref")or die(mysql_error());
                  $nomor = 1;
                  while($data = mysql_fetch_array($query_buku)){
                  ?>
                    <option <?php echo $data['bukuId'] == $buku ? 'selected' : '' ?> value="<?php echo $data['bukuId'] ?>"><?php echo $data['bukuJudul']; ?></option>
                  <?php 
                  } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Pinjam</label>
            <div class="col-sm-3">
              <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
              <input type="text" class="form-control" name="pinjam" value="<?php echo $pinjam ?>" placeholder="Tarif Pinjam">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Terlambat</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="terlambat" value="<?php echo $terlambat ?>" placeholder="Tarif Terlambat">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Rusak</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="rusak" value="<?php echo $rusak ?>" placeholder="Tarif Rusak">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Ganti</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="ganti" value="<?php echo $ganti ?>" placeholder="Tarif Ganti">
            </div>
          </div>
        </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-10 col-sm-offset-2">
          <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Simpan</button> 
          <a href="<?php $base_url ?>tarif_view.php?tipe=list" class="btn btn-warning"><i class="fa fa-reply-all"></i> Batal</a>
        </div>
      </div>
    <!-- /.box-footer -->
  </form>
</div>

<?php 
if(isset($_POST['submit'])) {
  $id         = $_POST['id'];
  $buku       = $_POST['buku'];
  $pinjam     = $_POST['pinjam'];
  $terlambat  = $_POST['terlambat'];
  $rusak      = $_POST['rusak'];
  $ganti      = $_POST['ganti'];
  $user_id    = 1;
  $tgl_input  = date('Y-m-d');

  if(isset($id) && $id != '' && !is_null($id)) {
    mysql_query("
      UPDATE `tarif_ref`
      SET 
        tarifBukuId = '$buku', 
        tarifPinjam = '$pinjam', 
        tarifTerlambat = '$terlambat', 
        tarifRusak = '$rusak', 
        tarifGanti = '$ganti', 
        tarifUserId = '$user_id'
      WHERE tarifId = '$id'");

    header("location: tarif_view.php?tipe=list&msg=update");
  } else {
    mysql_query("
      INSERT INTO `tarif_ref` 
        (`tarifBukuId`, `tarifPinjam`, `tarifTerlambat`, `tarifRusak`, `tarifGanti`, `tarifUserId`, `tarifTanggalInput`) 
      VALUES 
        ('$buku', '$pinjam', '$terlambat', '$rusak', '$ganti', '$user_id', '$tgl_input')"
      );

    header("location: tarif_view.php?tipe=list&msg=add");
  }
}
?>