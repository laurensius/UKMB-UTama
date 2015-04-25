<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_Hasil extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    function get_all_hasil(){
        $query = $this->db->get("hasil");
        return $query->result();
    }
    
    function insert_hasil($insert){
        $hasil = $this->db->insert("hasil",$insert);
        return $hasil;
    }
    
    function kelasemen(){
        $query_data_kesebelasan = $this->db->query("select id, nama_kesebelasan from kesebelasan");
        $ret = array();
        $ctr = 0;
        foreach ($query_data_kesebelasan->result() as $row_data_kesebelasan){  
            $ret[$ctr]["id_kesebelasan"] = $row_data_kesebelasan->id;
            $ret[$ctr]["nama_kesebelasan"] = $row_data_kesebelasan->nama_kesebelasan;
            $jml_gol_menang = "";
            $jml_gol_kalah = "";
            $jml_gol_seri = "";
            
            $query_menang = $this->db->query("select count(*) as hasil_menang, skor_kesebelasan_1, skor_kesebelasan_2 from hasil where menang='$row_data_kesebelasan->id'");
            foreach ($query_menang->result() as $row_query_menang){
                $menang = $row_query_menang->hasil_menang;
                $ret[$ctr]["menang"] = $menang;
                if($row_query_menang->skor_kesebelasan_1 > $row_query_menang->skor_kesebelasan_2){
                    $jml_gol_menang = $row_query_menang->skor_kesebelasan_1;
                }else
                if($row_query_menang->skor_kesebelasan_1 < $row_query_menang->skor_kesebelasan_2){
                    $jml_gol_menang = $row_query_menang->skor_kesebelasan_2;
                }
            }

            $query_kalah = $this->db->query("select count(*) as hasil_kalah, skor_kesebelasan_1, skor_kesebelasan_2 from hasil where kalah='$row_data_kesebelasan->id'");
            foreach ($query_kalah->result() as $row_query_kalah){
                $kalah = $row_query_kalah->hasil_kalah;
                $ret[$ctr]["kalah"] = $kalah;
                if($row_query_kalah->skor_kesebelasan_1 > $row_query_kalah->skor_kesebelasan_2){
                    $jml_gol_kalah = $row_query_kalah->skor_kesebelasan_2;
                }else
                if($row_query_kalah->skor_kesebelasan_1 < $row_query_kalah->skor_kesebelasan_2){
                    $jml_gol_kalah = $row_query_kalah->skor_kesebelasan_1;
                }
            }

            $query_seri = $this->db->query("select count(*) as hasil_seri, skor_kesebelasan_1 from hasil where seri_kesebelasan_1='$row_data_kesebelasan->id' or seri_kesebelasan_2='$row_data_kesebelasan->id'");
            foreach ($query_seri->result() as $row_query_seri){
                $seri = $row_query_seri->hasil_seri;
                $ret[$ctr]["seri"] = $seri;
                $jml_gol_seri = $row_query_seri->skor_kesebelasan_1;
            }

           
            $ret[$ctr]["main"] = $menang + $kalah + $seri; 
            $ret[$ctr]["point"] =  ($menang * 3) + ($kalah * 0) + ($seri * 1);
            $ret[$ctr]["jml_gol"] =  $jml_gol_menang + $jml_gol_kalah + $jml_gol_seri;
            $ctr++;
        }
        return $ret;
    }    
    
     
}

