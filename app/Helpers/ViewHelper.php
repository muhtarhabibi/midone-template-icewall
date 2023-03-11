<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Request as HttpRequest;
use Agent;
use Carbon\Carbon;
use App\Models\General\Setting;

trait ViewHelper
{
    public static function indexHead($head_items, $filter)
    {
        $sort = [];
        if(isset($filter['sort'])) {
            $sort = explode('|', $filter['sort']);
        }
        $thead = "<tr>";
        foreach ($head_items as $key => $item) {
            if(isset($item[1])) {
                $thead .= "\n<th class='sort_link ". (!empty($sort) && $sort[0] == $item[1] ? $sort[1] : '') ." " . (isset($item[2]) && isset($item[2]['class']) ? $item[2]['class'] : '') . "' data-sort='".  $item[1] . "'>{$item[0]}</th>";
            } else {
                $thead .= "\n<th>{$item[0]}</th>";
            }
        }
        $thead .= "\n<tr>";
        return $thead;
    }

    public static function indexSummary($collection)
    {
        if ($collection->count() > 0) {
            $total = $collection->total();
            return '<p class="mb-1">Menampilkan '. (($collection->currentPage() - 1) * $collection->perPage() + 1) .
                    '  - '. ($collection->currentPage() * $collection->perPage() <= $total ?
                    $collection->currentPage() * $collection->perPage() : $total )
                    . ' dari ' . $total . '</p>';
        }

        return '<p>&nbsp;</p>';
    }

    public static function indexLinks($collection, $filter)
    {
        $filters = [];
        foreach ($filter as $key => $value) { $filters['filter['. $key .']'] = $value; }
        return $collection->appends($filters)->links('vendor.pagination.midone');
    }

    public static function createBtn($route, $id = null, $options = [])
    {
        return "<a href='" . route($route, $id) . "' class='btn btn-primary  btn-sm w-24 inline-block mr-1 mb-2'><i class='fas fa-plus'></i> Tambah</a>";
    }

    public static function editBtn($route, $id, $options = [])
    {
        return "<a href='" . route($route, $id) . "' class='btn btn-warning  btn-sm w-24 inline-block mr-1 mb-2'> Edit</a>";
    }

    public static function deleteBtn($route, $id, $options = [])
    {
        return "<a href='#' class='btn btn-danger  btn-sm w-24 inline-block mr-1 mb-2 destroy' data-href='" . route($route, $id) . "'> Hapus</a>";
    }

    public static function processBtn($route, $id = null, $options = [])
    {
        $label = 'Proses';
        if(!empty($options['label'])) {
            $label = $options['label'];
        }
        $icon = 'fa-paper-plane';
        if(!empty($options['icon'])) {
            $icon = $options['icon'];
        }
        return "<a href='" . route($route, $id) . "' class='btn btn-primary btn-sm'><i class='fas " . $icon . "'></i> " . $label . "</a>";
    }

    public static function ApproveBtn($route, $id = null, $options = [])
    {
        return "<a href='" . route($route, $id) . "' class='btn btn-success btn-sm'>Terima</a>";
    }

    public static function RejectBtn($route, $id = null, $options = [])
    {
        return "<a href='" . route($route, $id) . "' class='btn btn-danger'>Tolak</a>";
    }

    public static function backBtn($route = null, $id = null)
    {
        if ($route) {
            return "<a href='" . route($route, $id) . "' class='btn btn-default btn-sm w-24 inline-block mr-1 mb-2'> Kembali</a>";
        }

        // Tombol Kembali ke url sebelumnya, jadi route yang didefine di blade, diabaikan.
        return "<a href='" . url()->previous() . "' class='btn btn-default btn-sm'> Kembali</a>";
    }

    public static function indexActionBtn($route, $id, $name, $options = [])
    {
        return "<a href='" . route($route, $id) . "' class='btn btn-success btn-sm w-24 inline-block mr-1 mb-2'>" . $name . "</a>";
    }

    public static function indexEditBtn($route, $id, $options = [])
    {
        return "<a href='" . route($route, $id) . "' class='btn btn-warning btn-sm w-24 inline-block mr-1 mb-2'> Edit</a>";
    }

    public static function indexShowBtn($route, $id, $options = [])
    {
        $html_class = $options['class'] ?? '';
        return "<a href='" . route($route, $id) . "' class='btn btn-primary btn-sm w-24 inline-block mr-1 mb-2"  . $html_class .  "'> Detail</a>";
    }

    public static function indexDeleteBtn($route, $id, $options = [])
    {
        return "<a href='#' class='btn btn-danger btn-sm w-24 inline-block mr-1 mb-2 destroy' data-href='" . route($route, $id) . "'> Hapus</a>";
    }

    public static function checkMark($pass_status)
    {
        return $pass_status ? "<span class='badge badge-success right'><i class='icon fas fa-check'></i></span></a>" : null;
    }

    public static function QrCodeImage($qr_data, $size = 300)
    {
        return '<img src="data:image/png;base64,' . base64_encode(\QrCode::errorCorrection('L')
            ->format('png')->size($size)->generate($qr_data)) . '" class="img-responsive">';
    }

    public static function greetings($name = null)
    {
        $hour = Carbon::now()->hour;
        $greetings = '';
        if($hour < 10) {
            $greetings = 'Selamat Pagi';
        } else if($hour < 14) {
            $greetings = 'Selamat Siang';
        } else if($hour < 18) {
            $greetings = 'Selamat Sore';
        } else {
            $greetings = 'Selamat Malam';
        }

        if($name) {
            $greetings .= ', ' . $name;
        }

        return $greetings;
    }

    public static function emptyRow($colspan = 1)
    {
        return "<tr><td class='text-center' colspan='" . $colspan . "'><em>Tidak ada data</em></td></tr>";
    }

}
