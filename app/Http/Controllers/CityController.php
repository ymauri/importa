<?php

namespace App\Http\Controllers;

use App\Address;
use App\City;
use App\User;
use App\Http\Requests\UserRequest;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CityController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  null
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $address = new Address();
        return view('city.index', compact('address'));
    }

    /**
     * Show the form for creating a new city
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('city.create');
    }

    /**
     * Get all state by id country
     * @param request
     * @return json
     */
    public function searchState($id)
    {
        $state = State::where('id_country',$id)->get();
            return response($state);
    }

    /**
     * Insert city by state and country
     * @param request
     * @return json
     */
    public function insert(Request $request)
    {
        $data = $request->all();
        $city = array(
                    'name' => $data['name_city'],
                    'id_state' => $data['id_state'],
                );
        $city_search = City::where('name',$city['name'])
                    ->where('id_state',$city['id_state'])
                    ->first();
        if(empty($city_search)) {
            City::create($city);
            flash('Datos guarados correctamente.')->success();
            return  redirect(route('city.index'));

        }
        flash('Ya existe '.$city['name'].' en el estado '.$data['id_state'].'.')->success();
        return  redirect(route('city.index'));
    }




    public function store(Request $request)
    {
        dd($request->all());

      //  $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updates(UserRequest $request, User  $user)
    {
        $hasPassword = $request->get('password');
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$hasPassword ? '' : 'password']
        ));

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }

}
