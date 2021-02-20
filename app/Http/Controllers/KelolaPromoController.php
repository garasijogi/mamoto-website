<?php

namespace App\Http\Controllers;

use App\Counter;
use App\Promo;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KelolaPromoController extends Controller
{
    public function index()
    {
        return view('admin.promo');
    }

    public function add(Request $request, Promo $promo)
    {
        $formData = $request->all();
        $validator = Validator::make($formData, [
            'name' => 'required|min:8',
            'post' => 'required|min:12',
            'link' => 'required',
            'photo' => 'required',
        ]);

        // cek validatornya berhasil atau engga
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {

            /* ----------------- taruh file foto dalam bentuk file jpeg ----------------- */
            $file_photo = explode(',', $formData['photo']);
            $file_name = md5(uniqid('promo-') . microtime()) . ".jpg";
            $path = 'gallery/promo/';
			Storage::put($path.$file_name, base64_decode($file_photo[1])); // taruh file foto dalam folder gallery promo

            /* -------------------- buat id dengan mengambil counter ------------------- */
            $counter_data = Counter::firstWhere('name', 'promo');
            $counter_attr = json_decode($counter_data->attribute);
            // reset counter count jika tahun tidak sama dengan sistem
            // ($counter_attr->year == date('Y')) ? $counter_count = $counter_data->count : $counter_count = 0;
            if($counter_attr->year == date('Y')){
                // jika sama gunakan counter yg ada di database
                $counter_count = $counter_data->count + 1;
                $counter_update = [
                    'count' => $counter_count
                ];
            } else {
                // reset counter
                $counter_count = 1;
                $counter_update = [
                    'count' => $counter_count,
                    'attribute' => json_encode([
                        'year' => date('Y')
                    ])
                ];
            }
            // update counter ke database
            Counter::where('name', 'promo')->update($counter_update);
            // buat increment dengan strpad biar kebentuk "0001" 4 digit dengan nol di sebelah kiri
            $increment = str_pad($counter_count, 4, "0", STR_PAD_LEFT);
            $id_promo = "promo-" . date('Y') . $increment;

            // ambil formData yg dibutuhkan aja untuk menghindari input di luar form
            $formData_validated =[
                'id' => $id_promo,
                'name' => $formData['name'],
                'post' => $formData['post'],
                'link' => $formData['link'],
                'photo' => $path . $file_name
            ];

            // masukkan formdata validated ke database
            $promo->create($formData_validated);

            // response xhr dengan kode 200, ok
            return response('success');
        }
    }

    public function get()
    {
        $url_storage = url('storage/');
        /* ---------------------- teks wa untuk order langsung ---------------------- */
        // ambil data setting nomor dan link dari table settings
        $wa_api = Setting::select('setting_value')->firstWhere('setting_name', 'wa_link');
        $wa_number = Setting::select('setting_value')->firstWhere('setting_name', 'promo_waNumber');
        // buat link whatsapp lengkap dengan textnya
        $wa_link = $wa_api->setting_value . $wa_number->setting_value . "?text=";

        // ambil data promo paginate 6 per refresh
        $promo_list = Promo::paginate(6)->toArray();
        foreach($promo_list['data'] as $k => $v){
            $promo_list['data'][$k] = [
                'id' => $v['id'],
                'name' => $v['name'],
                'post' => \Str::limit($v['post'], 120, '...'),
                'photo' => $url_storage . "/" . $v['photo'],
                'link' => $wa_link . $v['link'],
                'created_at' => Carbon::parse($v['created_at'])->diffForHumans(),
                'updated_at' => Carbon::parse($v['updated_at'])->diffForHumans()
            ];
        }

        return response()->json($promo_list);
    }
}
