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
                        <!--li <?php echo $r_beranda;?>><a href="<?php echo site_url();?>/admin/index"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li-->
                        <li <?php echo $r_liga;?>><a href="<?php echo site_url();?>/admin/liga"><span class="glyphicon glyphicon-globe"></span> Kelola Liga</a></li>
                        <li <?php echo $r_kelola_jadwal;?>><a href="<?php echo site_url();?>/admin/kelola_jadwal/liga"><span class="glyphicon glyphicon-calendar"></span> Kelola Jadwal Liga</a></li>
                        <li <?php echo $r_kelola_hasil;?>><a href="<?php echo site_url();?>/admin/kelola_hasil/liga"><span class="glyphicon glyphicon-list-alt"></span> Kelola Hasil Pertandingan</a></li>
                        <!--li class="dropdown <?php echo $r_kelola_jadwal;?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-calendar"></span> Kelola Jadwal<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url();?>/admin/kelola_jadwal/liga">Jadwal Pertandingan Liga</a></li>
                                <li><a href="<?php echo site_url();?>/admin/kelola_jadwal/timnas">jadwal Pertandingan Timnas</a></li>
                            </ul>
                        </li>
                        <li class="dropdown <?php echo $r_kelola_hasil;?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Kelola Hasil<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url();?>/admin/kelola_hasil/liga">Hasil Pertandingan Liga</a></li>
                                <li><a href="<?php echo site_url();?>/admin/kelola_hasil/timnas">Hasil Pertandingan Timnas</a></li>
                            </ul>
                        </li-->
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="<?php echo site_url();?>/admin/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="container-fluid" style="margin-top: 60px;">
            <?php echo $isi_body;?>
        </div>
