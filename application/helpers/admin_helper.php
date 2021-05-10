<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function info_user() {
	$CI = get_instance();
	$data = array();
    $belum_ada = array();
    $data['nakes_wilayah_binaan'] = $CI->nakes_wilayah->get_all();
    $data['sasaran'] = $CI->sasaran->get_all();
    $this_year = date("Y");
    foreach ($data['nakes_wilayah_binaan'] as $row) {
        foreach ($data['sasaran'] as $sasaran) {
            if ($CI->sasaran_target->get_by_sasaran_nakes_kelurahan_tahun($sasaran->id_sasaran, $row->id_nakes, $row->id_kelurahan, $this_year)) {
                // Ada
            } else {
                // Tidak Ada
                $pesan = strtoupper($row->nakes.' wilayah binaan : kecamatan '.$row->kecamatan.' kelurahan '.$row->kelurahan.' belum mengisi sasaran tahun '.$this_year);
                array_push($belum_ada, $pesan);
            }
        }
    }
    return json_encode($belum_ada);
}

function createColumnsArray($end_column, $first_letters = '') {
  $columns = array();
  $length = strlen($end_column);
  $letters = range('A', 'Z');

  // Iterate over 26 letters.
  foreach ($letters as $letter) {
      // Paste the $first_letters before the next.
      $column = $first_letters . $letter;

      // Add the column to the final array.
      $columns[] = $column;

      // If it was the end column that was added, return the columns.
      if ($column == $end_column)
          return $columns;
  }

  // Add the column children.
  foreach ($columns as $column) {
      // Don't itterate if the $end_column was already set in a previous itteration.
      // Stop iterating if you've reached the maximum character length.
      if (!in_array($end_column, $columns) && strlen($column) < $length) {
          $new_columns = createColumnsArray($end_column, $column);
          // Merge the new columns which were created with the final columns array.
          $columns = array_merge($columns, $new_columns);
      }
  }

  return $columns;
}

function coun_vaksin_catatan($field,$bulan) {
    $CI = get_instance();
    $sql = "SELECT COUNT(".$field.") AS jmlData
    FROM t_vaksin_catatan WHERE ";
    
    $sql .= "MONTH(create_date) = '".$bulan."' AND YEAR(tanggal)  = '".date("Y")."'";
    
    $query = $CI->db->query($sql);
    
    return $query->row()->jmlData + 0;
}

function coun_vaksin_catatan_laki_laki($field,$bulan) {
    $CI = get_instance();
    $sql = "SELECT COUNT(".$field.") AS jmlData
    FROM t_vaksin_catatan a
    JOIN m_warga b ON a.id_warga=b.id_warga
    WHERE b.jenis_kelamin='L' AND ";
    
    $sql .= "MONTH(create_date) = '".$bulan."' AND YEAR(tanggal)  = '".date("Y")."'";
    
    $query = $CI->db->query($sql);
    
    return $query->row()->jmlData + 0;
}

function coun_vaksin_catatan_perempuan($field,$bulan) {
    $CI = get_instance();
    $sql = "SELECT COUNT(".$field.") AS jmlData
    FROM t_vaksin_catatan a
    JOIN m_warga b ON a.id_warga=b.id_warga
    WHERE b.jenis_kelamin='P' AND ";
    
    $sql .= "MONTH(create_date) = '".$bulan."' AND YEAR(tanggal)  = '".date("Y")."'";
    
    $query = $CI->db->query($sql);
    
    return $query->row()->jmlData + 0;
}

function coun_vaksin_catatan_laki_laki_tanggal($field,$bulan) {
    $CI = get_instance();
    $sql = "SELECT COUNT(".$field.") AS jmlData
    FROM t_vaksin_catatan a
    JOIN m_warga b ON a.id_warga=b.id_warga
    WHERE b.jenis_kelamin='L' AND ";
    
    $sql .= "MONTH(tanggal) = '".$bulan."' AND YEAR(tanggal)  = '".date("Y")."'";
    
    $query = $CI->db->query($sql);
    
    return $query->row()->jmlData + 0;
}

