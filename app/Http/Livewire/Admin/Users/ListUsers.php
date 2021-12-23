<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

//models
use App\Models\User;

use function PHPUnit\Framework\isEmpty;

class ListUsers extends Component
{
    // One way to bind variables
    public $name, $email, $password, $password_confirmation, $show_edit_modal = false, $user;

    // another cleaner way to get variables. Just use "wire:model.defer=state.name" instead of "wire:model.defer=name"
    // public $state = [];

    // Validation rules
    protected $rules = [
        'name' => ['required', 'min:6'],
        'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'min:8', 'confirmed'],
        'password_confirmation' => ['required', 'min:8'],
    ];

    // Uses event listener that triggers the show-form listener in app.blade.php
    public function addNewUser(){
        $this->show_edit_modal = true;
        $this->name = null;
        $this->email = null;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser(){
        // Validation if you use $state
        // validator::make($this->state, [
            // 'name' => ['required', 'min:6'],
            // 'email' => ['required', 'email', 'unique:users'],
            // 'password' => ['required', 'min:8', 'confirmed'],
            // 'password_confirmation' => ['required', 'min:8'],
            // OR
            // 'name' => 'required|min:6',
            // 'email' => 'required|email|unique:users',
            // 'password' => 'required|min:8|confirmed',
            // 'password_confirmation' => 'required|min:8',
        // ])->validate();

        // dd($this->state);

        // Validate using $rules
        $this->validate();

        // dd($this->name, $this->email, $this->password, $this->password_confirmation);

        User::Create([
            'name'=> $this->name,
            'email'=> $this->email,
            'password'=> Hash::make($this->password),
        ]);

        $this->dispatchBrowserEvent('hide-form', [ 'message' => 'User Added Successfully.']);

        // For bootstrap only
        // session()->flash('message', 'User Added Successfully.');
    }

    public function editUser(User $user){
        $this->show_edit_modal = false;

        // for using $state variable if you want
        // $this->state = $user->only('name', 'email')->toArray();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->user = $user;    
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser(){

        $this->validate([
            'name' => ['required', 'min:6'],
            'email' => ['required', 'email', 'unique:users,email,'.$this->user->id.',id'],
            // 'password' => ['sometimes', 'min:8', 'confirmed'],
            // 'password_confirmation' => ['sometimes', 'min:8'],
        ]);

        if(empty($this->password)){
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
        }
        else{
            $this->validate([
                'password' => ['min:8', 'confirmed'],
                'password_confirmation' => ['min:8'],
            ]);

            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
        }

        // dd("Update Hit !");
        $this->dispatchBrowserEvent('hide-form', [ 'message' => 'User Updated Successfully.']);
    }

    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.users.list-users', compact('users'))->layout('admin.partials.app');
    }
}
