    <div class="row">
        <div class="col-lg-12">
           <label><h3><span class="glyphicon glyphicon-globe"></span> Tambah Liga UTama</h3></label>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-8 well">
            <center>
                <h4>Tambah Liga di UKM Bola UTama</h4>
            </center>
            
            <a href="<?php echo site_url();?>/admin/liga">
                <button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-backward"></span> Kembali ke List Liga</button>    
            </a>
            <p>
            <div class="well">
                <form action="<?php echo site_url();?>/admin/liga/insert" method="post">
                    <label>Nama Liga</label>
                    <input type="text" name="nama_liga" required class="form-control" placeholder="Nama Liga">
                    <br>
                    <label>Tahun</label>
                    <input type="text" name="tahun" required class="form-control" placeholder="Tahun Pelaksanaan">
                    <br>
                    <label>Keterangan</label>
                    <textarea name="keterangan" style="height:120px;" placeholder="Keterangan" required class="form-control"></textarea>
                    <br>
                    <center>
                        <input type="reset" class="btn btn-warning" value="Reset">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </center>
                </form>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>