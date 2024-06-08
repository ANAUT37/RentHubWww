<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Particular;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index(Request $request): View
    {

        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }


    public function edit(Request $request)
    {
        $user = $request->user();
        $particularData=Particular::getParticularData($user->id);
    
        if ($request->isMethod('post')) {
            $userData = $request->all();

            $userKeys = ['email', 'phone'];
            $particularKeys = ['name','surname','genre','description','job','location','lenguage'];
    
            foreach ($userData as $key => $value) {
                if (!empty($value) && in_array($key, $userKeys)) {
                    $user->{$key} = $value;
                }else if(!empty($value)&& in_array($key, $particularKeys)){
                    $particularData->{$key}=$value;
                }
            }
            
            $user->save();
            $particularData->save();
        }
    
        return redirect()->back();
    }
    

    public function show(Request $request, $display_id)
    {
        $userData = User::getDataByDisplayId($display_id);
        if ($userData != null) {
            return view('profile.particular', compact('display_id', 'userData'));
        } else {
            return view('errors.404'); // Redirige a la vista de error 404
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
