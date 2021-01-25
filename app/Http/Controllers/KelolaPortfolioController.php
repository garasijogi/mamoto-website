<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests\PortfolioRequest;
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
        return view('admin.showportfolio', compact('portfolio'));
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
}
