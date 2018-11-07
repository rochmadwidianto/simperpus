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
                    <a href="<?php $base_url?>buku_view.php?tipe=form" class="btn btn-success btn-sm" title="Tambah" data-toggle="tooltip"><i class="fa fa-plus"> Tambah</i></a> 
                    </h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <table class="table table-bordered table-striped table-hover" id="tableList">
                        <thead>
                        <tr>
                            <th width="10px">No</th>
                		    <th>Kode</th>
                		    <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Kategori</th>
                		    <th width="30px">Aksi</th>
                        </tr>
                        </thead>
            	        <tbody>
                            <?php 
                                include "koneksi.php";
                                include "base_url.php";
                                $query_buku = mysql_query("SELECT * FROM buku_ref JOIN kategori_buku_ref ON kategoriBukuId = bukuKategoriBukuId")or die(mysql_error());
                                $nomor = 1;
                                while($data = mysql_fetch_array($query_buku)){
                                    ?>
                                    <tr>
                                        <td><?php echo $nomor++; ?></td>
                                        <td><?php echo $data['bukuKode']; ?></td>
                                        <td><?php echo $data['bukuJudul']; ?></td>
                                        <td><?php echo $data['bukuPengarang']; ?></td>
                                        <td><?php echo $data['bukuPenerbit']; ?></td>
                                        <td><?php echo $data['kategoriBukuNama']; ?></td>
                                        <td>  
                                            <a href="<?php $base_url?>buku_view.php?tipe=form&act=edit&id=<?php echo $data['bukuId']; ?>" class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                            <a href="<?php $base_url?>buku_delete.php?id=<?php echo $data['bukuId'] ?>" onclick="confirmDelete('<?php echo $data['bukuJudul']; ?>')" class="btn btn-danger btn-xs" title="Hapus" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a>           

                                            <a style="display: none;" id="actDelete" href="<?php $base_url?>buku_delete.php?id=<?php echo $data['bukuId']; ?>"></a>   
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
        var msg = confirm('Apakah anda yakin akan menghapus buku '+nama);
        if(msg) {
            document.getElementById('actDelete').click();
        }
    }
</script>