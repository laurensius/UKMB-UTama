<div id="data_kelasemen">

</div>
<script>
    var data_kelasemen = <?php echo json_encode($data_kelasemen); ?>;
    var str = '';
    //alert(data_kelasemen.length);
    
    str += '<table class="table">';
    str += '<thead>';
    str += '<tr>';
    str += '<th>ID KESEBELASAN</th>';
    str += '<th>NAMA KESEBELASAN</th>';
    str += '<th>MAIN</th>';
    str += '<th>MENANG</th>';
    str += '<th>KALAH</th>';
    str += '<th>SERI</th>';
    str += '</tr>';
    str += '</thead>';
    str += '<tbody>';
    var x;
    for(x=0;x<data_kelasemen.length;x++){
        str += '<tr><td>' + data_kelasemen[x].id_kesebelasan + 
                '</td><td>' + data_kelasemen[x].nama_kesebelasan + 
                '</td><td>' + data_kelasemen[x].main + 
                '</td><td>' + data_kelasemen[x].menang + 
                '</td><td>' + data_kelasemen[x].kalah + 
               '</td><td>' + data_kelasemen[x].seri + '</td></tr>' ; 
    }
    str += '</tbody>';
    str += '</table>';
    document.getElementById("data_kelasemen").innerHTML = str;
</script>