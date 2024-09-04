<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Kamus {

    public static function rupiah($angka) {
        $rupiah = number_format($angka,0,',','.');
        return ("Rp " . $rupiah);
    }

    public static function tanggal($date) {
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl   = substr($date, 8, 2);

        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
        return($result);
    }

    public static function tgl_jam_indo($date) {
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl   = substr($date, 8, 2);

        $jam = explode(" ", $date);

        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun . " / " . $jam[1];
        return($result);
    }

    public static function tgl_indo_lengkap($date) {
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl   = substr($date, 8, 2);

        $x = date('D',strtotime($date));

        switch($x){
            case 'Sun':
                $hari = "Minggu";
                break;

            case 'Mon':
                $hari = "Senin";
                break;

            case 'Tue':
                $hari = "Selasa";
                break;

            case 'Wed':
                $hari = "Rabu";
                break;

            case 'Thu':
                $hari = "Kamis";
                break;

            case 'Fri':
                $hari = "Jumat";
                break;

            case 'Sat':
                $hari = "Sabtu";
                break;

            default:
                $hari = "Tidak di ketahui";
                break;
        }

        $result = $hari . ", " . $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
        return($result);
    }

    public static function jam_indo($date) {
        $x = date('Y-m-d H:i:s',strtotime($date));
        $jam = explode(" ",$x);
        return($jam[1]. " WIB");
    }

    public static function no_hp($hp) {
        $x1 = "+62$hp";
        $x2 = str_replace("+6208","+628", $x1);
        $x3 = str_replace("+62628","+628", $x2);
        $x4 = str_replace("+62+628","+628", $x3);
        return $x4;
    }

    public static function RandomString($panjang) {
        $length = $panjang;
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";

        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $str;
    }

    public static function nama_wilayah($kode) {
        $x = DB::table('wilayah_tb')->where('kode', $kode)->first();
        return $x->nama;
    }
}
