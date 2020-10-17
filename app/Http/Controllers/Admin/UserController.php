<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @var string
     */
    private $redirectRoute = 'admin.users.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name');

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        return view('admin.user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRulesForCreate());

        $user = new User($request->only($this->getFillableFields()));
        $user->password = Hash::make($request->get('password'));
        $user->save();

        flash()->success(__('user.admin.create.success'));

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $isEmailVerified = $user->hasVerifiedEmail();

        return view('admin.user.edit', compact('user', 'isEmailVerified'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = $this->getValidationRulesForUpdate();
        $rules['name'] .= ',' . $user->id;
        $rules['email'] .= ',' . $user->id;

        $request->validate($rules);

        $isEmailVerified = $request->get('is_email_verified');

        $user->is_admin = $request->get('is_admin');

        $user->fill($request->only($this->getFillableFields()));

        if (!empty($request->get('password'))) {
            $user->password = Hash::make($request->get('password'));
        }

        if (!$isEmailVerified) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($isEmailVerified) {
            $user->markEmailAsVerified();
        }

        flash()->success(__('user.admin.edit.success'));

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($user->id == auth()->user()->id) {
            flash()->error(__('user.admin.destroy.you_cannot_delete_your_own_account'));
        } else if ($user->is_admin) {
            flash()->error(__('user.admin.destroy.administrators_cannot_be_deleted'));
        } else {
            $user->loginAttempts()->delete();
            $user->databaseSessions()->delete();
            $user->delete();

            flash()->success(__('user.admin.destroy.success'));
        }

        return redirect()->route($this->redirectRoute);
    }

    /**
     * @return array
     */
    private function getFillableFields()
    {
        return [
            'name',
            'email',
            'is_admin',
        ];
    }

    /**
     * @return array
     */
    protected function getValidationRulesForCreate()
    {
        return $this->getValidationRules(true);
    }

    /**
     * @return array
     */
    protected function getValidationRulesForUpdate()
    {
        return $this->getValidationRules(false);
    }

    /**
     * @return array
     */
    protected function getValidationRules($isForCreate)
    {
        $passwordValidationRules = $isForCreate ? 'required|min:6' : 'nullable|min:6';

        return [
            'name' => 'required|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => $passwordValidationRules,
            'is_admin' => 'boolean',
            'is_email_verified' => 'sometimes|boolean',
        ];
    }
}
