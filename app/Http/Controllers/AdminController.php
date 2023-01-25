<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quote;
use App\Models\Currency\Currency;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $users=User::role(['Super Admin', 'Administrador'])->count();
        $customers=User::role(['Cliente'])->count();
        $quotes=Quote::count();
        $currencies=Currency::count();
        return view('admin.home', compact('users', 'customers', 'quotes', 'currencies'));
    }

    public function profile() {
        return view('admin.profile');
    }

    public function profileEdit() {
        return view('admin.edit');
    }

    public function profileUpdate(ProfileUpdateRequest $request) {
        $user=User::where('slug', Auth::user()->slug)->firstOrFail();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'));

        if (!is_null(request('password'))) {
            $data['password']=Hash::make(request('password'));
        }

        $user->fill($data)->save();

        if ($user) {
            // Mover imagen a carpeta users y extraer nombre
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $photo=store_files($file, $user->slug, '/img/users/');
                $user->fill(['photo' => $photo])->save();
                Auth::user()->photo=$photo;
            }
            Auth::user()->slug=$user->slug;
            Auth::user()->name=request('name');
            Auth::user()->lastname=request('lastname');
            Auth::user()->phone=request('phone');
            if (!is_null(request('password'))) {
                Auth::user()->password=Hash::make(request('password'));
            }
            return redirect()->route('profile.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El perfil ha sido editado exitosamente.']);
        } else {
            return redirect()->route('profile.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInput();
        }
    }

    public function emailVerifyAdmin(Request $request, $slug=NULL)
    {
        if (!is_null($slug)) {
            $ignore=User::where('slug', $slug)->withTrashed()->first();
            if (!is_null($ignore)) {
                $count=User::where([['id', '!=', $ignore->id], ['email', request('email')]])->count();
                if ($count>0) {
                    return "false";
                } else {
                    return "true";
                }
            }
        }
        
        $count=User::where('email', request('email'))->count();
        if ($count>0) {
            return "false";
        } else {
            return "true";
        }
    }
}
