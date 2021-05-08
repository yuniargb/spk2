<?php
include 'config.php';
// ========================
$rows = $db->get_results("SELECT kode_alternatif, nama_alternatif FROM tb_alternatif ORDER BY kode_alternatif");
foreach($rows as $row){
    $ALTERNATIF[$row->kode_alternatif] = $row->nama_alternatif;
}

$rows = $db->get_results("SELECT kode_kriteria, nama_kriteria, atribut, bobot FROM tb_kriteria ORDER BY kode_kriteria");
foreach($rows as $row){
    $KRITERIA[$row->kode_kriteria] = array(
        'nama_kriteria'=>$row->nama_kriteria,
        'atribut'=>$row->atribut,
        'bobot'=>$row->bobot
    );
}

// ===========================
// AHP
$nRI = array (
    1=>0,
    2=>0,
    3=>0.58,
    4=>0.9,
    5=>1.12,
    6=>1.24,
    7=>1.32,
    8=>1.41,
    9=>1.46,
    10=>1.49,
    11=>1.51,
    12=>1.48,
    13=>1.56,
    14=>1.57,
    15=>1.59
);

// AHP KRITERIA

function get_rel_kriteria(){
    global $db;
    $rows = $db->get_results("SELECT kode_rel_kriteria, kode_kriteria, nilai FROM tb_rel_kriteria ORDER BY kode_rel_kriteria, kode_kriteria");
    $arr = array();
    foreach($rows as $row){
        $arr[$row->kode_rel_kriteria][$row->kode_kriteria] = $row->nilai;
    }
    return $arr;
}

function AHP_get_nilai_option($selected = ''){
    $nilai = array(
        '1' => 'Sama penting dengan',
        '2' => 'Mendekati sedikit lebih penting dari',
        '3' => 'Sedikit lebih penting dari',
        '4' => 'Mendekati lebih penting dari',
        '5' => 'Lebih penting dari',
        '6' => 'Mendekati sangat penting dari',
        '7' => 'Sangat penting dari',
        '8' => 'Mendekati mutlak dari',
        '9' => 'Mutlak sangat penting dari',
    );
    foreach($nilai as $key => $value){
        if($selected==$key)
            $a.="<option value='$key' selected>$key - $value</option>";
        else
            $a.= "<option value='$key'>$key - $value</option>";
    }
    return $a;
}
function get_kolom_total($matriks = array()){
    $total = array();        
    foreach($matriks as $key => $value){
        foreach($value as $k => $v){
            $total[$k]+=$v;
        }
    }  
    return $total;
}
function AHP_normalize($matriks = array(), $total = array()){
          
    foreach($matriks as $key => $value){
        foreach($value as $k => $v){
            $matriks[$key][$k] = $matriks[$key][$k]/$total[$k];
        }
    }     
    return $matriks;       
}

function AHP_get_rata($normal){
    $rata = array();
    foreach($normal as $key => $value){
        $rata[$key] = array_sum($value)/count($value); 
    } 
    return $rata;   
}

function AHP_consistency_measure($matriks, $rata){
    $matriks = AHP_mmult($matriks, $rata);    
    foreach($matriks as $key => $value){
        $data[$key]=$value/$rata[$key];        
    }
    return $data;
}

function AHP_mmult($matriks = array(), $rata = array()){
    $data = array();
    
    $rata = array_values($rata);
    
    foreach($matriks as $key => $value){
        $no=0;
        foreach($value as $k => $v){
            $data[$key]+=$v*$rata[$no];       
            $no++;  
        }               
    }  
    
    return $data;
}
// ==============================//


$SAW_crips = SAW_get_crips();

function get_rank($array){
    $data = $array;
    arsort($data);
    $no=1;
    $new = array();
    foreach($data as $key => $value){
        $new[$key] = $no++;
    }
    return $new;
}

function SAW_get_crips(){
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_nilai_kriteria ORDER BY kode_nilai_kriteria");
    $data= array();
    foreach($rows as $row){
        $data[$row->kode_nilai_kriteria] = $row;
    }
    return $data;
}