function coun_vaksin_catatan_perempuan_tanggal($field,$bulan) {
    $CI = get_instance();
    $sql = "SELECT COUNT(".$field.") AS jmlData
    FROM t_vaksin_catatan a
    JOIN m_warga b ON a.id_warga=b.id_warga
    WHERE b.jenis_kelamin='P' AND ";
    
    $sql .= "MONTH(tanggal) = '".$bulan."' AND YEAR(tanggal)  = '".date("Y")."'";
    
    $query = $CI->db->query($sql);
    
    return $query->row()->jmlData + 0;
}

function coun_puskesmas_catatan($field,$nakes) {
    $CI = get_instance();
    $sql = "SELECT COUNT(".$field.") AS jmlData
    FROM t_vaksin_catatan WHERE ";
    
    $sql .= "id_nakes = '".$nakes."' AND YEAR(tanggal)  = '".date("Y")."'";
    // var_dump($sql);die();
    $query = $CI->db->query($sql);
    // var_dump($query->row()->jmlData + 0);die();
    return $query->row()->jmlData + 0;
}

function coun_puskesmas_catatan_laki_laki($field,$nakes) {
    $CI = get_instance();
    $sql = "SELECT COUNT(".$field.") AS jmlData
    FROM t_vaksin_catatan a JOIN m_warga b ON a.id_warga=b.id_warga
    WHERE b.jenis_kelamin='L' AND ";
    
    $sql .= "id_nakes = '".$nakes."' AND YEAR(tanggal)  = '".date("Y")."'";
    // var_dump($sql);die();
    $query = $CI->db->query($sql);
    // var_dump($query->row()->jmlData + 0);die();
    return $query->row()->jmlData + 0;
}

function coun_puskesmas_catatan_perempuan($field,$nakes) {
    $CI = get_instance();
    $sql = "SELECT COUNT(".$field.") AS jmlData
    FROM t_vaksin_catatan a JOIN m_warga b ON a.id_warga=b.id_warga
    WHERE b.jenis_kelamin='P' AND ";
    
    $sql .= "id_nakes = '".$nakes."' AND YEAR(tanggal)  = '".date("Y")."'";
    // var_dump($sql);die();
    $query = $CI->db->query($sql);
    // var_dump($query->row()->jmlData + 0);die();
    return $query->row()->jmlData + 0;
}

function coun_puskesmas_catatan_laki_laki_tanggal($field,$nakes) {
    $CI = get_instance();
    $sql = "SELECT COUNT(".$field.") AS jmlData
    FROM t_vaksin_catatan a JOIN m_warga b ON a.id_warga=b.id_warga
    WHERE b.jenis_kelamin='L' AND ";
    
    $sql .= "id_nakes = '".$nakes."' AND YEAR(tanggal)  = '".date("Y")."'";
    // var_dump($sql);die();
    $query = $CI->db->query($sql);
    // var_dump($query->row()->jmlData + 0);die();
    return $query->row()->jmlData + 0;
}

function coun_puskesmas_catatan_perempuan_tanggal($field,$nakes) {
    $CI = get_instance();
    $sql = "SELECT COUNT(".$field.") AS jmlData
    FROM t_vaksin_catatan a JOIN m_warga b ON a.id_warga=b.id_warga
    WHERE b.jenis_kelamin='P' AND ";
    
    $sql .= "id_nakes = '".$nakes."' AND YEAR(tanggal)  = '".date("Y")."'";
    // var_dump($sql);die();
    $query = $CI->db->query($sql);
    // var_dump($query->row()->jmlData + 0);die();
    return $query->row()->jmlData + 0;
}

