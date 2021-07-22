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
        'bobot'=>$row->bobot,
        'kode_kriteria'=>$row->kode_kriteria
    );
}
$rows= $db->get_results("SELECT tk.kode_kriteria, tk.nama_kriteria, tk.atribut, tk.bobot FROM tb_kriteria tk INNER JOIN tb_rel_kriteria trk ON tk.kode_kriteria = trk.kode_kriteria WHERE trk.status=1 GROUP BY kode_kriteria ORDER BY kode_kriteria");


foreach($rows as $row){
    $KRITERIA_RES[$row->kode_kriteria] = array(
        'nama_kriteria'=>$row->nama_kriteria,
        'atribut'=>$row->atribut,
        'bobot'=>$row->bobot,
        'kode_kriteria'=>$row->kode_kriteria
    );
}

function get_alternatif($id){
    global $db;
    $rows = $db->get_row("SELECT * FROM tb_alternatif WHERE kode_alternatif ='$id'");
    return $rows;
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
function get_rel_kriteria_res(){
    global $db;
    $rows = $db->get_results("SELECT kode_rel_kriteria, kode_kriteria, nilai FROM tb_rel_kriteria WHERE status = 1 ORDER BY kode_rel_kriteria, kode_kriteria ");
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
    $matrikss = array_values($matriks);
    // var_dump($matriks);
    foreach($matriks as $key => $value){
        foreach($value as $k => $v){
            
            $bawah = array();
            foreach($matrikss as $key2 => $value2){
               
                array_push( $bawah, $matrikss[$key2][$k]);
            }
            $value = array_values($value);
            $totals = baris_normalize($bawah,$value);

            $matriks[$key][$k] = $totals;
        }
    }    
    return $matriks;       
}


function AHP_get_ci($matriks = array(),$prioritas = array()){
    $data = array();
    $matriks = array_values($matriks);
    $prioritas = array_values($prioritas);
    // var_dump($matriks);
    foreach($matriks as $key => $value){

        $data[$key] = $matriks[$key] * $prioritas[$key];
        
    }    
    $ci = (array_sum($data) - count($matriks) ) / (count($matriks) - 1);

    return $ci ;       
}

function baris_normalize($bawah,$samping){
    $total = 0;
    $str = '';
    foreach($samping as $key => $value2){
        $total += $bawah[$key] * $samping[$key]; 
        
    }
   return $total;
}

function AHP_get_rata($normal){
    $rata = array();
    foreach($normal as $key => $value){
        if(count($value) == 1) {
            // echo  $value;
            // echo  array_sum($normal);
            $rata[$key] = $value /array_sum($normal); 
        }
    } 
    // var_dump($rata);
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
            // var_dump($k);
            $data[$key]+=$v*$rata[$no];       
            $no++;  
        }               
    }  
    return $data;
}
function AHP_rata_rata($matriks = array(), $rata = array()){
    $data = array();
    
    // $rata = array_values($rata);
    
    foreach($matriks as $key => $value){
        $no=0;
        foreach($value as $k => $v){
            // var_dump($k);
            $data[$key]+=$v*$rata[$k];       
            $no++;  
        }               
    }  
    return $data;
}

function AHP_get_hasil($matriks, $rata){
    // $matriks = AHP_mmult($matriks, $rata);  
    foreach($matriks as $key => $value){
        $data[$key]=$value+$rata[$key];   
    }
    // var_dump($data);  
    return $data;
}
function AHP_get_jumlah($matriks){ 
    foreach($matriks as $key => $value){
        $data[$key]=array_sum($value);   
    } 
    return $data;
}
// ==============================//

function get_alternatif_option($selected = 0){
    global $ALTERNATIF;  
    foreach($ALTERNATIF as $key => $value){
        print_r($value);
        if($key==$selected)
            $a.="<option value='$key' selected>".$value."</option>";
        else
            $a.="<option value='$key'>".$value."</option>";
    }
    
    return $a;
}

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

function SAW_get_rel($periode = null){
    global $db;
    $q = "SELECT a.kode_alternatif, k.kode_kriteria, ra.nilai_alternatif
    FROM tb_alternatif a 
        INNER JOIN tb_rel_alternatif ra ON ra.kode_alternatif=a.kode_alternatif
        INNER JOIN tb_kriteria k ON k.kode_kriteria=ra.kode_kriteria
    WHERE ra.status = 1";

    if($periode != null){
        $q .= " AND ra.periode = '$periode'";
    }

    $q .= " ORDER BY a.kode_alternatif, k.kode_kriteria";

    $rows = $db->get_results($q);
    $data = array();
    foreach($rows as $row){
        $data[$row->kode_alternatif][$row->kode_kriteria] = $row->kode_nilai_kriteria;
    }
    return $data;
}

