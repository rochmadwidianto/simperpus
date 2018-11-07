<?php 
    if(isset($_GET['msg'])){
        $err_msg = $_GET['msg'];
        if($err_msg == "add") {
            echo "
                <div class='col-sm-12'>
                    <div class='alert alert-success' role='alert'>
                      <i class='fa fa-thumbs-up'></i> <b>SUKSES</b> : Penambahan data berhasil dilakukan.
                    </div>
                </div>
            ";
        }else if($err_msg == "update"){
            echo "
                <div class='col-sm-12'>
                    <div class='alert alert-success' role='alert'>
                      <i class='fa fa-thumbs-up'></i> <b>SUKSES</b> : Pengubahan data berhasil dilakukan.
                    </div>
                </div>
            ";
        }else if($err_msg == "delete"){
            echo "
                <div class='col-sm-12'>
                    <div class='alert alert-success' role='alert'>
                      <i class='fa fa-thumbs-up'></i> <b>SUKSES</b> : Penghapusan data berhasil dilakukan.
                    </div>
                </div>
            ";
        }
    }
?>

<!-- Main content -->
    <section class='content'>
        <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>
                    <a href="<?php $base_url?>tarif_view.php?tipe=form" class="btn btn-success btn-sm" title="Tambah" data-toggle="tooltip"><i class="fa fa-plus"> Tambah</i></a> 
                    </h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <table class="table table-bordered table-striped table-hover" id="tableList">
                        <thead>
                        <tr>
                            <th width="10px">No</th>
                		    <th>Buku</th>
                		    <th>Pinjam</th>
                            <th>Terlambat</th>
                            <th>Rusak</th>
                            <th>Ganti</th>
                		    <th width="30px">Aksi</th>
                        </tr>
                        </thead>
            	        <tbody>
                            <?php 
                                include "koneksi.php";
                                include "base_url.php";
                                $query_tarif = mysql_query("SELECT * FROM tarif_ref JOIN buku_ref ON bukuId = tarifBukuId")or die(mysql_error());
                                $nomor = 1;
                                while($data = mysql_fetch_array($query_tarif)){
                                    ?>
                                    <tr>
                                        <td><?php echo $nomor++; ?></td>
                                        <td><?php echo $data['bukuJudul']; ?></td>
                                        <td align="right"><?php echo number_format($data['tarifPinjam'], 2, ',', '.'); ?></td>
                                        <td align="right"><?php echo number_format($data['tarifTerlambat'], 2, ',', '.'); ?></td>
                                        <td align="right"><?php echo number_format($data['tarifRusak'], 2, ',', '.'); ?></td>
                                        <td align="right"><?php echo number_format($data['tarifGanti'], 2, ',', '.'); ?></td>
                                        <td>  
                                            <a href="<?php $base_url?>tarif_view.php?tipe=form&act=edit&id=<?php echo $data['tarifId']; ?>" class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                            <a href="<?php $base_url?>tarif_delete.php?id=<?php echo $data['tarifId'] ?>" onclick="confirmDelete('<?php echo $data['tarifBukuId']; ?>')" class="btn btn-danger btn-xs" title="Hapus" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a>           

                                            <a style="display: none;" id="actDelete" href="<?php $base_url?>tarif_delete.php?id=<?php echo $data['tarifId']; ?>"></a>   
                                        </td>
                                    </tr>
                                    <?php 
                                } ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<script type="text/javascript">
    function confirmDelete(nama) {
        var msg = confirm('Apakah anda yakin akan menghapus Tarif '+nama);
        if(msg) {
            document.getElementById('actDelete').click();
        }
    }
</script>