function coun_sasaran_nakes($field,$sasaran,$nakes) {
    $CI = get_instance();
    $sql = "SELECT ".$field." as target FROM m_sasaran_target WHERE id_sasaran = '".$sasaran."' AND id_nakes = '".$nakes."' AND tahun  = '".date("Y")."'";
    $query = $CI->db->query($sql);
    if ($query->result()) {
        $target = 0;
        foreach ($query->result() as $k => $val) {
            // var_dump($val);die();
            $val_j = json_decode($val->target);
            // var_dump($val_j->jumlah);die();
            $target = $target + $val_j->jumlah;
        }
        $target = $target + 0;
    } else {
        $target = 0;
    }

    // target=1115
    // result=3219
    //var_dump($target);die();

    $sql = "SELECT COUNT(id_vaksin_catatan) as jmlData from t_vaksin_catatan WHERE id_sasaran = '".$sasaran."' AND id_nakes = '".$nakes."' AND YEAR(tanggal)  = '".date("Y")."'";
    $query = $CI->db->query($sql);
    
    if ($query->row()) {
        $result = $query->row()->jmlData + 0;
    } else {
        $result = 0;
    }
    // var_dump("Sasaran : ".$sasaran,"<hr>");var_dump("Nakes : ".$nakes,"<hr>");var_dump("Target : ".$target,"<hr>");var_dump("Capaian : ".$result,"<hr>");
    // die();
    if ($target == 0) {
        return 0;
    } 
    else {
        // before
        return number_format((($result / $target) * 100),2);
    }
}

function coun_sasaran_nakes_filter($field,$sasaran,$nakes,$kelurahan,$tahun) {
    $CI = get_instance();
    $CI->db->select($field.' as target');
    $CI->db->where(['id_nakes' => $nakes, 'id_kelurahan' => $kelurahan]);
    $CI->db->where(['id_sasaran' => $sasaran, 'tahun' => $tahun]);
    $query = $CI->db->get('m_sasaran_target');
    $target = 0;
    if ($query->result()) {
        foreach ($query->result() as $k => $val) {
            $val_j = json_decode($val->target);
            $target = $target + $val_j->jumlah;
        }
        $target = $target + 0;
    }
    return $target;

    // target=1115
    // result=3219
    //var_dump($target);die();

    // $sql = "SELECT COUNT(id_vaksin_catatan) as jmlData from t_vaksin_catatan WHERE id_sasaran = '".$sasaran."' AND id_nakes = '".$nakes."' AND YEAR(create_date)  = '".date("Y")."' AND id_kelurahan = '".$kelurahan."'";
    // $query = $CI->db->query($sql);
    
    // if ($query->row()) {
    //     $result = $query->row()->jmlData + 0;
    // } else {
    //     $result = 0;
    // }

    // if ($target == 0) {
    //     return 0;
    // } 
    // else {
    //     return number_format((($result / $target) * 100),2);
    // }
}

function coun_catatan_nakes_filter($field,$sasaran,$nakes,$kelurahan,$tahun) {
    $CI = get_instance();
    
    // target=1115
    // result=3219
    //var_dump($target);die();

    $sql = "SELECT COUNT(id_vaksin_catatan) as jmlData from t_vaksin_catatan WHERE id_sasaran = '".$sasaran."' AND id_nakes = '".$nakes."' AND YEAR(tanggal)  = '".$tahun."' AND id_kelurahan = '".$kelurahan."'";
    $query = $CI->db->query($sql);
    
    if ($query->row()) {
        $result = $query->row()->jmlData + 0;
    } else {
        $result = 0;
    }

    return $result;
}

