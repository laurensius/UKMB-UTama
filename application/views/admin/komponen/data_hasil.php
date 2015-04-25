    <div class="row">
        <div class="col-lg-12">
           <label><h3><span class="glyphicon glyphicon-globe"></span> List Hasil Pertandingan Liga UTama</h3></label>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-8 well">
            <center>
                <h4>Hasil Pertandingan Liga di UKM Bola UTama</h4>
            </center>
            
            <a href="<?php echo site_url();?>/admin/kelola_hasil/liga/tambah">
                <button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus-sign"></span> Tambahkan Hasil Pertandingan</button>    
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
            <br>
            <select id="list_jadwal" class="form-control" onchange="tampilHasil(this);"></select>  
            <p>
            <div class="well" id="hasil"></div>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <script>
        function tampilJadwal(x){
            var terpilih = x.options[x.selectedIndex].value;
            var data_jadwal = <?php echo json_encode($data_jadwal); ?>;
            var data_kesebelasan = <?php echo json_encode($data_kesebelasan); ?>;
            var data_hasil = <?php echo json_encode($data_hasil); ?>;
            var i,j,k;
            var str = '<option>Pilih Jadwal</option>';
            var k_1 = "";
            var k_2 = "";
            
            var q = "";
            for(i=0;i<data_jadwal.length;i++){
                if(data_jadwal[i].id_liga===terpilih){
                    for(j=0;j<data_kesebelasan.length;j++){
                        if(data_jadwal[i].id_kesebelasan_1 === data_kesebelasan[j].id){
                            k_1 = data_kesebelasan[j].nama_kesebelasan;
//                            var logo_1 = '<img width=16 src="<?php echo base_url(); ?>upload/'+data_kesebelasan[j].logo+'">';
                        }
                        if(data_jadwal[i].id_kesebelasan_2 === data_kesebelasan[j].id){
                            k_2 = data_kesebelasan[j].nama_kesebelasan;
//                            var logo_1 = '<img width=16 src="<?php echo base_url(); ?>upload/'+data_kesebelasan[j].logo+'">';
                        }
                    }
                    for(k=0;k<data_hasil.length;k++){
                        if(data_hasil[k].id_jadwal===data_jadwal[i].id){
                            str = str + '<option value="' + data_jadwal[i].id + '">' + k_1 + " vs " + k_2 + '</option>';
                        }
                    }
                }
            }
            document.getElementById("list_jadwal").innerHTML = str;
        }
        
        function tampilHasil(y){
            var terpilih = y.options[y.selectedIndex].value;
            var text_terpilih = y.options[y.selectedIndex].text;
            var data_hasil = <?php echo json_encode($data_hasil); ?>;
            var i;
            var str = '';
            for(i=0;i<data_hasil.length;i++){
                if(data_hasil[i].id_jadwal === terpilih){
                    str = str + 'Hasil pertandingan antara ' + text_terpilih + ' adalah ' + data_hasil[i].skor_kesebelasan_1 + ' - '  + data_hasil[i].skor_kesebelasan_2 + '<br>'; 
                }
            }
            document.getElementById("hasil").innerHTML = str;
        }
    </script>