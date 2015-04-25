    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href=""> Administrator UKM Bola UTama</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Menu / Navigasi</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <?php
                if($this->uri->segment(2)=="index" || $this->uri->segment(2)=="" || $this->uri->segment(2)=="dashboard"){
                    $r_beranda = "class=\"active\"";
                    $r_liga = "";
                    $r_kelola_jadwal = "";
                    $r_kelola_hasil = "";
                }else
                if($this->uri->segment(2)=="liga"){
                    $r_beranda = "";
                    $r_liga = "class=\"active\"";
                    $r_kelola_jadwal = "";
                    $r_kelola_hasil = "";
                }else
                if($this->uri->segment(2)=="kelola_jadwal"){
                    $r_beranda = "";
                    $r_liga = "";
                    $r_kelola_jadwal = "class=\"active\"";
                    $r_kelola_hasil = "";
                }else
                if($this->uri->segment(2)=="kelola_hasil"){
                    $r_beranda = "";
                    $r_liga = "";
                    $r_kelola_jadwal = "";
                    $r_kelola_hasil = "class=\"active\"";
                }
                ?>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                       
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="<?php echo site_url();?>/kesebelasan/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="container-fluid" style="margin-top: 60px;">
            <?php echo $isi_body;?>
        </div>
        
        <script type="text/javascript">
        var data_current = <?php echo json_encode($data_current_kesebelasan);?>;
        //alert(data_current[0].logo);
        document.getElementById("logo").innerHTML = '<img src="<?php echo base_url();?>upload/'+data_current[0].logo +'" class="img-thumbnail">';
        </script>
