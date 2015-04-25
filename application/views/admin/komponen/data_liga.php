    <div class="row">
        <div class="col-lg-12">
           <label><h3><span class="glyphicon glyphicon-globe"></span> List Liga UTama</h3></label>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-8 well">
            <center>
                <h4>List Liga di UKM Bola UTama</h4>
            </center>
            
            <a href="<?php echo site_url();?>/admin/liga/tambah">
                <button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus-sign"></span> Tambahkan Liga</button>    
            </a>
            <p>
            <div class="well">
            <?php
            $site = site_url();
            if($data_liga!=NULL){
                echo '<table class="table table-stripped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID Liga</th>';
                echo '<th>Nama Liga</th>';
                echo '<th>Tahun Pelaksanaan</th>';
                echo '<th style="width:100px;">Aksi</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($data_liga as $row){
                    echo '<tr>';
                    echo '<td>'.$row->id.'</td>';
                    echo '<td>'.$row->nama_liga.'</td>';
                    echo '<td>'.$row->tahun.'</td>';
                    echo '<td>'
//                         .'<button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-list-alt"></span></button> '
//                         .'<button class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></button> '
                         .'<a href="'.$site.'/admin/liga/delete/'.$row->id.'">'
                         . '<button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button> '
                         .'</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            }else{
                echo "empty";
            }
            ?>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>