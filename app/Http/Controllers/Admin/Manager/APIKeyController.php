<?php

namespace App\Http\Controllers\Admin\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Manager\APIKey;
use Auth;
use Session;

class APIKeyController extends Controller
{
    public function index() {
        $apikeys = APIKey::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('admin.account.apikey.index')->with([
            'apikeys' => $apikeys
        ]);
    }

    public function show ($key) {
        $apikey = APIKey::where('key', $key)->first();

        return view('admin.account.apikey.show')->with([
            'apikey' => $apikey
        ]);
    }

    public function create() {
        return view('admin.account.apikey.create');
    }

    public function store (Request $request) {
        $this->validate($request, [
            'referrers' => 'check_array:1', // It is a custom validation(Refer to ValidatorServiceProvider).
        ]);

        $apikey = new APIKey();
        $apikey->key = md5(microtime().rand());
        $apikey->user_id = Auth::id();
        $apikey->save();

        $referrersToSave = [];
        foreach($request->referrers as $referrer) {
            $referrersToSave[] = new \App\Models\Admin\Manager\Referrer([
                'referrer' => $referrer
            ]);
        }

        $apikey->referrers()->saveMany($referrersToSave);

        Session::flash('success', 'Successfully created a new API key.');

        return redirect()->route('admin.account.apikeys.index');
    }

    public function edit ($key) {
        $apikey = APIKey::where('key', $key)->first();

        return view('admin.account.apikey.edit')->with([
            'apikey' => $apikey
        ]);
    }

    public function update (Request $request, $key) {
        $this->validate($request, [
            'referrers' => 'check_array:1'
        ]);

        $apikey = APIKey::where('key', $key)->first();
        $apikey->referrers()->delete();

        $referrersToSave = [];
        foreach($request->referrers as $referrer) {
            if ($referrer) {
                $referrersToSave[] = new \App\Models\Admin\Manager\Referrer([
                    'referrer' => $referrer
                ]);
            }
        }

        $apikey->referrers()->saveMany($referrersToSave);

        Session::flash('success', 'Successfully updated the API key.');

        return redirect()->route('admin.account.apikeys.edit', $key);
    }

    public function destroy ($key) {
        $apikey = APIKey::where('key', $key)->first();
        $apikey->referrers()->delete();
        $apikey->delete();

        Session::flash('success', 'Successfully deleted the API key.');

        return redirect()->route('admin.account.apikeys.index');
    }
}
