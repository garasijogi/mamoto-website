<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Counter;
use App\Promo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KelolaPromoController extends Controller
{
	protected $path = 'gallery/promo/'; // path folder
	protected $url_storage = 'storage/'; // url for loade directly photos

	protected function index()
	{
		return view('admin.promo');
	}

	protected function add(Request $request, Promo $promo)
	{
		$formData = $request->all();
		// buat validator
		$validator = $this->validateForm($formData);

		// cek validatornya berhasil atau engga
		if ($validator->fails()) {
			return response()->json($validator->errors(), 422);
		} else {

			/* ----------------- taruh file foto dalam bentuk file jpeg ----------------- */
			// cek apa foto base64, dengan mengecek ada tanda koma pada input
			if (strpos($formData['photo'], ',')) {
				$is_base64 = $this->is_base64($formData['photo']);
				if ($is_base64['_is'] == false) {
					return response()->json('forbidden', 422);
				} else {
					// taruh file baru pada storage
					$file_name = $this->photoSave($is_base64['data']);
				}
			} else {
				return response()->json('forbidden', 422);
			}

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

	protected function edit(Request $request, Promo $promo)
	{
		$formData = $request->all();
		// buat validator
		$validator = $this->validateForm($formData);
		if ($validator->fails()) {
			return response()->json($validator->errors(), 422);
		} else {
			/* ----------------------------- mengolah gambar ---------------------------- */
			// cek apa foto base64, dengan mengecek ada tanda koma pada input
			if (strpos($formData['photo'], ',')) {
				// previously
				// $is_base64 = base64_decode($base64_photo, true);
				$is_base64 = $this->is_base64($formData['photo']);
				// validation base64 valid string
				if ($is_base64['_is'] == false) {
					return response()->json('forbidden', 422);
				} else {
					// hapus file lama
					Storage::delete($this->path . explode('/', $formData['photo_origin'])[2]);
					// taruh file baru pada storage
					$file_name = $this->photoSave($is_base64['data']);
				}
			} else {
				$file_name = explode('/', $formData['photo'])[2];
			}
			// $file_photo = base64_decode(, true);

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
		$wa = Contact::firstWhere('name', 'whatsapp');
		// buat link whatsapp lengkap dengan textnya
		$wa_link = $wa->link . $wa->contact . "?text=";

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
	
	/**
	 * is_base64
	 *
	 * @param  mixed $formData_photo
	 * @return array
	 */
	private function is_base64($formData_photo)
	{
		$base64_photo = explode(',', $formData_photo)[1];
		$is_base64 = base64_decode($base64_photo, true);
		return [
			'_is' => $is_base64,
			'data' => $base64_photo
		]; // will return base64 decoded or false boolean
	}
	
	/**
	 * photoSave
	 *
	 * @param  mixed $base64_photo
	 * @return $file_name
	 */
	private function photoSave($base64_photo)
	{
		$file_name = md5(uniqid('promo-') . microtime()) . ".jpg";
		Storage::put($this->path . $file_name, base64_decode($base64_photo)); // taruh file foto dalam folder gallery promo
		return $file_name;
	}

	protected function remove(Request $request)
	{
		$formData = $request->all();
		// buat validator
		$validator = Validator::make($formData, [
			'id' => 'required|max:14'
		]);

		if ($validator->fails()) {
			return response()->json('forbidden', 403);
		} else {
			// ambil informasi detail promo
			$promo = Promo::where('id', $formData['id'])->first()->toArray();
			// hapus foto promo dari system
			Storage::delete($this->path . explode('/', $promo['photo'])[2]);
			// hapus promo dari database
			Promo::find($formData['id'])->delete();
			return response()->json('success');
		}
	}

	protected function removeAll(Promo $promo)
	{
		// truncate 
		$table = $promo->getTable();
		DB::table($table)->truncate();
		// remove all photo
		$allFiles = Storage::allFiles($this->path);
		foreach ($allFiles as $v) {
			Storage::delete($this->path . explode('/', $v)[2]);
		}
		return response()->json('success');
	}
	
	/**
	 * setValidatedFormData
	 *
	 * @param  mixed $id
	 * @param  mixed $file_name
	 * @param  mixed $formData
	 * @return array $formData_validated
	 */
	private function setValidatedFormData($id, $file_name, $formData)
	{
		return [
			'id' => $id,
			'name' => $formData['name'],
			'post' => $formData['post'],
			'period_start' => $formData['period_start'],
			'period_end' => $formData['period_end'],
			'link' => $formData['link'],
			'photo' => $this->path . $file_name
		];
	}
	
	/**
	 * validation rules
	 *
	 * @param  mixed $formData
	 * @return Validator::make
	 */
	private function validateForm($formData)
	{
		return Validator::make($formData, [
			'name' => 'required|min:8',
			'post' => 'required|min:12',
			// NOW perbaiki date_format mengikuti aturan PHP
			'period_start' => 'required|date_format:Y-m-d',
			'period_end' => 'required|date_format:Y-m-d',
			'link' => 'required',
			'photo' => 'required',
		]);
	}
}
