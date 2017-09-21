<?php

namespace App\Http\Controllers;


use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = User::all();

        return view('admin.users.index', compact('users')); //return users object to view
        // see php artisan route:list - go to index.blade.php under resources/admin/users/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$roles = Role::lists('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
	    if(trim($request->password) == ''){
		    $input = $request->except('password');

	    } else{
		    $input = $request->all();
		    $input['password'] = bcrypt($request->password);

	    }

    	if ($file = $request->file('photo_id')){
		    $name = time() . $file->getClientOriginalName();

		    $file->move('images', $name);

		    $photo = Photo::create(['file'=>$name]);   //save to Photo table

		    $input['photo_id'] = $photo->id;
	    }

		User::create($input);

	    /* method 1
    	$rules =
		    [
			    'name' => 'required',
			    'email' => 'required',
			    'role_id' => 'required',
			    'is_active' => 'required',
			    'password' => 'required'
		    ];
	    $this->validate($request, $rules);
	    */
	    //User::create($request ->all());
	    return redirect('/admin/users');  //redirect to /admin/users page
        //return $request ->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

	    $user = User::findOrFail($id);
	    $roles = Role::lists('name','id')->all();
	    return view('admin.users.edit', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
	    $user = User::findOrFail($id);

	    if(trim($request->password) == ''){
		    $input = $request->except('password');
	    } else{
		    $input = $request->all();
		    $input['password'] = bcrypt($request->password);
	    }


	    if($file = $request->file('photo_id')){
		    $name = time() . $file->getClientOriginalName();
		    $file->move('images', $name);
		    $photo = Photo::create(['file'=>$name]);
		    $input['photo_id'] = $photo->id;
	    }

	    $user->update($input);

	    return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