function coun_vaksin_nakes($field,$vaksin,$nakes) {
    $CI = get_instance();
    $sql = "SELECT ".$field." as target FROM m_vaksin_target WHERE id_vaksin_detail = '".$vaksin."' AND id_nakes = '".$nakes."' AND tahun  = '".date("Y")."'";
    $query = $CI->db->query($sql);
    if ($query->result()) {
        $target = 0;
        $target = $query->row()->target + 0;
    } else {
        $target = 0;
    }
    // var_dump($target);die();

    $sql = "SELECT COUNT(id_vaksin_catatan) as jmlData from t_vaksin_catatan WHERE id_vaksin_detail = '".$vaksin."' AND id_nakes = '".$nakes."' AND YEAR(tanggal)  = '".date("Y")."'";
    $query = $CI->db->query($sql);
    
    if ($query->row()) {
        $result = $query->row()->jmlData + 0;
    } else {
        $result = 0;
    }
    // var_dump("Vaksin : ".$vaksin,"<hr>");var_dump("Nakes : ".$nakes,"<hr>");var_dump("Target : ".$target,"<hr>");var_dump("Capaian : ".$result,"<hr>");
    // die();
    if ($target == 0) {
        return 0;
    } else {
        return number_format((($result / $target) * 100),2);
    }
}

function coun_vaksin_nakes_target($field,$vaksin,$nakes,$kelurahan,$tahun) {
    $CI = get_instance();
    $sql = "SELECT ".$field." as target FROM m_vaksin_target WHERE id_vaksin_detail = '".$vaksin."' AND id_nakes = '".$nakes."' AND tahun  = '".$tahun."' AND id_kelurahan = '".$kelurahan."'";
    $query = $CI->db->query($sql);
    if ($query->result()) {
        $target = 0;
        $target = $query->row()->target + 0;
    } else {
        $target = 0;
    }
    // var_dump($target);die();

    return $target;
}

function coun_vaksin_nakes_catatan($field,$vaksin,$nakes,$kelurahan,$tahun) {
    $CI = get_instance();

    $sql = "SELECT COUNT(id_vaksin_catatan) as jmlData from t_vaksin_catatan WHERE id_vaksin_detail = '".$vaksin."' AND id_nakes = '".$nakes."' AND YEAR(tanggal)  = '".$tahun."' AND id_kelurahan = '".$kelurahan."'";
    $query = $CI->db->query($sql);
    
    if ($query->row()) {
        $result = $query->row()->jmlData + 0;
    } else {
        $result = 0;
    }
    
    return $result;
}

function count_idl_vaksin() {
    $CI = get_instance();
    $sql = "SELECT COUNT(id_vaksin_detail) as jmlData from m_vaksin_detail WHERE idl = '1' ";
    $query = $CI->db->query($sql);
    $result = $query->row()->jmlData + 0;
    // $query = $CI->db->query($sql);
    // var_dump($result);die();
    return $result;
}

function coun_idl_nakes($nakes, $tahun = '') {
    if (!$tahun) $tahun = date("Y");
    $thisYear = $tahun;
    $CI = get_instance();
    $sql = "SELECT COUNT(DISTINCT vc.id_vaksin_detail) AS jumlah
    FROM t_vaksin_catatan vc 
    JOIN m_vaksin_detail AS vd ON vd.id_vaksin_detail = vc.id_vaksin_detail
    JOIN m_warga  AS w ON w.id_warga = vc.id_warga
    JOIN m_nakes AS mn ON mn.id_nakes = vc.id_nakes
    JOIN m_kelurahan AS kl ON kl.id_kelurahan = w.id_kelurahan
    JOIN m_nakes_wilayah_binaan AS nwb ON nwb.id_kelurahan = kl.id_kelurahan
    JOIN m_nakes_kategori AS mnk ON mnk.id_nakes_kategori = mn.id_nakes_kategori
    JOIN m_keluarga  AS k ON k.`id_keluarga` = w.`id_keluarga` 
    JOIN m_nakes AS mn_b ON mn_b.id_nakes = nwb.id_nakes
    WHERE vc.`id_nakes` = '".$nakes."' AND vd.idl = '1' AND YEAR(vc.tanggal) BETWEEN ".($thisYear-1)." AND ".$thisYear." 
    GROUP BY w.`id_warga` 
    HAVING jumlah = ".count_idl_vaksin()."";
    $query = $CI->db->query($sql);
    // $query = $CI->db->query($sql);
    // var_dump($query->num_rows());die();
    return $query->num_rows();  
}

