a. Perbandingan Kriteria
117
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kriteria as Kriteria;
use App\Models\PerhitunganKriteria as PKriteria;
use App\Models\EVKriteria as EVK;
use DB;
use Auth;
class PerhitunganAHPController extends Controller
{
 /**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
 public function index()
 {
 return view('Admin.Transaksi.Kriteria.entry_perbandingan', [
 'kriteria' => $this->GetKriteria()
 ]);
118
 }
 private function GetKriteria()
 {
 $count = Kriteria::All()->count();
 if ($count > 2)
 return DB::table('kriteria')->get();
 }
 /**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
 public function create()
 {
 //
 }
 /**
 * Store a newly created resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\Response
 */
119
 public function store(Request $request)
 {
 $data = $request->all();
 $kolom = array();
 $sumKolom = array();
 $dataMinimalisasi = array();
 $sumMinimalisasi = array();
 $pVector = array();
 $hasilKali = array();
 $hasilBagiPriority = array();
 $lamdaMax = 0;
 $CI = 0;
 $RI = array(0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56);
 $CR = 0;
 // Transform Baris - Kolom
 foreach ($data['Data'] as $key => $item) {
 foreach ($item as $kunci => $val) {
 $kolom[$kunci][$key] = $val;
 }
 }
120
 // Hitung Jumlah Per-Kolom
 foreach ($kolom as $key => $item) {
 $sumCol = 0;
 foreach ($item as $val) {
 $sumCol += $val;
 }
 $sumKolom[$key] = $sumCol;
 }
 // Buat Data Normalisasi
 foreach ($data['Data'] as $key => $item) {
 $dataMinimalisasi[$key] = $this->Minimalisasi($item, $sumKolom);
 }
 // Hitung Baris Normalisasi
 foreach ($dataMinimalisasi as $key => $item) {
 $sumMinimalisasi[$key] = $this->HitungRowMinimalisasi($item);
 }
 // Hitung Priority Vector
 foreach ($sumMinimalisasi as $key => $item) {
 $pVector[$key] = round($item / Count($data['Data']), 3);
 }
 // Hitung Hasil Kali
121
 foreach ($data['Data'] as $key => $val) {
 $hasilKali[$key] = round($this->HasilKali($val, $pVector), 3);
 }
 // Hitung Hasil Kali / Priority Vector
 foreach ($pVector as $key => $val) {
 $hasilBagiPriority[$key] = round($hasilKali[$key] / $val, 3);
 }
 $lamdaMax = round(array_sum($hasilBagiPriority) / Count($data['Data']), 3);
 $CI = round(($lamdaMax - Count($data['Data'])) / (Count($data['Data']) - 1), 3);
 $CR = round($CI / $RI[Count($data['Data']) - 1], 3);
 if ($CR <= 0.1) {
 foreach ($data['Data2'] as $key => $val) {
 $id1 = DB::table('kriteria')->select('kd_kriteria')->where('nm_kriteria',
$key)->first();
 if ($id1) {
 foreach ($val as $index => $value) {
 $id2 = DB::table('kriteria')->select('kd_kriteria')->where('nm_kriteria',
$index)->first();
 if ($id2) {
 $check = DB::table('perhitungan_kriterias')
 ->whereRaw('kriteria_1 = ? AND kriteria_2 = ?', [$id1->kd_kriteria,
$id2->kd_kriteria])
 ->orWhereRaw('kriteria_1 = ? AND kriteria_2 = ?', [$id2-
>kd_kriteria, $id1->kd_kriteria])
122
 ->first();
 if (!$check) {
 $pkriteria = new PKriteria;
 $pkriteria->kriteria_1 = $id1->kd_kriteria;
 $pkriteria->kriteria_2 = $id2->kd_kriteria;
 $pkriteria->bobot = $value;
 $pkriteria->save();
 } else {
 PKriteria::where('kriteria_1', $id1->kd_kriteria)
 ->where('kriteria_2', $id2->kd_kriteria)
 ->update(['bobot' => $value]);
 }
 }
 }
 }
 }
 foreach ($pVector as $key => $val) {
 // return $val;
 $idk = DB::table('kriteria')
 ->where('nm_kriteria', $key)
 ->update(['eigen' => $val]);
123
 // return $pVector;
 // $pv = EVK::where('kd_kriteria', $idk->kd_kriteria)->first();
 // if (!$pv) {
 // $pv = new EVK;
 // $pv->kd_kriteria = $idk->kd_kriteria;
 // $pv->nilai = $val;
 // $pv->save();
 // } else {
 // $pv->eigens = $val;
 // $pv->save();
 // }
 }
 }
 return ['data' => ['pasangan' => $data['Data'], 'sumKolom' => $sumKolom, 'min'
=> $dataMinimalisasi, 'sumMin' => $sumMinimalisasi, 'Priority' => $pVector, 'Lamda'
=> $lamdaMax, 'CI' => $CI, 'RI' => $RI[Count($data['Data']) - 1], 'CR' => $CR], 'success'
=> true, 'url' => 'hasil'];
 }
 public function HasilControl(Request $request)
 {
 $data = $request->all();
 $request->session()->put('data', $data['data']);
 return;
124
 }
 public function HasilAHP(Request $request)
 {
 $data = $request->session()->get('data');
 // return dd($data);
 $request->session()->forget('data');
 if ($data == null) {
 return back();
 }
 return view('Admin.Transaksi.Kriteria.hasilAHP', ['data' => $data]);
 }
 /***** Start Penjumlahan Tiap Kolom ******/
 private function HitungColumn($item)
 {
 $sum = 0;
 foreach ($item as $val) {
 $sum = $sum + $val;
 }
 return $sum;
 }
125
 /***** End Penjumlahan Tiap Kolom ******/
 /***** Start Penjumlahan Tiap Baris Minimalisasi ******/
 private function HitungRowMinimalisasi($item)
 {
    $sum = 0;
    foreach ($item as $val) {
    $sum = $sum + $val;
    }
    return round($sum, 3);
 }
 /***** End Penjumlahan Tiap Baris Minimalisasi ******/
 /***** Start Minimalisasi ******/
 private function Minimalisasi($item, $hasil)
 {
    $arr = array();
    foreach ($item as $key => $val) {
    $min = round($val / $hasil[$key], 3);
    $arr[$key] = $min;
    }
    return $arr;
 }
126
 /***** End Minimalisasi ******/
 /***** Start Minimalisasi ******/
 private function HasilKali($item, $priority)
 {
 $sum = 0;
 foreach ($item as $key => $val) {
 $sum = $sum + ($val * $priority[$key]);
 }
 return $sum;
 }
 /***** End Minimalisasi ******/
 /**
 * Display the specified resource.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
 public function show($id)
 {
 //
 }
127
 /**
 * Show the form for editing the specified resource.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
 public function edit($id)
 {
 //
 }
 /**
 * Update the specified resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return \Illuminate\Http\Response
 */
 public function update(Request $request, $id)
 {
 //
 }
 /**
 * Remove the specified resource from storage.
128
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
 public function destroy($id)
 {
 //
 }
}
