    <div class="row">
        <div class="col-lg-12">
           <label><h3><span class="glyphicon glyphicon-globe"></span> List Jadwal Liga UTama</h3></label>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-8 well">
            <center>
                <h4>List Jadwal Liga di UKM Bola UTama</h4>
            </center>
            
            <a href="<?php echo site_url();?>/admin/kelola_jadwal/liga/tambah">
                <button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus-sign"></span> Tambahkan Jadwal Liga</button>    
            </a>
            <br>
            <br>
            <select id="list_liga" class="form-control" onchange="tampilJadwal(this);">
                <?php
                $site = site_url();
                if($data_liga!=NULL){
                    echo '<option value="0">Pilih Liga </option>';
                    foreach($data_liga as $row_liga){
                        echo '<option value="'.$row_liga->id.'">'.$row_liga->nama_liga.'</option>';
                    }
                }else{
                    echo "empty";
                }
                ?>
            </select>
            <p>
            <div class="well" id="hasil">
            
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <script>
        function tampilJadwal(x){
            var terpilih = x.options[x.selectedIndex].value;
            var data_jadwal = <?php echo json_encode($data_jadwal); ?>;
            var data_kesebelasan = <?php echo json_encode($data_kesebelasan); ?>;
            var i,j;
            var waktu_tempat;
            var str = "";
            for(i = 0;i<data_jadwal.length;i++){
                if(data_jadwal[i].id_liga===terpilih){
                    var nama_kesebelasan_1;
                    var nama_kesebelasan_2;
                    for(j = 0;j<data_kesebelasan.length;j++){
                        if(data_jadwal[i].id_kesebelasan_1===data_kesebelasan[j].id){
                            nama_kesebelasan_1 = data_kesebelasan[j].nama_kesebelasan;
                        }
                        if(data_jadwal[i].id_kesebelasan_2===data_kesebelasan[j].id){
                            nama_kesebelasan_2 = data_kesebelasan[j].nama_kesebelasan;
                        }
                        
                    }
                    waktu_tempat = data_jadwal[i].waktu_tempat;
                    str = str + "<p><b>" + nama_kesebelasan_1 + "</b> vs <b>" + nama_kesebelasan_2 + "</b> <br>" + waktu_tempat + "<br>";
                }
            }
            document.getElementById("hasil").innerHTML = str;
        }
    </script>