function get_lap_vaksin_cakupan($find) {
    // var_dump($find);die;
    $CI = get_instance();
    $CI->db->select('w.jenis_kelamin, count(w.id_warga) as jumlah');
    $CI->db->from('t_vaksin_catatan as cv');
    $CI->db->join('m_warga as w','w.id_warga = cv.id_warga');
    $CI->db->where('cv.id_vaksin_detail',$find['id_vaksin_detail']);
    $CI->db->where('cv.id_nakes',$find['id_nakes']);
    $CI->db->where('cv.id_sasaran',$find['id_sasaran']);
    $CI->db->where('cv.id_kelurahan',$find['id_kelurahan']);
    $CI->db->where('month(cv.tanggal)',$find['bulan']);
    $CI->db->where('year(cv.tanggal)',$find['tahun']);
    $CI->db->group_by('w.jenis_kelamin');
    $query = $CI->db->get();
    // var_dump($query->row_array());die;
    return $query->result_array();
}

function get_lap_vaksin_cakupan_range($find) {
    // var_dump($find);die;
    $CI = get_instance();
    $CI->db->select('w.jenis_kelamin, count(w.id_warga) as jumlah');
    $CI->db->from('t_vaksin_catatan as cv');
    $CI->db->join('m_warga as w','w.id_warga = cv.id_warga');
    $CI->db->where('cv.id_vaksin_detail',$find['id_vaksin_detail']);
    $CI->db->where('cv.id_nakes',$find['id_nakes']);
    $CI->db->where('cv.id_sasaran',$find['id_sasaran']);
    $CI->db->where('cv.id_kelurahan',$find['id_kelurahan']);
    $CI->db->where_in('month(cv.tanggal)',$find['bulan']);
    $CI->db->where('year(cv.tanggal)',$find['tahun']);
    $CI->db->group_by('w.jenis_kelamin');
    $query = $CI->db->get();
    // var_dump($query->row_array());
    return $query->result_array();
}


date_default_timezone_set('Asia/Jakarta');
function time_since($original){ 
    $chunks = array(
        array(60 * 60 * 24 * 365, 'tahun'),
        array(60 * 60 * 24 * 30, 'bulan'),
        array(60 * 60 * 24 * 7, 'minggu'),
        array(60 * 60 * 24, 'hari'),
        array(60 * 60, 'jam'),
        array(60, 'menit'),
    );
    $today = time();
    $since = $today - $original;
    
    if ($since > 604800)
    {
        $print = date("M jS", $original);
        if ($since > 31536000)
        {
            $print .= ", " . date("Y", $original);
        }
        return $print;
    }
    for ($i = 0, $j = count($chunks); $i < $j; $i++)
    {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];

        if (($count = floor($since / $seconds)) != 0)
            break;
    }
    $print = ($count == 1) ? '1 ' . $name : "$count {$name}";
    return $print . ' yang lalu';
}


