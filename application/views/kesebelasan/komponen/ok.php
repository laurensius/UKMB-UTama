<div class="row">
    <div class="col-lg-12">
        <label>
            <h2>
                Detail <?php echo $this->session->userdata('s_k_nama_kesebelasan'); ?>
                <!--a href="<?php echo site_url();?>/kesebelasan/add_pemain" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-plus-sign"></span>Tambah Pemain
                </a-->
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
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
          <li class="active"><a href="#home" data-toggle="tab">Daftar Pemain <?php echo $this->session->userdata('s_k_nama_kesebelasan'); ?></a></li>
          <li><a href="#jadwal" data-toggle="tab">Jadwal <?php echo $this->session->userdata('s_k_nama_kesebelasan'); ?></a></li>
          <li><a href="#profile" data-toggle="tab">Kelasemen Liga Saat Ini</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="home"><div id="list_anggota"></div></div>
          <div class="tab-pane" id="profile"><div id="data_kelasemen_baru"></div></div>
          <div class="tab-pane" id="jadwal"><div id="list_jadwal"></div></div></div>
        </div>
        
        <script>
        var data_anggota = <?php echo json_encode($data_anggota);?>;
        var str = '';
        var url_add = "<?php echo site_url();?>/kesebelasan/add_anggota";
        if(data_anggota.length === 0){
            str += '<div class="alert alert-info">';
            str += 'Silahkan input data anggota kesebelasan';
            str += '<a href="' + url_add + '"><b> di sini! </b></a>';
            str += '</div>';
        }else
        if(data_anggota.length >0){
            str += '<a class="btn btn-primay" href="' + url_add + '"><span class="glyphicon glyphicon-plus"></span><b> Input Anggota Kesebelasan! </b></a>';
            str += '<br>';
            str += '<table class="table table-hover">';
            str += '<thead>';
            str += '<tr>';
            str += '<th>Nama Anggota</th>';
            str += '<th>Posisi</th>';
            str += '<th>No Punggung</th>';
            str += '<th></th>';
            str += '</tr>';
            str += '</thead>';
            str += '<tbody>';
            for(x=0;x<data_anggota.length;x++){
                str += '<tr>';
                str += '<td>' + data_anggota[x].nama + '</td>';
                str += '<td>' + data_anggota[x].posisi + '</td>';
                str += '<td>' + data_anggota[x].no_punggung + '</td>';
                if(data_anggota[x].is_captain === '1'){
                    str += '<td> (C) </td>';
                }else{
                    str += '<td>  </td>';
                }
                str += '</tr>';
            }
            str += '</tbody>';
            str += '</table>';
        }
        document.getElementById("list_anggota").innerHTML = str;
        </script>
        
        
        
        <script>
            var data_kesebelasan = <?php echo json_encode($data_kesebelasan); ?>;
            var data_kelasemen = <?php echo json_encode($data_kelasemen); ?>;
            var data_jadwal = <?php echo json_encode($data_jadwal); ?>;
            var str = '';
            var data_kelasemen_baru;
            var c = 0;
            var id_kesebelasan = '';
            var nama_kesebelasan = ''; 
            var main =  '';
            var menang =  ''; 
            var kalah = ''; 
            var seri =  ''; 
            var jml_gol =  ''; 
            var point =  '';

            if(data_kesebelasan.length > 0){
                for(x=0;x<data_kelasemen.length-1;x++){
                    for(y=x+1;y<data_kelasemen.length;y++){
                        if(data_kelasemen[x].point < data_kelasemen[y].point || data_kelasemen[x].jml_gol < data_kelasemen[y].jml_gol ){
                            id_kesebelasan      = data_kelasemen[x].id_kesebelasan;
                            nama_kesebelasan    = data_kelasemen[x].nama_kesebelasan; 
                            main                = data_kelasemen[x].main;
                            menang              = data_kelasemen[x].menang; 
                            kalah               = data_kelasemen[x].kalah; 
                            seri                = data_kelasemen[x].seri; 
                            jml_gol             = data_kelasemen[x].jml_gol; 
                            point               = data_kelasemen[x].point;
                            //--
                            data_kelasemen[x].id_kesebelasan    = data_kelasemen[y].id_kesebelasan;
                            data_kelasemen[x].nama_kesebelasan  = data_kelasemen[y].nama_kesebelasan; 
                            data_kelasemen[x].main              = data_kelasemen[y].main;
                            data_kelasemen[x].menang            = data_kelasemen[y].menang; 
                            data_kelasemen[x].kalah             = data_kelasemen[y].kalah; 
                            data_kelasemen[x].seri              = data_kelasemen[y].seri; 
                            data_kelasemen[x].jml_gol           = data_kelasemen[y].jml_gol; 
                            data_kelasemen[x].point             = data_kelasemen[y].point;
                            //--
                            data_kelasemen[y].id_kesebelasan    = id_kesebelasan;
                            data_kelasemen[y].nama_kesebelasan  = nama_kesebelasan; 
                            data_kelasemen[y].main              = main;
                            data_kelasemen[y].menang            = menang; 
                            data_kelasemen[y].kalah             = kalah; 
                            data_kelasemen[y].seri              = seri; 
                            data_kelasemen[y].jml_gol           = jml_gol; 
                            data_kelasemen[y].point             = point;
                            //--
                        }
                    }
                }

                //alert(data_kelasemen);
                str = '';
                str += '<table class="table table-hover">';
                str += '<thead>';
                str += '<tr>';
                //str += '<th>ID KESEBELASAN</th>';
                str += '<th>KESEBELASAN</th>';
                str += '<th>MAIN</th>';
                str += '<th>MENANG</th>';
                str += '<th>KALAH</th>';
                str += '<th>SERI</th>';
                str += '<th>GOL</th>';
                str += '<th>POINT</th>';
                str += '</tr>';
                str += '</thead>';
                str += '<tbody>';
                for(x=0;x<data_kelasemen.length;x++){

                    var terdaftar_di_jadwal = 0;
                        for(aa=0;aa<data_jadwal.length;aa++){
                            if(data_kesebelasan[x].id === data_jadwal[aa].id_kesebelasan_1 || data_kesebelasan[x].id === data_jadwal[aa].id_kesebelasan_2){
                                terdaftar_di_jadwal++;    
                            }
                        }

                        if(terdaftar_di_jadwal > 0){
                            var logo = '';
                            for(w=0;w<data_kesebelasan.length;w++){
                                if(data_kesebelasan[w].id===data_kelasemen[x].id_kesebelasan){
                                    logo = '<img width=16 src="<?php echo base_url(); ?>upload/'+data_kesebelasan[w].logo+'">';
                                }
                            }
                            
                            str += '' + 
                            '</td><td>' + logo + ' ' + data_kelasemen[x].nama_kesebelasan + 
                            '</td><td>' + data_kelasemen[x].main + 
                            '</td><td>' + data_kelasemen[x].menang + 
                            '</td><td>' + data_kelasemen[x].kalah + 
                            '</td><td>' + data_kelasemen[x].seri + 
                            '</td><td>' + data_kelasemen[x].jml_gol + 
                            '</td><td>' + data_kelasemen[x].point + '</td></tr>' ; 
                        }
                }
                str += '</tbody>';
                str += '</table>';
                document.getElementById("data_kelasemen_baru").innerHTML = str;
            }else{
                document.getElementById("data_kelasemen_baru").innerHTML = 'TIDAK ADA HASIL PERTANDINGAN TERDAFTAR DI DATABASE';
            }
        </script>
        
        
        
        <script>
                var data_liga = <?php echo json_encode($data_liga); ?>;
                var idliga = data_liga[0].id;
                var namaliga = data_liga[0].nama_liga;

                var data_jadwal = <?php echo json_encode($data_jadwal); ?>;
                var data_kesebelasan = <?php echo json_encode($data_kesebelasan); ?>;
                var i,j;
                var waktu_tempat;
                var str = "";


                if(data_jadwal.length > 0){
                    str = '';
                    str += '<table class="table table-hover">';
                    str += '<thead>';
                    str += '<tr>';
                    str += '<th>PERTANDINGAN ANTARA ..... vs ..... </th>';
                    str += '<th>WAKTU - TEMPAT</th>';
                    str += '</tr>';
                    str += '</thead>';
                    str += '<tbody>';
                    for(i = 0;i<data_jadwal.length;i++){
                        if(data_jadwal[i].id_liga===idliga && 
                            (data_jadwal[i].id_kesebelasan_1==="<?php echo $this->session->userdata('s_k_id')?>" ||
                             data_jadwal[i].id_kesebelasan_2==="<?php echo $this->session->userdata('s_k_id')?>")){
                            var nama_kesebelasan_1;
                            var nama_kesebelasan_2;
                            for(j = 0;j<data_kesebelasan.length;j++){
                                if(data_jadwal[i].id_kesebelasan_1===data_kesebelasan[j].id){
                                    nama_kesebelasan_1 = data_kesebelasan[j].nama_kesebelasan;
                                    var logo_1 = '<img width=16 src="<?php echo base_url(); ?>upload/'+data_kesebelasan[j].logo+'">';
                                }
                                if(data_jadwal[i].id_kesebelasan_2===data_kesebelasan[j].id){
                                    nama_kesebelasan_2 = data_kesebelasan[j].nama_kesebelasan;
                                    var logo_2 = '<img width=16 src="<?php echo base_url(); ?>upload/'+data_kesebelasan[j].logo+'">';
                                }                                
                            }
                            waktu_tempat = data_jadwal[i].waktu_tempat;
                            str = str + "<tr><td><b>" + nama_kesebelasan_1 + "</b> " + logo_1 + " vs " + logo_2 + "  <b>" + nama_kesebelasan_2 + "</b></td><td>" + waktu_tempat + "</td></tr>";
                        }
                    }    
                    str += '</tbody>';
                    str += '</table>'; 
                }else{
                    str = str + '<tr><td colspan="2">TIDAK ADA JADWAL PERTANDINGAN TERDAFTAR DI DATABASE</td></tr>';    
                } 
                document.getElementById("list_jadwal").innerHTML = str;

        </script>
    </div>
</div>

