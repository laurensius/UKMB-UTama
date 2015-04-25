    <div class="row">
        <div class="col-lg-12">
           <label><h3><span class="glyphicon glyphicon-globe"></span> Tambah Hasil Pertandingan Liga UTama</h3></label>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-8 well">
            <center>
                <h4>Tambah Hasil Pertandingan Liga di UKM Bola UTama</h4>
            </center>
            
            <a href="<?php echo site_url();?>/admin/kelola_hasil/liga/">
                <button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-backward"></span> Kembali ke List Hasil Liga</button>    
            </a>
            <br>
            <br>
            <form action="<?php echo site_url();?>/admin/kelola_hasil/liga/insert" method="post">
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
                <select name="id_jadwal" id="list_jadwal" class="form-control" onchange="tampilFormHasil(this);"></select>  
                <p>
                <div class="row" id="hasil"></div>
                <div class="row" id="hasil_antara"></div>
                <br>
                    <center>
                        <input type="reset" class="btn btn-warning" value="Reset">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </center>
            </form>
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
                        }
                        if(data_jadwal[i].id_kesebelasan_2 === data_kesebelasan[j].id){
                            k_2 = data_kesebelasan[j].nama_kesebelasan;
                        }
                    }
                    var xctr = 0;
                    for(k=0;k<data_hasil.length;k++){
                        if(data_hasil[k].id_jadwal!==data_jadwal[i].id){
                            xctr++;
                        }
                    }
                    if(xctr===data_hasil.length){
                        str = str + '<option value="' + data_jadwal[i].id + '">' + k_1 + " vs " + k_2 + '</option>';
                    }
                }
            }
            document.getElementById("list_jadwal").innerHTML = str;
        }
        
        function tampilFormHasil(y){
            var str = '';
            str +=  '<div class="col-lg-6">';
            str +=  '   <label>Score Kesebelasan 1 </label>';
            str +=  '    <input type="number" name="skor_kesebelasan_1" class="form-control" required>';
            str +=  '</div>';
            str +=  '<div class="col-lg-6">';
            str +=  '   <label>Score Kesebelasan 2 </label>';
            str +=  '   <input type="number" name="skor_kesebelasan_2" class="form-control" required>';
            str +=  '</div>';
            str +=  '<p>';
            str +=  '<div class="col-lg-6">';
            str +=  '   <label>Pencetak Gol Kesebelasan 1 </label>';
            str +=  '    <textarea type="number" name="pencetak_kesebelasan_1" class="form-control" placeholder="Misal : Gigs(18),Messi(90)"></textarea>';
            str +=  '</div>';
            str +=  '<div class="col-lg-6">';
            str +=  '   <label>Pencetak Gol Kesebelasan 2 </label>';
            str +=  '   <textarea name="pencetak_kesebelasan_2" class="form-control" placeholder="Misal : Ronaldo(7,31,66)"></textarea>';
            str +=  '</div>';
            document.getElementById("hasil").innerHTML = str;
            
            
            //------------------
            var data_jadwal = <?php echo json_encode($data_jadwal); ?>;
            var terpilih = y.options[y.selectedIndex].value;
            //alert(terpilih);
            var k_1,k_2;
            for(i=0;i<data_jadwal.length;i++){
                if(data_jadwal[i].id===terpilih){
                    k_1 = data_jadwal[i].id_kesebelasan_1;
                    k_2 = data_jadwal[i].id_kesebelasan_2;
                }
            }
            //alert(k_1 + 'vs' + k_2);
            str = '';
            str += '<input type="hidden" name="id_kesebelasan_1" value="'+k_1+'"><br>';
            str += '<input type="hidden" name="id_kesebelasan_2" value="'+k_2+'"><br>';
            document.getElementById("hasil_antara").innerHTML = str;
        }
    </script>