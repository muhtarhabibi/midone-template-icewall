<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Request as HttpRequest;
use Agent;
use Carbon\Carbon;
use App\Models\General\Setting;

trait BaseHelper
{
    public static function requestEnvironments()
    {
        $env = [];

        // IP Address
        $env['ip_address'] = HttpRequest::ip();

        // Browser
        $browser = Agent::browser();
        $browser_version = Agent::version($browser);
        $env['browser'] = $browser . ' ' . $browser_version;

        // OS / Platform
        $platform = Agent::platform();
        $platform_version = Agent::version($platform);
        $env['platform'] = $platform . ' ' . $platform_version;

        // User Agent
        $env['user_agent'] = HttpRequest::userAgent();

        return $env;
    }

    public static function humanizeString($str)
    {
        return ucfirst(strtolower(str_replace('_', ' ', $str)));
    }

    public static function trim($str, $length)
    {
        if(strlen($str) > $length) {
            $str = substr($str, 0, $length - 2) . '..';
        }
        return $str;
    }

    public static function money($value, $use_decimal = true, $prefix = true, $currency = "Rp ")
    {
        if(!isset($value))
            return '-';

        if(is_int($value))
            $value=floatval($value);

        $decimal = $use_decimal ? 2 : 0;

        return ($prefix ? $currency : null) . number_format($value, $decimal, ",", ".");
    }

