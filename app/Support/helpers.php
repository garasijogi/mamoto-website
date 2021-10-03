<?php

use Illuminate\Support\Facades\File;

if (!function_exists('compress_image')) {
  function compress_image($data, $type = 'file') {
    \Tinify\setKey(env("TINIFY_API_KEY"));

    switch($type) {
      case 'buffer' : return \Tinify\fromBuffer($data)->toBuffer();
      case 'url'    : return \Tinify\fromUrl($data);
      default       : return \Tinify\fromFile($data);
    }
  }
}

if (!function_exists('get_path')) {
  function get_path($path) {
    return str_replace('/', DIRECTORY_SEPARATOR, $path);
  }
}

if(!function_exists('check_folder')) {
  function check_folder($path) {
    if (!File::exists($path)) {
      File::makeDirectory($path);
    }
  }
}

