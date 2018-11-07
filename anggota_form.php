<?php 
  include "koneksi.php";
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_anggota = mysql_query("SELECT * FROM anggota_ref WHERE anggotaId='$id'")or die(mysql_error());
    while($data = mysql_fetch_array($query_anggota)){
      $id = $data['anggotaId'];
      $kode = $data['anggotaKode'];
      $nama = $data['anggotaNama'];
      $tgl_lahir = $data['anggotaTanggalLahir'];
      $jk = $data['anggotaJenisKelamin'];
      $hp = $data['anggotaHP'];
      $pekerjaan = $data['anggotaPekerjaan'];
      $alamat = $data['anggotaAlamat'];
    }
  } else {
      $id = '';
      $kode = '';
      $nama = '';
      $tgl_lahir = '';
      $jk = '';
      $hp = '';
      $pekerjaan = '';
      $alamat = '';
  }
?>

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-plus-square-o"></i> <b>Tambah</b> <small>Anggota</small></h3>
  </div>
  <!-- /.box-header -->
    <!-- form start -->
      <form action="anggota_form.php" method="post" name="form1" class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Kode</label>
            <div class="col-sm-6">
              <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
              <input type="text" class="form-control" name="kode" value="<?php echo $kode ?>" placeholder="Kode Anggota">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" placeholder="Nama Anggota">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Tanggal Lahir</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="tgl_lahir" value="<?php echo $tgl_lahir ?>" placeholder="Tanggal Lahir">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Jenis Kelamin</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="jk" value="<?php echo $jk ?>" placeholder="Jenis Kelamin">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Telp / HP</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="hp" value="<?php echo $hp ?>" placeholder="Telp / HP">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Pekerjaan</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="pekerjaan" value="<?php echo $pekerjaan ?>" placeholder="Pekerjaan">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="alamat" value="<?php echo $alamat ?>" placeholder="Alamat">
            </div>
          </div>
        </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-10 col-sm-offset-2">
          <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"></i> Simpan</button> 
          <a href="<?php $base_url ?>anggota_view.php?tipe=list" class="btn btn-warning"><i class="fa fa-reply-all"></i> Batal</a>
        </div>
      </div>
    <!-- /.box-footer -->
  </form>
</div>

<?php 
if(isset($_POST['submit'])) {
  $id = $_POST['id'];
  $kode = $_POST['kode'];
  $nama = $_POST['nama'];
  $tgl_lahir = $_POST['tgl_lahir'];
  $jk = $_POST['jk'];
  $hp = $_POST['hp'];
  $pekerjaan = $_POST['pekerjaan'];
  $alamat = $_POST['alamat'];
  $tgl_input = date('Y-m-d');

  if(isset($id) && $id != '' && !is_null($id)) {
    mysql_query("
      UPDATE `anggota_ref`
      SET 
        anggotaKode = '$kode', 
        anggotaNama = '$nama', 
        anggotaTanggalLahir = '$tgl_lahir', 
        anggotaJenisKelamin = '$jk', 
        anggotaHP = '$hp', 
        anggotaPekerjaan = '$pekerjaan', 
        anggotaAlamat = '$alamat'
      WHERE anggotaId = '$id'");

    header("location: anggota_view.php?tipe=list&msg=update");
  } else {
    mysql_query("
      INSERT INTO `anggota_ref` 
        (`anggotaKode`, `anggotaNama`, `anggotaTanggalLahir`, `anggotaJenisKelamin`, `anggotaHP`, `anggotaPekerjaan`, `anggotaAlamat`, `anggotaTanggalInput`) 
      VALUES 
        ('$kode', '$nama', '$tgl_lahir', '$jk', '$hp', '$pekerjaan', '$alamat', '$tgl_input')"
      );

    header("location: anggota_view.php?tipe=list&msg=add");
  }
}
?>