    private static function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = self::penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = self::penyebut($nilai/10)." puluh". self::penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . self::penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = self::penyebut($nilai/100) . " ratus" . self::penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . self::penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = self::penyebut($nilai/1000) . " ribu" . self::penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = self::penyebut($nilai/1000000) . " juta" . self::penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = self::penyebut($nilai/1000000000) . " milyar" . self::penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = self::penyebut($nilai/1000000000000) . " triliun" . self::penyebut(fmod($nilai,1000000000000));
        }
        return $temp;
    }

    public static function terbilang($nilai) {
        if ($nilai == 0) {
            return 'Nol Rupiah';
        }
        if($nilai<0) {
            $hasil = "minus ". trim(self::penyebut($nilai));
        } else {
            $hasil = trim(self::penyebut($nilai));
        }
        return ucwords($hasil) . ' Rupiah';
    }

    public static function decimal($value)
    {
        if(!isset($value))
            return '0.00';

        if(is_int($value))
            $value=floatval($value);
        return number_format($value, 2, ",", ".");
    }

    public static function today()
    {
        return Carbon::today();
    }

    public static function todayStr()
    {
        return Carbon::today()->toDateString();
    }

    public static function now()
    {
        return Carbon::now();
    }

    public static function dateFormat($date_string, $format = 'd M Y')
    {
        try {
            if(is_object($date_string))
                return $date_string->translatedFormat($format);

            if(!empty($date_string))
                return Carbon::create($date_string)->translatedFormat($format);

        } catch(\Exception $ex) {
            return 'invalid_date';
        }
        return '-';
    }

    public static function generateNumber($length, $prefix = "")
    {
        $result = '';
        for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
        }
        return $prefix . $result;
    }

    public static function numberPad($number, $length)
    {
        return str_pad($number, $length, '0', STR_PAD_LEFT);
    }

    public static function unsetEmptyValue($data)
    {
        foreach($data as $key => $value)
        if(empty($value))
            unset($data[$key]);

        return $data;
    }

    public static function serverDiskUsagePercentage()
    {
        /* get disk space free (in bytes) */
        $df = disk_free_space("/");
        /* and get disk space total (in bytes)  */
        $dt = disk_total_space("/");
        /* now we calculate the disk space used (in bytes) */
        $du = $dt - $df;
        /* percentage of disk used - this will be used to also set the width % of the progress bar */
        $dp = sprintf('%.2f',($du / $dt) * 100);

        // /* and we formate the size from bytes to MB, GB, etc. */
        // $df = formatSize($df);
        // $du = formatSize($du);
        // $dt = formatSize($dt);

        return $dp;
    }

    // private static function formatStorageSize($bytes)
    // {
    //     $types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
    //             for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
    //                     return( round( $bytes, 2 ) . " " . $types[$i] );
    // }

    public static function mimeIsImage($mime_type)
    {
        $image_mime_types = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
        return in_array($mime_type, $image_mime_types);
    }

    public static function dateIndo($date)
    {
        $dateString = \Carbon\Carbon::parse($date);
        $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return $dateString->day . ' ' . $month[$dateString->month - 1]. ' '. $dateString->year;
    }

    public static function monthIndo($date)
    {
        $dateString = \Carbon\Carbon::parse($date);
        $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return $month[$dateString->month - 1];
    }

    public static function time($timestamp)
    {
        return $timestamp->format('H:i');
    }

    public static function timeFormat($timestamp, $format = 'd-m-Y H:i:s')
    {
        if(!$timestamp)
            return '-';

        $timestampstring = \Carbon\Carbon::parse($timestamp);
        return $timestampstring->format($format);
    }

    public static function monthOptions()
    {
        return [
            "" => '-',
            1  => '01',
            2  => '02',
            3  => '03',
            4  => '04',
            5  => '05',
            6  => '06',
            7  => '07',
            8  => '08',
            9  => '09',
            10 => '10',
            11 => '11',
            12 => '12'
        ];
    }

    public static function floatToTime($val) {
        $hour = intval($val);
        $minute = round(fmod($val,1) * 60);
        if($minute >= 60) {
            $hour += 1;
            $minute = 0;
        }
        return str_pad($hour, 2, '0', STR_PAD_LEFT) . ":" . str_pad($minute, 2, '0', STR_PAD_LEFT);
    }

    public static function timeToFloat($val) {
        $time = explode(":",$val);
        return intval($time[0]) + (intval($time[1]) * 1.0 / 60);
    }

    public static function floatToTimeLength($val) {
        $hour = intval($val);
        $minute = round(fmod($val,1) * 60);
        if($minute >= 60) {
            $hour += 1; $minute = 0;
        }
        return ($hour > 0 ? $hour . 'h ' : '') . ($minute > 0 ? $minute . "'" : '');
    }

    public static function dateFdmY($date)
    {
        $tanggal = Carbon::parse($date)->format('d-m-Y');
        return $tanggal;
    }

    public static function dateFYmd($date)
    {
        $tanggal = Carbon::parse($date)->format('Y-m-d');
        return $tanggal;
    }
    public static function dayOptions($day_id = null, $day_name = null)
    {
        $arr_days = [
            '' => 'Pilih Hari..',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        ];

        if($day_id){
            return  $arr_days[$day_id];
        }
        elseif($day_name){
            foreach($arr_days as $id => $name){
            if($day_name == $name){
                return $id;
            }
            }
        }
        else{
            return $arr_days;
        }
    }

    public static function tanggal_info_spelling($date) {
        $str = "";
        if ($date) {
            $date = Carbon::parse($date);
            if($date->format('d') < 0) {
                $str .= "minus ". trim(self::penyebut($date->format('d')));
            } else {
                $str .= trim(self::penyebut($date->format('d')));
            }

            $str .= ' '.$date->format('F');

            if($date->format('Y') < 0) {
                $str .= ' '."minus ". trim(self::penyebut($date->format('Y')));
            } else {
                $str .= ' '.trim(self::penyebut($date->format('Y')));
            }
        }
        return ucwords($str);
    }

    public static function tenor_info_spelling($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim(self::penyebut($nilai));
        } else {
            $hasil = trim(self::penyebut($nilai));
        }
        return ucwords($hasil);
    }

    public static function monthSpelling($month)
    {
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return isset($months[$month - 1]) ? $months[$month - 1] : '-';
    }

    public static function selecthMonthOptions()
    {
        return [
            '' => 'Pilih Bulan',
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'Sepetember',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
    }


    public static function flatToEfectiveConversion($flat_rate, $tenor, $loan_amount)
    {
        $result = exec(env("PYTHON3_BINARY", '/usr/bin/python3') . " " . base_path() . "/numpy_rate.py " . $flat_rate . " " . $tenor . " " . $loan_amount);
        return $result;
    }
}