function SAW_get_rel(){
    global $db;
    $rows = $db->get_results("SELECT a.kode_alternatif, k.kode_kriteria, c.kode_nilai_kriteria
        FROM tb_alternatif a 
        	INNER JOIN tb_rel_alternatif ra ON ra.kode_alternatif=a.kode_alternatif
        	INNER JOIN tb_kriteria k ON k.kode_kriteria=ra.kode_kriteria
        	LEFT JOIN tb_nilai_kriteria c ON c.kode_nilai_kriteria=ra.kode_nilai_kriteria
        ORDER BY a.kode_alternatif, k.kode_kriteria");
    $data = array();
    foreach($rows as $row){
        $data[$row->kode_alternatif][$row->kode_kriteria] = $row->kode_nilai_kriteria;
    }
    return $data;
}

function SAW_step1($echo=true){
    global $db, $ALTERNATIF, $KRITERIA, $SAW_crips;
    
    
    $data = SAW_get_rel();
    
    if(!$echo)
        return $data;
        
    $r.= "<tr><th></th>";   	
    $no=1;	
    foreach($data[key($data)] as $key => $value){
        $r.= "<th>". $key ." - ". $KRITERIA[$key][nama_kriteria]."</th>";
        $no++;      
    }    
    
    $no=1;	
    foreach($data as $key => $value){
        $r.= "<tr>";
        $r.= "<th>". $key ." - " .$ALTERNATIF[$key]."</th>";
        foreach($value as $k => $v){
            $r.= "<td>".$SAW_crips[$v]->keterangan."</td>";
        }        
        $r.= "</tr>";
        $no++;    
    }    
    $r.= "</tr>";
    return $r;
}

function SAW_step2($echo=true){
    global $db, $ALTERNATIF, $KRITERIA, $SAW_crips;
    
    $data = SAW_get_rel();
    
    if(!$echo)
        return $data;
        
    $r.= "<tr><th></th>";   	
    $no=1;	
    foreach($data[key($data)] as $key => $value){
        $r.= "<th>". $key ." - ".$KRITERIA[$key]['nama_kriteria']."</th>";
        $no++;      
    }    
    
    $no=1;	
    foreach($data as $key => $value){
        $r.= "<tr>";
        $r.= "<th>". $key ." - ".$ALTERNATIF[$key]."</th>";
        foreach($value as $k => $v){
            $r.= "<td>".$SAW_crips[$v]->nilai."</td>";
        }        
        $r.= "</tr>";
        $no++;    
    }    
    $r.= "</tr>";
    return $r;
}

function SAW_nomalize($array, $max = true){
    global $KRITERIA;
    $crips = SAW_get_crips();
    $data = array();
    $mm = array();
            
    foreach($array as $key => $value){
        $temp = array();        
        foreach($value as $k => $v){
            $mm[$k][] = $crips[$v]->nilai;
        }
    }
    
    foreach($array as $key => $value){                
        foreach($value as $k => $v){
            if($KRITERIA[$k]['atribut']=='benefit')
                $data[$key][$k] = $crips[$v]->nilai / max($mm[$k]);
            else
                $data[$key][$k] = min($mm[$k]) / $crips[$v]->nilai;
        }
    }
    return $data;
}

function get_kriteria_option($selected = 0){
    global $KRITERIA;  
    print_r($KRITERIA);
    foreach($KRITERIA as $key => $value){
        if($key==$selected)
            $a.="<option value='$key' selected>$value[nama_kriteria]</option>";
        else
            $a.="<option value='$key'>$value[nama_kriteria]</option>";
    }
    return $a;
}

function get_bobot_option($selected = ''){
    global $NILAI;    
    foreach($NILAI as $key => $value){
        if($selected==$key)
            $a.="<option value='$key' selected>$key - $value</option>";
        else
            $a.= "<option value='$key'>$key - $value</option>";
    }
    return $a;
}

function get_atribut_option($selected = ''){
    $atribut = array('benefit'=>'Benefit', 'cost'=>'Cost');   
    foreach($atribut as $key => $value){
        if($selected==$key)
            $a.="<option value='$key' selected>$value</option>";
        else
            $a.= "<option value='$key'>$value</option>";
    }
    return $a;
}

function hitung($normal){
    global $KRITERIA;
    $data = array();
    foreach($normal as $key => $value){
        $tot=0;
        foreach($value as $k => $v){                           
            $tot+=$v * $KRITERIA[$k]['bobot']; 
        }        
        $data[$key]= $tot;
    }  
    return $data;
}