function get_alternatif_saw($key,$k){
    var_dump($key);
    var_dump($k);
    $rows = $db->get_row("SELECT
        	a.kode_alternatif, a.nama_alternatif,
            ra.nilai_alternatif
            FROM tb_rel_alternatif ra 
                INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
            WHERE ra.status = 1 AND ra.kode_alternatif = '$key' AND ra.kode_kriteria = '$k'");
    return $rows->nilai_alternatif;
}

function SAW_nomalize($array, $max = true){
    global $db,$KRITERIA;
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
            $rows = $db->get_row("SELECT
        	a.kode_alternatif, a.nama_alternatif,
            ra.nilai_alternatif
            FROM tb_rel_alternatif ra 
                INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
            WHERE ra.status = 1 AND ra.kode_alternatif = '".$key."' AND ra.kode_kriteria = '".$k."'");


            if($KRITERIA[$k]['atribut']=='benefit'){

                $max = $db->get_row("SELECT
                max(ra.nilai_alternatif) AS maxx
                FROM tb_rel_alternatif ra 
                    INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
                WHERE ra.status = 1 AND ra.kode_kriteria = '$k'");

                $data[$key][$k] = $rows->nilai_alternatif / $max->maxx;
            }else{

                $min = $db->get_row("SELECT
                min(ra.nilai_alternatif) AS minn
                FROM tb_rel_alternatif ra 
                    INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
                WHERE ra.status = 1 AND ra.kode_kriteria = '$k'");


                $data[$key][$k] = $min->minn / $rows->nilai_alternatif;
            }
        }
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
            $rows = $db->get_row("SELECT
        	a.kode_alternatif, a.nama_alternatif,
            ra.nilai_alternatif
            FROM tb_rel_alternatif ra 
                INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
            WHERE ra.status = 1 AND ra.kode_alternatif = '$key' AND ra.kode_kriteria = '$k'");

            
            $r.= "<td>".$rows->nilai_alternatif."</td>";
        }        
        $r.= "</tr>";
        $no++;    
    }    
    $r.= "</tr>";
    return $r;
}



function SAW_step2($echo=true,$periode = null){
    global $db, $ALTERNATIF, $KRITERIA, $SAW_crips;
    
    
    $data = SAW_get_rel($periode);
    
    if(!$echo)
        return $data;
        
    $r.= "<tr><th>No</th><th>Nama Alternatif</th><th>Periode</th>";   	
    $no=1;	
    foreach($data[key($data)] as $key => $value){
        $r.= "<th>". $KRITERIA[$key][nama_kriteria]."</th>";
        $no++;      
    }    
    
    $no=1;	
    foreach($data as $key => $value){
      
        $r.= "<tr>";
        $r.= "<th>".$no."</th>";
        $r.= "<th>".$ALTERNATIF[$key]."</th>";
        $r.= "<th>".$periode."</th>";
        foreach($value as $k => $v){
            $rows = $db->get_row("SELECT
        	a.kode_alternatif, a.nama_alternatif,
            ra.nilai_alternatif
            FROM tb_rel_alternatif ra 
                INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
            WHERE ra.status = 1 AND ra.kode_alternatif = '$key' AND ra.kode_kriteria = '$k'");

            
            $r.= "<td>".$rows->nilai_alternatif."</td>";
        }        
        $r.= "</tr>";
        $no++;    
    }    
    $r.= "</tr>";
    return $r;
}



// function SAW_max($array){
//     foreach($array as $key => $value){                
//         foreach($value as $k => $v){

//             $rows = $db->get_row("SELECT
//             max(ra.nilai_alternatif) AS maxx
//             FROM tb_rel_alternatif ra 
//                 INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
//             WHERE ra.status = 1 AND ra.kode_kriteria = '$k'");
            
//         }
//     }

//     foreach($value as $k => $v){
//         $rows = $db->get_row("SELECT
//         a.kode_alternatif, a.nama_alternatif,
//         ra.nilai_alternatif
//         FROM tb_rel_alternatif ra 
//             INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
//         WHERE ra.status = 1 AND ra.kode_alternatif = '$key' AND ra.kode_kriteria = '$k'");
        
//         $r.= "<td>".$rows->nilai_alternatif."</td>";
//     }        
// }
// function SAW_min($array){

// }
function get_kriteria_option($selected = 0){
    global $KRITERIA;  
    print_r($KRITERIA);
    foreach($KRITERIA as $key => $value){
        if($key==$selected)
            $a.="<option value='$key' selected>$value[kode_kriteria] - $value[nama_kriteria]</option>";
        else
            $a.="<option value='$key'>$value[kode_kriteria] - $value[nama_kriteria]</option>";
    }
    
    return $a;
}
function get_kriteria_res_option($selected = 0){
    global $KRITERIA_RES; 
    foreach($KRITERIA_RES as $key => $value){
        if($key==$selected)
            $a.="<option value='$key' selected>$value[kode_kriteria] - $value[nama_kriteria]</option>";
        else
            $a.="<option value='$key'>$value[kode_kriteria] - $value[nama_kriteria]</option>";
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