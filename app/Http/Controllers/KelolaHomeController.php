<?php

namespace App\Http\Controllers;

use App\Company_jumbotron;
use App\Displayed_portfolio;
use App\Portfolio_type;
use App\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelolaHomeController extends Controller
{
    public function index()
    {
        $jumbotrons = Company_jumbotron::get();
        $displayed_portfolios = Displayed_portfolio::with('portfolio')->get();
        return view('admin.home', compact('jumbotrons', 'displayed_portfolios'));
    }

    public function jumbotron()
    {
        $jumbotrons = Company_jumbotron::get();
        return view('admin.editjumbotron', compact('jumbotrons'));
    }

    public function update_jumbotron(User $user, Request $request, Company_jumbotron $jumbotron)
    {
        // process jumbotron 
        switch ($jumbotron->id) {
            case 1:
                $jumbotron_data = $request->jumbo1cropped;
                break;
            case 2:
                $jumbotron_data = $request->jumbo2cropped;
                break;
            case 3:
                $jumbotron_data = $request->jumbo3cropped;
                break;
            case 4:
                $jumbotron_data = $request->jumbo4cropped;
                break;
            default:
                alert('error');
        };

        $jumbotron_data = str_replace('data:image/png;base64,', '', $jumbotron_data);
        $jumbotron_data = str_replace(' ', '+', $jumbotron_data);
        $fileName = 'jumbotron' . $jumbotron->id . '.png';
        Storage::put("public/images/jumbotron/" . $fileName, base64_decode($jumbotron_data));

        //update data jumbotron
        $this->authorize('update', $user);
        //assign request to attr
        $attr['path'] = "/storage/images/jumbotron/" . $fileName;
        //update the user
        $jumbotron->update($attr);
        //flash message
        session()->flash('success', 'Foto Jumbotron ' . $jumbotron->id . ' telah diperbarui');
        //return back
        return redirect('admin/jumbotron');
    }

    public function displayed_portfolio($id, Portfolio_type $portfolio_type)
    {
        $portfolios = $portfolio_type->find($id)->portfolios()->latest()->paginate(10);
        $pftype = $id;
        return view('admin.editdisplayedportfolio', compact('portfolios', 'pftype'));
    }

    public function update_dp(Request $request, User $user, $pftype)
    {
        $dp = Displayed_portfolio::where('pfType_id', $pftype)->get()->first();
        $this->authorize('update', $user);
        $attr['portfolio_id'] = intval($request->selected_portfolio);
        $dp->update($attr);
        //flash message
        session()->flash('success', 'Portfolio yang ditampilkan telah diganti');
        //return back
        return redirect('admin/home');
    }
}
