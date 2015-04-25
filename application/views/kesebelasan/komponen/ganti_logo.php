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
            <h3>Formulir Ganti Logo Kesebelasan</h3>
        </center>
        <a class="btn btn-primay" href="<?php echo site_url();?>/kesebelasan/ok"><span class="glyphicon glyphicon-backward"></span><b> Back</b></a>
        <br>
        <form method="post" enctype="multipart/form-data" action="<?php echo site_url();?>/kesebelasan/upload_logo">
            <div class="row">
                <div class="col-lg-10">
                    <input type="file" name="logo" class="form-control">
                </div>
                <div class="col-lg-2">
                <input type="submit" value="Upload Logo (Images)" class="btn btn-primary">
                </div>
            </div>
            
        </form>
        
    </div>
</div>

