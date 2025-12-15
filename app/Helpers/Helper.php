<?php
use Carbon\Carbon;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Settings;

if (!function_exists('exampleHelper')) {
    function exampleHelper($param): string
    {
        return "This is an example helper function with param: " . $param;
    }
}

if (!function_exists('getSetting')) {
    function getSetting($key)
    {
        $result = Settings::where('setting_var',$key)->first();
        if ($result) {
            return $result->setting_val;
        } else {
            return '';
        }
    }
}

if (!function_exists('ResponseJson')) {
    function ResponseJson($data, $status, $msg, $statusCode)
    {

        $res['status'] = $status;
        $res['message'] = $msg;
        $res['data'] = $data;

        return response()->json($res, $statusCode);
    }
}

if (!function_exists('ajaxResponse500')) {
    function ajaxResponse500($message = 'gagal')
    {

        $msg['title'] = 'GAGAL';
        $msg['status'] = false;
        $msg['tipe'] = 'error';
        $msg['message'] = $message;
        return response()->json($msg, 500);
    }
}

if (!function_exists('ajaxResponse202')) {
    function ajaxResponse202($message = 'gagal')
    {

        $msg['title'] = 'GAGAL';
        $msg['status'] = false;
        $msg['tipe'] = 'error';
        $msg['message'] = $message;
        return response()->json($msg, 202);
    }
}
if (!function_exists('convertDateIndonesian')) {
    function convertDateIndonesian($datetime)
    {
        // Array bulan dalam bahasa Indonesia
        $BulanIndo = array(
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        );

        // Menggunakan DateTime untuk parsing tanggal dan waktu
        try {
            $date = new DateTime($datetime);
            $tahun = $date->format('Y');
            $bulan = (int) $date->format('m');
            $tgl = $date->format('d');
            $jam = $date->format('H');
            $menit = $date->format('i');
            $detik = $date->format('s');

            // Format tanggal dalam bahasa Indonesia
            $tgl_indonesia = sprintf(
                "%s %s %s %02d:%02d:%02d",
                $tgl,
                $BulanIndo[$bulan - 1],
                $tahun,
                $jam,
                $menit,
                $detik
            );

            return $tgl_indonesia;
        } catch (Exception $e) {
            // Menangani error jika format tanggal tidak valid
            return "Format tanggal tidak valid";
        }
    }
}

if (!function_exists('convertDateOnly')) {
    function convertDateOnly($datetime)
    {
        // Array bulan dalam bahasa Indonesia
        $BulanIndo = array(
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        );

        // Menggunakan DateTime untuk parsing tanggal dan waktu
        try {
            $date = new DateTime($datetime);
            $tahun = $date->format('Y');
            $bulan = (int) $date->format('m');
            $tgl = $date->format('d');

            // Format tanggal dalam bahasa Indonesia
            $tgl_indonesia = sprintf(
                "%s %s %s",
                $tgl,
                $BulanIndo[$bulan - 1],
                $tahun,
            );

            return $tgl_indonesia;
        } catch (Exception $e) {
            // Menangani error jika format tanggal tidak valid
            return "Format tanggal tidak valid";
        }
    }
}

if(!function_exists('angkaTitikTiga')){
    function angkaTitikTiga($angka) {
        if($angka)
        {
            return number_format($angka, 0, ',', '.');
        }
        return 0;
    }
}

if (!function_exists('encodeId')) {
    function encodeId($id)
    {
        try {
            return Hashids::encode($id);
        } catch (ErrorException $e) {
            abort(404);
        }
    }
}
if (!function_exists('decodeId')) {
    function decodeId($id)
    {
        try {
            return Hashids::decode($id)[0] ?? $id;
        } catch (ErrorException $e) {
            abort(404);
        }
    }
}



