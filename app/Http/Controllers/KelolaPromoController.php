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
	protected $path = 'gallery/promo/'; // path folder
	protected $url_storage = 'storage/'; // url for loade directly photos

	public function index()
	{
		return view('admin.promo');
	}

	public function add(Request $request, Promo $promo)
	{
		$formData = $request->all();
		// buat validator
		$validator = $this->validateForm($formData);

		// cek validatornya berhasil atau engga
		if ($validator->fails()) {
			return response()->json($validator->errors(), 422);
		} else {

			/* ----------------- taruh file foto dalam bentuk file jpeg ----------------- */
			$file_name = $this->photoSave($formData['photo']);

			/* -------------------- buat id dengan mengambil counter ------------------- */
			$counter_data = Counter::firstWhere('name', 'promo');
			$counter_attr = json_decode($counter_data->attribute);
			// reset counter count jika tahun tidak sama dengan sistem
			// ($counter_attr->year == date('Y')) ? $counter_count = $counter_data->count : $counter_count = 0;
			if ($counter_attr->year == date('Y')) {
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
			$formData_validated = $this->setValidatedFormData($id_promo, $file_name, $formData);

			// masukkan formdata validated ke database
			$promo->create($formData_validated);

			// response xhr dengan kode 200, ok
			return response('success');
		}
	}

	// NOW make edit function
	public function edit(Request $request, Promo $promo)
	{
		$formData = $request->all();
		// buat validator
		$validator = $this->validateForm($formData);
		if ($validator->fails()) {
			return response()->json($validator->errors(), 422);
		} else {
			/* ----------------------------- mengolah gambar ---------------------------- */
			// cek apa foto base64
			$file_photo = base64_decode($formData['photo'], true);
			if($file_photo 	== false){
				// hapus file lama
				Storage::delete($this->path, explode('/', $formData['photo_origin'])[2]);
				// taruh file baru pada storage
				$file_name = $this->photoSave($formData['photo']);
			} else {
				$file_name = $formData['photo'];
			}

			// ambil formData yg dibutuhkan aja untuk menghindari input di luar form
			$formData_validated = $this->setValidatedFormData($formData['id'], $file_name, $formData);

			// update ke database
			$promo->where('id', $formData['id'])->update($formData_validated);

			$formData_validated['photo'] = url($this->url_storage) . "/" . $formData_validated['photo'];
			$formData_validated['post'] = \Str::limit($formData_validated['post'], 92, '...');

			return response()->json($formData_validated);
		}
	}

	public function get()
	{
		/* ---------------------- teks wa untuk order langsung ---------------------- */
		// ambil data setting nomor dan link dari table settings
		$wa_api = Setting::select('setting_value')->firstWhere('setting_name', 'wa_link');
		$wa_number = Setting::select('setting_value')->firstWhere('setting_name', 'promo_waNumber');
		// buat link whatsapp lengkap dengan textnya
		$wa_link = $wa_api->setting_value . $wa_number->setting_value . "?text=";

		// ambil data promo paginate 6 per refresh
		$promo_list = Promo::latest()->paginate(6)->toArray();
		foreach ($promo_list['data'] as $k => $v) {
			$promo_list['data'][$k] = [
				'id' => $v['id'],
				'name' => $v['name'],
				'post' => \Str::limit($v['post'], 92, '...'),
				'photo' => url($this->url_storage) . "/" . $v['photo'],
				'link' => $wa_link . $v['link'],
				'created_at' => Carbon::parse($v['created_at'])->diffForHumans(),
				'updated_at' => Carbon::parse($v['updated_at'])->diffForHumans()
			];
		}

		return response()->json($promo_list);
	}

	public function getOnce(Request $request)
	{
		$formData = $request->all();
		// buat validator
		$validator = Validator::make($formData, [
			'id' => 'required|max:14'
		]);
		// cek apa validatornya berhasil?
		if ($validator->fails()) {
			return response()->json('forbidden', 403);
		} else {
			$promo = Promo::where('id', $formData['id'])->first()->toArray();
			$promo['photo_link'] = url("storage/" . $promo['photo']); // buat link dari photo
			return response()->json($promo);
		}
	}

	public function photoSave($base64_photo)
	{
		$file_photo = explode(',', $base64_photo);
		$file_name = md5(uniqid('promo-') . microtime()) . ".jpg";
		Storage::put($this->path . $file_name, base64_decode($file_photo[1])); // taruh file foto dalam folder gallery promo
		return $file_name;
	}

	protected function setValidatedFormData($id, $file_name, $formData)
	{
		return [
			'id' => $id,
			'name' => $formData['name'],
			'post' => $formData['post'],
			'link' => $formData['link'],
			'photo' => $this->path . $file_name
		];
	}

	public function validateForm($formData)
	{
		return Validator::make($formData, [
			'name' => 'required|min:8',
			'post' => 'required|min:12',
			'link' => 'required',
			'photo' => 'required',
		]);
	}
}
