<?php

namespace App\Http\Controllers;

use App\Company_jumbotron;
use App\Displayed_feedback;
use App\Displayed_portfolio;
use App\DisplayedPromo;
use App\Feedback;
use App\Http\Requests\Displayed_feedbackRequest;
use App\Portfolio_type;
use App\Promo;
use App\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelolaHomeController extends Controller
{
    public function index()
    {
        $displayed_promos = DisplayedPromo::all();
        $jumbotrons = Company_jumbotron::get();
        $displayed_portfolios = Displayed_portfolio::with('portfolio')->get();
        $displayed_feedbacks = Displayed_feedback::all();
        $feedbacks = Feedback::whereNotIn('id', $displayed_feedbacks->pluck('feedback_id')->whereNotNull())->get();
        return view('admin.home', compact('jumbotrons', 'displayed_portfolios', 'displayed_feedbacks', 'feedbacks', 'displayed_promos'));
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
        Storage::put("images/jumbotron/" . $fileName, base64_decode($jumbotron_data));

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

    public function displayed_promo()
    {
        $displayed_promo_id = DisplayedPromo::all()->pluck('promo_id');
        $promos = Promo::whereNotIn('id', $displayed_promo_id)->get();
        return view('admin.editdisplayedpromo', compact('promos'));
    }

    public function store_displayed_promo($id)
    {
        $promo = Promo::find($id);
        DisplayedPromo::create([
            'promo_id' => $promo->id
        ]);

        //flash message
        session()->flash('success', 'Promo yang ditampilkan telah ditambah');
        //return back
        return redirect('admin/home');
    }

    public function destroy_displayed_promo($displayed_promo)
    {
        $displayed_promo->update([
            'promo_id' => null
        ]);
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

    public function update_df(Displayed_feedbackRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $photo = str_replace('data:image/png;base64,', '', $request->inputCustomerFile);
        $photo = str_replace(' ', '+', $photo);
        $fileName = 'fb_photo' . $request->dp_id . '.png';
        Storage::put("images/feedback/" . $fileName, base64_decode($photo));

        $attr = [
            'feedback_id' => $request->feedback_id,
            'photo_path' => '/storage/images/feedback/' . $fileName
        ];

        Displayed_feedback::find($request->dp_id)->update($attr);
        session()->flash('success', 'Feedback yang ditampilkan telah diganti.');
        //return back
        return redirect('admin/home');
    }

    public function clear_df(Displayed_feedback $df, User $user)
    {
        $this->authorize('update', $user);

        $photo_path = (explode('/storage', $df->photo_path)[1]);
        \Storage::delete('public' . $photo_path);

        $attr = [
            'feedback_id' => null,
            'photo_path' => null
        ];

        Displayed_feedback::find($df->id)->update($attr);
        session()->flash('success', 'Feedback yang ditampilkan telah direset.');

        return redirect('admin/home');
    }
}
