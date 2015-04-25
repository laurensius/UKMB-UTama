<div class="row">
    <div class="col-lg-12">
        <?php 
        $site = site_url();
        if($message=="OK"){
            echo '<div class="alert alert-info"><b>Sukses...!</b> Untuk login silahkan  <b><a href="'.$site.'/kesebelasan/login">klik di sini!</a></b> </div>';

        }else
        if($message=="FAILED"){
            echo '<div class="alert alert-danger"><b>Whoopps...!</b> Nampaknya ada masalah saat registrasi, silahkan coba lagi</div>';
        }else{
            echo '<div class="alert alert-info"><b>Salam Olahraga...!</b> Silahkan registrasi pada form berikut ini!</div>';
        }
        ?>
        <form action="<?php echo site_url();?>/site/submit_registrasi" method="post">
            <h3>Formulir Registrasi <div id="namaliga"></div></h3>
        <div id="idliga"></div>    
        <label>Username :</label>
        <input type="text" class="form-control" name="username" required>
        <br>
        <label>Password :</label>
        <input type="password" class="form-control" name="password" required>
        <br>
        <label>Email : </label>
        <input type="text" class="form-control" name="email" required>
        <br>
        <label>Nama Kesebelasan :</label>
        <input type="text" class="form-control" name="nama_kesebelasan" required>
        <br>
        <label>Nama Manager :</label>
        <input type="text" class="form-control" name="nama_manager" required>
        <br>
        <div class="row">
            <div class="col-lg-6">
                <input type="reset" value="Batal" class="btn btn-warning form-control">
            </div>
            <div class="col-lg-6" id="btn_submit">
                <input type="submit" value="Daftar" class="btn btn-primary form-control">
            </div>
        </div>
        </form>
    </div>
</div>

    