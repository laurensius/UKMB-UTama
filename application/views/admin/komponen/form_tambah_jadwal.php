    <div class="row">
        <div class="col-lg-12">
           <label><h3><span class="glyphicon glyphicon-globe"></span> Tambah Jadwal Liga UTama</h3></label>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-8 well">
            <center>
                <h4>Tambah Jadwal Liga di UKM Bola UTama</h4>
            </center>
            
            <a href="<?php echo site_url();?>/admin/kelola_jadwal/liga/">
                <button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-backward"></span> Kembali ke List Jadwal Liga</button>    
            </a>
            <br>
            <br>
            <form action="<?php echo site_url();?>/admin/kelola_jadwal/liga/insert" method="post">
                <select id="list_liga" class="form-control" onchange="tampilKesebelasan_1(this);">
                    <?php
                    $site = site_url();
                    if($data_liga!=NULL){
                        echo '<option value="0">Pilih Liga </option>';
                        foreach($data_liga as $row_liga){
                            echo '<option value="'.$row_liga->id.'">'.$row_liga->nama_liga.'</option>';
                        }
                    }else{
                        echo '<option value="0">Tidak ada Liga tersimpan di Database. Terima Kasih.</option>';
                    }
                    ?>
                </select>
                <p>
                <div class="well">
                    <label>Nama Liga</label>
                    <div id="nama_liga">
                        <input type="text" value="Pilih Liga" class="form-control" disabled>
                    </div>
                    <div id="id_liga"></div>
                    <br>
                    <label>Kesebelasan 1</label>
                    <select id="k_1" name="id_kesebelasan_1" class="form-control" onchange="tampilKesebelasan_2(this);">
                        <option>Pilih Kesebelasan 1</option>
                    </select>
                    <br>
                    <label>Melawan</label>
                    <select id="k_2" name="id_kesebelasan_2" class="form-control">
                        <option>Pilih Kesebelasan 2</option>
                    </select>
                    <br>
                    <label>Waktu Tempat</label>
                    <textarea id="w_k" name="waktu_tempat" class="form-control"></textarea>
                    <br>
                    <center>
                        <input type="reset" class="btn btn-warning" value="Reset">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </center>
                </div>
            </form>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <script>
        function tampilKesebelasan_1(x){
            document.getElementById("k_1").innerHTML = "";
            document.getElementById("k_2").innerHTML = '<option value="0">Pilih Kesebelasan 2</option>';
            var terpilih = x.options[x.selectedIndex].value;
            var data_kesebelasan = <?php echo json_encode($data_kesebelasan); ?>;  
            var i;
            var str = '<option value="0">Pilih Kesebelasan 1</option>';
            for(i=0;i<data_kesebelasan.length;i++){
                if(data_kesebelasan[i].id_liga === terpilih){
                    str = str + '<option value="'+data_kesebelasan[i].id+'">'+data_kesebelasan[i].nama_kesebelasan+'</option>';
                }
            }
            document.getElementById("k_1").innerHTML = str;
            document.getElementById("nama_liga").innerHTML = '<input type="text" value="' + x.options[x.selectedIndex].text + '" class="form-control" disabled>';
            document.getElementById("id_liga").innerHTML = '<input type="hidden" value="' + x.options[x.selectedIndex].value + '" name="id_liga">';
        }
        
        function tampilKesebelasan_2(y){
            var terpilih = y.options[y.selectedIndex].value;
            var data_kesebelasan = <?php echo json_encode($data_kesebelasan); ?>;  
            var i;
            var str = '<option value="0">Pilih Kesebelasan 2</option>';
            for(i=0;i<data_kesebelasan.length;i++){
                if(data_kesebelasan[i].id !== terpilih && terpilih !== 0){
                    str = str + '<option value="'+data_kesebelasan[i].id+'">'+data_kesebelasan[i].nama_kesebelasan+'</option>';
                }
            }
            document.getElementById("k_2").innerHTML = str;
        }
    </script>