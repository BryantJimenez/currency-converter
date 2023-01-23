<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Account;
use App\Models\Contact;
use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Http\Requests\Customer\CustomerContactStoreRequest;
use App\Http\Requests\Customer\CustomerAccountStoreRequest;
use App\Http\Requests\Customer\CustomerAccountUpdateRequest;
use Illuminate\Http\Request;
use Exception;
use Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users=User::role(['Cliente'])->orderBy('id', 'DESC')->get();
        $customers=User::role(['Cliente'])->where('state', '1')->orderBy('name', 'ASC')->get();
        return view('admin.customers.index', compact('users', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $countries=Country::orderBy('name', 'ASC')->get();
        return view('admin.customers.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request) {
        $country=Country::where('code', request('country_id'))->first();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'dni' => request('dni'), 'email' => request('email'), 'phone' => request('phone'), 'address' => request('address'), 'country_id' => $country->id);
        $user=User::create($data);

        if ($user) {
            $user->assignRole('Cliente');

            try {
                if (request('account_question')=='1') {
                    Account::create(['number' => request('number'), 'bank' => request('bank'), 'user_id' => $user->id]);
                }
            } catch (Exception $e) {
                Log::error('CustomerController@store - Store Customer Account Exception: '.$e->getMessage());
            }

            // Mover imagen a carpeta users y extraer nombre
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $photo=store_files($file, $user->slug, '/img/users/');
                $user->fill(['photo' => $photo])->save();
            }

            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El cliente ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('customers.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        $customers=User::role(['Cliente'])->where('state', '1')->orderBy('name', 'ASC')->get();
        return view('admin.customers.show', compact('user', 'customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        $countries=Country::orderBy('name', 'ASC')->get();
        return view('admin.customers.edit', compact('user', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, User $user) {
        $country=Country::where('code', request('country_id'))->first();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'dni' => request('dni'), 'email' => request('email'), 'phone' => request('phone'), 'address' => request('address'), 'country_id' => $country->id);
        $user->fill($data)->save();

        if ($user) {
            $user->syncRoles(['Cliente']);

            // Mover imagen a carpeta users y extraer nombre
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $photo=store_files($file, $user->slug, '/img/users/');
                $user->fill(['photo' => $photo])->save();
            }

            return redirect()->route('customers.edit', ['user' => $user->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cliente ha sido editado exitosamente.']);
        } else {
            return redirect()->route('customers.edit', ['user' => $user->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        if ($user) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El cliente ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('customers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, User $user) {
        $user->fill(['state' => "0"])->save();
        if ($user) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cliente ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('customers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, User $user) {
        $user->fill(['state' => "1"])->save();
        if ($user) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cliente ha sido activado exitosamente.']);
        } else {
            return redirect()->route('customers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function storeContact(CustomerContactStoreRequest $request, User $user) {
        $customer=User::where('slug', request('customer_id'))->first();
        $exist=Contact::where([['user_id', $user->id], ['user_destination_id', $customer->id]])->exists();
        if ($exist) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'El contacto ya existe', 'msg' => 'El cliente ya tiene agregado a este contacto.']);
        }

        $contact=Contact::create(['alias' => request('destination_alias'), 'user_id' => $user->id, 'user_destination_id' => $customer->id]);
        if ($contact) {
            try {
                $exist=Contact::where([['user_id', $customer->id], ['user_destination_id', $user->id]])->exists();
                if (!$exist) {
                    Contact::create(['alias' => request('user_alias'), 'user_id' => $customer->id, 'user_destination_id' => $user->id]);
                }
            } catch (Exception $e) {
                Log::error('CustomerController@contactStore - Store Contact Reverse Exception: '.$e->getMessage());
            }

            return redirect()->back()->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El contacto ha sido agregado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function storeAccount(CustomerAccountStoreRequest $request, User $user) {
        $account=Account::create(['number' => request('number'), 'bank' => request('bank'), 'user_id' => $user->id]);
        if ($account) {
            return redirect()->back()->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La cuenta bancaria ha sido agregada exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function updateAccount(CustomerAccountUpdateRequest $request, User $user, Account $account) {
        $account->fill(['number' => request('number'), 'bank' => request('bank')])->save();
        if ($account) {
            return redirect()->back()->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La cuenta bancaria ha sido editada exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function getAccounts(Request $request){
        if (request()->has('customer_id')) {
            $customer=User::role(['Cliente'])->where('slug', request('customer_id'))->first();
            if (!is_null($customer)) {
                $accounts=$customer->accounts()->select('number', 'slug', 'bank')->where('state', '1')->get();
                return response()->json(['status' => true, 'data' => $accounts]);
            }
        } else {
            $accounts=Account::select('number', 'slug', 'bank')->where('state', '1')->get();
            return response()->json(['status' => true, 'data' => $accounts]);
        }
        return response()->json(['status' => false, 'message' => 'Ha ocurrido un problema, intentelo nuevamente.']);
    }
}
