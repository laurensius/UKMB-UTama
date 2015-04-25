<div class="row">
    <div class="col-lg-12">
        <label>
            <h2>
                Detail <?php echo $this->session->userdata('s_k_nama_kesebelasan'); ?>
            </h2>
        </label>

    </div>
    <div class="col-lg-2">
        <div id="logo">
        <img src="<?php echo base_url();?>upload/logoukm.png" class="img-thumbnail">    
        </div>
        <center>
            <a href="<?php echo site_url();?>/kesebelasan/ganti_logo">Ganti Logo</a>
        </center>
    </div>
    <div class="col-lg-10">
        <center>
            <h3>Formulir Tambah Pemain</h3>
        </center>
        <a class="btn btn-primay" href="<?php echo site_url();?>/kesebelasan/ok"><span class="glyphicon glyphicon-backward"></span><b> Back</b></a>
        <br>
        <form method="post" action="<?php echo site_url();?>/kesebelasan/insert">
            <div class="row">
                <div class="col-lg-6">
                    <label>Nama Pemain</label>
                    <input type="text" class="form-control" name="nama" required placeholder="Nama Pemain">
                    <br>
                </div>
                <div class="col-lg-6">
                    <label>Apakah kapten kesebelasan ?</label>
                    <select name="is_captain" class="form-control">
                        <option value="0">Tidak</option>
                        <option value="1">Ya</option>
                    </select>
                    <br>
                </div>
           </div>
            <div class="row">
                <div class="col-lg-6">
                    <label>Posisi</label>
                    <input type="text" class="form-control" name="posisi" required placeholder="Posisi">
                    <br>
                </div>
                <div class="col-lg-6">
                    <label>No Punggung</label>
                    <input type="number" class="form-control" name="no_punggung" required placeholder="No.Punggung">
                    <br>
                </div>
           </div>
            <center>
                <input type="submit" value="Simpan Data Pemain" class="btn btn-primary">
            </center>
        </form>
        
    </div>
</div>

