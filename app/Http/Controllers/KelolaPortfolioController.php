<?php

namespace App\Http\Controllers;

use App\Http\Requests\{PortfolioRequest, PortfolioEditRequest};
use App\{Portfolio, Portfolio_type};

class KelolaPortfolioController extends Controller
{
    public function index(Portfolio_type $portfolio_types)
    {
        $portfolios = [
            'w' => $portfolio_types->find('W')->portfolios()->limit(10)->latest()->paginate(10),
            'prew' => $portfolio_types->find('preW')->portfolios()->limit(10)->latest()->paginate(10),
            's' => $portfolio_types->find('S')->portfolios()->limit(10)->latest()->paginate(10),
            'l' => $portfolio_types->find('L')->portfolios()->limit(10)->latest()->paginate(10),
        ];

        return view('admin.portfolio', compact('portfolios'));
    }

    public function show(Portfolio $portfolio)
    {
        $jenis_portfolio = '';
        switch ($portfolio->pfType_id) {
            case 'W':
                $jenis_portfolio = 'Wedding';
                break;
            case 'preW':
                $jenis_portfolio = 'Pre-Wedding';
                break;
            case 's':
                $jenis_portfolio = 'Siraman/Pengajian';
                break;
            case 'l':
                $jenis_portfolio = 'Lamaran';
                break;
        }

        return view('admin.showportfolio', compact('portfolio', 'jenis_portfolio'));
    }

    public function create()
    {
        return view('admin.createportfolio');
    }

    public function save($request, $portfolio = null)
    {
        // get photo
        $photoArray = $portfolio ? json_decode($portfolio->photo, true) : $request->file('fileList');

        // delete image if requests exist
        if (isset($request->imgDel)) {
            foreach ($request->imgDel as $imgDel) {
                if($portfolio) {
                    \Storage::delete('images/portfolio/' . $portfolio->pfType_id . '/' . $portfolio->slug . '/' . $photoArray[$imgDel]['name']);
                }

                unset($photoArray[$imgDel]);
            };
            
            $photoArray = \array_values($photoArray);
        }

        // imagesList
        if ($request->hasfile('fileList')) {
            foreach ($request->file('fileList') as $index => $image) {
                $images_data[$index]['id'] = $index + 1;
                $images_data[$index]['name'] = $image->getClientOriginalName();
                $images_data[$index]['type'] = $image->getClientOriginalExtension();
                $images_data[$index]['size'] = $image->getSize();
                $images_data[$index]['date_uploaded'] = date('d-m-Y');

                $directory_path = get_path("storage/images/portfolio/" . request('pfType_id') . '/' . \Str::slug(request('name')));
                $path = get_path("{$directory_path}/{$images_data[$index]['name']}");

                check_folder(get_path("storage/images/portfolio/"));
                check_folder(get_path("storage/images/portfolio/" . request('pfType_id')));
                check_folder($directory_path);

                (compress_image($image))->toFile($path);
            }

            if($portfolio) {
                $photoArray = array_merge($photoArray, $images_data);
                $photoArray = json_decode(json_encode($photoArray), true);

                foreach ($photoArray as $index => $pa) {
                    $photoArray[$index]['id'] = $index + 1;
                }

                $images_data = $photoArray;
            }

            $imagesList = json_encode($images_data);
        }

        // input videos
        $videosList = $request->video[1] ? $this->insert_video($request->video) : null;

        // create details json
        $details = [
            'location' => ucwords(request('location')),
            'venue' => request('venue'),
            'photo-&-video' => request('pv'),
            'make-up' => request('makeup'),
            'decoration' => request('decoration'),
            'attire' => request('attire'),
            'henna' => request('henna'),
            'w-o' => request('wo'),
            'lighting' => request('lighting'),
        ];
        $details = json_encode($details);

        //assign request to attr
        $attr = [
            'pfType_id' => request('pfType_id'),
            'name' => request('name'),
            'details' => $details,
            'video' => $videosList,
            'date' => request('date'),
            'photo' => $imagesList ?? $photoArray,
            'slug' => \Str::slug(request('name')),
        ];

        // input portfolio data
        $portfolio ? $portfolio->update($attr) : Portfolio::create($attr);

        if($portfolio) {
            return $attr['slug'];
        }
    }

    public function store(PortfolioRequest $request)
    {
        $this->save($request);

        // flash message
        session()->flash('success', 'Portfolio berhasil ditambah');

        //return back
        return redirect('admin/portfolio');
    }

    public function edit(Portfolio $portfolio)
    {
        foreach (json_decode($portfolio->details) as $key => $d) {
            $details[$key] = $d;
        }

        return view('admin.editportfolio', compact('portfolio', 'details'));
    }

    public function update(PortfolioEditRequest $request, Portfolio $portfolio)
    {
        //authorize
        $this->authorize('update', $portfolio);
        
        $slug = $this->save($request, $portfolio);

        //flash message
        session()->flash('success', 'Portfolio telah diperbarui');
        
        //return back
        return redirect("admin/portfolio/{$slug}");
    }

    public function destroy(Portfolio $portfolio)
    {
        \Storage::deleteDirectory('images/portfolio/' . $portfolio->pfType_id . '/' . $portfolio->slug);
        $this->authorize('delete', $portfolio);
        $portfolio->delete();
        session()->flash('error', 'Portfolio telah dihapus');
        return redirect('admin/portfolio');
    }

    public function insert_video($data) {
        foreach($data as $index => $video) {
            $videoData[$index]['id'] = $index;
            $videoData[$index]['link'] = $video;
        }

        return json_encode(array_merge([], $videoData));
    }
}