function short($in, $to_num = false, $pad_up = false, $pass_key = '')
{
   $out   =   '';
   $index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $base  = strlen($index);

   if ($pass_key !== null) {
      for ($n = 0; $n < strlen($index); $n++) {
         $i[] = substr($index, $n, 1);
     }

     $pass_hash = hash('sha256',$pass_key);
     $pass_hash = (strlen($pass_hash) < strlen($index) ? hash('sha512', $pass_key) : $pass_hash);

     for ($n = 0; $n < strlen($index); $n++) {
         $p[] =  substr($pass_hash, $n, 1);
     }

     array_multisort($p, SORT_DESC, $i);
     $index = implode($i);
 }

 if ($to_num) {

  $len = strlen($in) - 1;

  for ($t = $len; $t >= 0; $t--) {
     $bcp = pow($base, $len - $t);
     $out = floatval($out) + floatval(strpos($index, substr($in, $t, 1))) * floatval($bcp);
 }

 if (is_numeric($pad_up)) {
     $pad_up--;

     if ($pad_up > 0) {
        $out -= pow($base, $pad_up);
    }
}
} else {
  if (is_numeric($pad_up)) {
     $pad_up--;

     if ($pad_up > 0) {
        $in += pow($base, $pad_up);
    }
}

for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
 $bcp = pow($base, $t);
 $a   = floor($in / $bcp) % $base;
 $out = $out . substr($index, $a, 1);
 $in  = $in - ($a * $bcp);
}
}

return $out;
}

function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {
    if (trim ($timestamp) == '')
    {
        $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date}";
    return $date;
}

function readMore($text, $length, $mode = 2)
{
   $text = strip_tags($text);
   $jumlah_kata = strlen($text);
   if($jumlah_kata <= $length)
   {
       return $text.' ...';;
   }
   else{
      if ($mode != 1)
      {
         $char = $text{$length - 1};
         switch($mode)
         {
            case 2: 
            while($char != ' ') {
               $char = $text{--$length};
           }
           case 3:
           while($char != ' ') {
               $char = $text{++$num_char};
           }
       }
   }
   return substr($text, 0, $length).' ...';
}

}

function text($data)
{
   return xss(ucwords(strtolower($data)));
}

function xss($var)
{
   return htmlentities($var, ENT_QUOTES, 'UTF-8');
}


function getidyoutube($url)
{
    $hasil = explode('/', $url);
    // $data = explode('&', $hasil[1]);
    $id_youtube = $hasil[4];
    return $id_youtube;
}
function getidyoutube2($url)
{
    $hasil = explode('=', $url);
    $data = explode('&', $hasil[1]);
    $id_youtube = $data[0];
    return $id_youtube;
}
function indonesian_date_2($tanggal) {
    if($tanggal)
    {
       $hari = array ( 1 =>    'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
      );

       $bulan = array (1 =>   'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
      );
       $split      = explode('-', $tanggal);
       $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
       $num = date('N', strtotime($tanggal));
       return $hari[$num] . ', ' . $tgl_indo;
   }else{
       return null;
   }
}

function indonesian_date_3($tanggal) {
    if($tanggal)
    {
       $hari = array ( 1 =>    'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
      );

       $bulan = array (1 =>   'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
      );
       $split      = explode('-', $tanggal);
       $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
       $num = date('N', strtotime($tanggal));
       return  $tgl_indo;
   }else{
       return null;
   }
}

function cek_status($id)
{
   $CI                 = get_instance();
   $cek['select']      = 'a.id';
   $cek['table']       = 'm_kategori a';
   $cek['where']       = 'a.parent_id = '.$id;
   $data               = $CI->m_query->getData($cek);
   if($data)
   {
      $query['select']    = 'count(id_materi) as jumlah';
      $query['table']     = 'm_materi';
      $query['where']     = 'id_kategori = '.$id;
      $jumlah             = $CI->m_query->getRow($query);

      if($data AND $jumlah->jumlah)
      {
         $status = 'C';
     }
     else if($jumlah->jumlah)
     {
         $status = 'D';
     }else{
         $status = 'M';
     }

 }else {
  $query['select']    = 'count(id_materi) as jumlah';
  $query['table']     = 'm_materi';
  $query['where']     = 'id_kategori = '.$id;
  $jumlah             = $CI->m_query->getRow($query);

  if($jumlah->jumlah)
  {
     $status = 'D';
 }else{
     $status = 'S';
 }
}

return $status;

     // S -> gk punya materi dan sub
     // M -> punya sub
     // D -> punya materi 
     // C -> punya materi dan sub
}