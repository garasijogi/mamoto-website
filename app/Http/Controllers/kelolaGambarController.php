<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class kelolaGambarController extends Controller
{
	/**
	 * get index photos with pagination
	 *
	 * @return void
	 */
	public function getIndex()
	{
		// prepare the variables
		$path = $_GET['path'];
		$index = $_GET['index'];
		$paginate = $_GET['page'];
		$url_getIndex = $_GET['url_getIndex'];
		$url_getNextPage = $_GET['url_getNextPage'];
		$url_path = $_GET['url_path'];
		$file_index = $path . $index;

		// get json index file, if exists
		if (Storage::disk('public')->exists($file_index)) {
			// get the data gallery from json file
			$data_gallery = json_decode(Storage::get($file_index), true);
			// paginate the data gallery
			$pageTo = ($paginate * 24) - 24;
			// slice the array for pagination
			$data_gallery = array_slice($data_gallery, $pageTo, 24);
			// add attribute for summernote-gallery
			foreach ($data_gallery as $k => $v) {
				$data_gallery[$k]['src'] = $url_path . "/" . $v['name'];
				$data_gallery[$k]['title'] = $v['name_origin'];
			}
		} else {
			// just make null data gallery
			$data_gallery = [];
		}

		// I copied from the plugins settings
		$page = isset($_GET['page']) && $_GET['page'] ? intval($_GET['page']) : 1;
		// prepare the data
		$data = array(
			'data' => $data_gallery,
			'links' => array(
				'next' => null
			)
		);

		// look for another page 
		if (count($data_gallery) == 24) {
			$data['links']['next'] = $url_getIndex . '?page=' . ++$page .
				"&path=" . $path .
				"&index=" . $index .
				"&url_getIndex=" . $url_getIndex .
				"&url_getNextPage=" . $url_getNextPage .
				"&url_path=" . $url_path .
				"&path=" . $path;
		} else {
			$data['links']['next'] = null;
		}

		// header('Content-Type: application/json');
		return $data;
	}

	/**
	 * upload file ke systen storage
	 *
	 * @return void
	 */
	public function upload()
	{
		if (isset($_FILES["myfile"])) {
			// $path = $_SERVER["DOCUMENT_ROOT"].request('path'); // ambil path
			$path = request('path');
			$index = request('index');
			$file_index = $path . $index; // ambil galeri penyimpan nama foto

			// dd($path);
			// dd(request()->file('myfile')->getClientOriginalName());

			$file = request()->file('myfile');
			// ambil file extension
			// $fileExtension = pathinfo($_FILES['myfile']['name'], PATHINFO_EXTENSION); 
			$fileExtension = $file->extension();
			// generate unique filename
			do {
				$file_name = md5($_FILES['myfile']['name'] . microtime()) . "." . $fileExtension;
				// } while (file_exists($path.$fileName) == true);
			} while (Storage::disk('public')->exists($path . $file_name) == true);
			$path_file = $file->storeAs("{$path}", "{$file_name}");

			$this->addIndexData(
				$file_index,
				$file_name,
				$file->getClientOriginalName(),
				$file->getMimeType(),
				$file->getSize()
			);
			$ret = array();
			$ret[] = $file_name;


			//	This is for custom errors;	
			/*	$custom_error= array();
                    $custom_error['jquery-upload-file-error']="File already exists";
                    echo json_encode($custom_error);
                    die();
                    */
			$error = $_FILES["myfile"]["error"];

			// taruh file informasi json ke dalam file
			echo json_encode($ret);
		}
	}

	/**
	 * remove the photos and index
	 *
	 * @return void
	 */
	public function removeIndex()
	{
		$id = request('id');
		$path = request('path');
		$index = request('index');
		$file_index = $path . $index;
		$file = $path."/".$id;

		if (Storage::disk('public')->exists($file_index)) {
			$data_gallery = json_decode(Storage::get($file_index), true);
			// cari nama foto dalam variable multi dimensional $data_gallery
			if (($key = array_search($id, array_column($data_gallery, 'name'))) !== false) {
				unset($data_gallery[$key]);
				// $data_galleryNew = array_values($data_gallery); // reindex array
				$data_galleryNew = $data_gallery;
				Storage::delete([$file, $file_index]); // hapus file foto dan file indexnya
				Storage::put($file_index, json_encode($data_galleryNew)); // taruh file index baru dalam file json
			}
		} else {
			return 0;
		}
		return 1;
	}

	/* -------------------------------------------------------------------------- */
	/*                               other function                               */
	/* -------------------------------------------------------------------------- */
	/**
	 * update data index ke file json
	 *
	 * @return void
	 */
	public function addIndexData(
		$file_index,
		$file_name,
		$file_originName,
		$file_type,
		$file_size
	) {
		$data_file = array(
			'name'        => $file_name,
			'name_origin' => $file_originName,
			'type'        => $file_type,
			'size'        => $file_size
		);
		// cek apa file json ada di path?, untuk membuat file json
		if (Storage::disk('public')->exists($file_index)) {
			$data_gallery = json_decode(Storage::get($file_index), true);
			$data_gallery[array_key_last($data_gallery) + 1] = $data_file;
			Storage::delete($file_index);
		} else {
			$data_gallery[0] = $data_file;
		}

		$data_galleryNew = array_values($data_gallery); //reindex array, buat file yg sudah terhapus
		// tulis kembali file json ke dalam file
		// file_put_contents($file_index, json_encode($data_gallery));
		Storage::put($file_index, json_encode($data_galleryNew));
	}
}
