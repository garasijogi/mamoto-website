<?php

namespace App\Http\Controllers;

use Request;
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
        // return view('posts.show', compact('post', 'posts'));
    }

    public function create()
    {
        return view('admin.createportfolio');
    }

    public function store(PortfolioRequest $request)
    {
        // imagesList
        if ($request->hasfile('fileList')) {
            foreach ($request->file('fileList') as $index => $image) {
                $images_data[$index]['id'] = $index + 1;
                $images_data[$index]['name'] = $image->getClientOriginalName();
                $images_data[$index]['type'] = $image->getClientOriginalExtension();
                $images_data[$index]['size'] = $image->getSize();
                $images_data[$index]['date_uploaded'] = date('d-m-Y');
                $image->storeAs("public/images/portfolio/" . request('pfType_id') . '/' . \Str::slug(request('name')), "{$images_data[$index]['name']}");
            }
            $imagesList = json_encode($images_data);
        }

        // videoList
        if ($request->hasfile('videoList')) {
            foreach ($request->file('videoList') as $index => $video) {
                $videos_data[$index]['id'] = $index + 1;
                $videos_data[$index]['name'] = $video->getClientOriginalName();
                $videos_data[$index]['type'] = $video->getClientOriginalExtension();
                $videos_data[$index]['size'] = $video->getSize();
                $videos_data[$index]['date_uploaded'] = date('d-m-Y');
            }
            $videosList = json_encode($videos_data);
        } else {
            $videosList = null;
        }

        // create details json
        $details = [
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
            'photo' => $imagesList,
            'slug' => \Str::slug(request('name')),
        ];

        // dd($attr);
        //create new portfolio
        Portfolio::create($attr);
        // flash message
        session()->flash('success', 'Portfolio berhasil ditambah');
        //return back
        return redirect('admin/portfolio');
    }

    public function edit(Portfolio $portfolio)
    {
        // dd($portfolio);
        foreach (json_decode($portfolio->details) as $key => $d) {
            $details[$key] = $d;
        }
        return view('admin.editportfolio', compact('portfolio', 'details'));
    }

    public function update(PortfolioEditRequest $request, Portfolio $portfolio)
    {
        //authorize
        $this->authorize('update', $portfolio);
        $photoArray = json_decode($portfolio->photo, true);
        // dd($photoArray);

        // delete image if requests exist
        if (isset($request->imgDel)) {
            foreach ($request->imgDel as $imgDel) {
                \Storage::delete('public/images/portfolio/' . $portfolio->pfType_id . '/' . $portfolio->slug . '/' . $photoArray[$imgDel]['name']);
                unset($photoArray[$imgDel]);
            };
            $photoArray = \array_values($photoArray);
        }

        //add image if requests exist
        if ($request->hasfile('fileList')) {
            foreach ($request->file('fileList') as $index => $image) {
                $images_data[$index]['id'] = $index + 1;
                $images_data[$index]['name'] = $image->getClientOriginalName();
                $images_data[$index]['type'] = $image->getClientOriginalExtension();
                $images_data[$index]['size'] = $image->getSize();
                $images_data[$index]['date_uploaded'] = date('d-m-Y');
                $image->storeAs("public/images/portfolio/" . request('pfType_id') . '/' . \Str::slug(request('name')), "{$images_data[$index]['name']}");
            }
            $photoArray = array_merge($photoArray, $images_data);
            $photoArray = json_decode(json_encode($photoArray), true);
        }

        foreach ($photoArray as $index => $pa) {
            $photoArray[$index]['id'] = $index + 1;
        }
        $photoArray = json_encode($photoArray);

        //add video if requests exist
        if ($request->hasfile('videoList')) {
            foreach ($request->file('videoList') as $index => $video) {
                $videos_data[$index]['id'] = $index + 1;
                $videos_data[$index]['name'] = $video->getClientOriginalName();
                $videos_data[$index]['type'] = $video->getClientOriginalExtension();
                $videos_data[$index]['size'] = $video->getSize();
                $videos_data[$index]['date_uploaded'] = date('d-m-Y');
            }
            $videosList = json_encode($videos_data);
        } else {
            $videosList = null;
        }

        // create details json
        $details = [
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
            'photo' => $photoArray,
            'slug' => \Str::slug(request('name')),
        ];
        $portfolio->update($attr);
        //flash message
        session()->flash('success', 'Portfolio telah diperbarui');
        //return back
        return redirect('admin/portfolio/' . $attr['slug']);
    }

    public function destroy(Portfolio $portfolio)
    {
        \Storage::deleteDirectory('public/images/portfolio/' . $portfolio->pfType_id . '/' . $portfolio->slug);
        $this->authorize('delete', $portfolio);
        $portfolio->delete();
        session()->flash('error', 'Portfolio telah dihapus');
        return redirect('admin/portfolio');
    }
}
