<?php

namespace App\Http\Livewire\Profile;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileComponent extends Component
{

    use WithFileUploads;

    public $user, $avatar, $name, $description, $temporary;

    public $nameUser, $firstLastname, $secondLastname, $phone, $email, $corporative;

    public $profile, $birthday, $facebook, $instagram, $github, $website, $other;

    public $password, $password1, $password1_confirmation;

    public $status, $text;

    public $rules = [
        'temporary'     => 'image|mimes:jpeg,png|max:4096',
        'name'          => 'required|string|max:200|unique:users,name',
        'description'   => 'required|string|max:500',

        'nameUser'          => 'required|string|max:200',
        'firstLastname'     => 'required|string|max:200',
        'secondLastname'    => 'required|string|max:200',
        'phone'             => 'required|numeric|unique:users,phone',
        'email'             => 'required|email|unique:users,email',
        'corporative'       => 'required|email|unique:users,corporative',

        'birthday'     => 'date|nullable',
        'facebook'     => 'string|max:200|nullable|unique:profiles,facebook',
        'instagram'    => 'string|max:200|nullable|unique:profiles,instagram',
        'github'       => 'string|max:200|nullable|unique:profiles,github',
        'website'      => 'string|max:200|nullable|unique:profiles,website',
        'other'        => 'string|max:200|nullable|unique:profiles,other',

        'password'    => 'required|password|min:8|max:100',
        'password1'   => 'required|password|min:8|max:100|confirmed',
        'password1_confirmation'   => 'required|password|min:8|max:100',

        'status'     => 'required',
    ];

    protected $validationAttributes = [
        'temporary'     => 'imagen de perfil',
        'name'          => 'nombre de usuario',
        'description'   => 'descripción',

        'nameUser'          => 'nombre',
        'firstLastname'     => 'primer apellido',
        'secondLastname'    => 'segundo apellido',
        'phone'             => 'telefono',
        'email'             => 'email personal',
        'corporative'       => 'email corporativo',

        'birthday'   => 'fecha de nacimiento',
        'facebook'   => 'facebook',
        'instagram'  => 'instagram',
        'github'     => 'github',
        'website'    => 'sitio web',
        'other'      => 'otra red social',

        'password'   => 'contraseña actual',
        'password1'  => 'contraseña nueva',
        'password1_confirmation'  => 'confirmar contraseña',

        'status'    => 'estado',
    ];

    /* protected $messages = [
        'password.*'    => 'Es necesario que ingrese su contraseña actual.',
        'password1.*'   => 'El campo de contraseña nueva y de confirmar contraseña no coinciden',
    ]; */

    public function mount()
    {
        $user = Auth::user()->id;
        $this->user       = User::find($user);
        $this->profile    = $this->user->profile;

        $this->name          = $this->user->name;
        $this->avatar        = 'storage/users/' . $this->user->profile->avatar;
        $this->description   = $this->user->profile->description;

        $this->nameUser         = $this->user->nameUser;
        $this->firstLastname    = $this->user->firstLastname;
        $this->secondLastname   = $this->user->secondLastname;
        $this->phone            = $this->user->phone;
        $this->email            = $this->user->email;
        $this->corporative      = $this->user->corporative;
        $this->status           = $this->user->status;

        $this->birthday   = $this->user->profile->birthday;
        $this->facebook   = $this->user->profile->facebook;
        $this->instagram  = $this->user->profile->instagram;
        $this->github     = $this->user->profile->github;
        $this->website    = $this->user->profile->website;
        $this->other      = $this->user->profile->other;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'temporary'     => 'nullable|mimes:jpeg,png|max:4096',
            'name'          => 'required|string|max:200|unique:users,name, ' . $this->user->id,
            'description'   => 'required|string|max:500',

            'nameUser'          => 'required|string|max:200',
            'firstLastname'     => 'required|string|max:200',
            'secondLastname'    => 'required|string|max:200',
            'phone'             => 'required|numeric|unique:users,phone, ' . $this->user->id,
            'email'             => 'required|email|unique:users,email, ' . $this->user->id,
            'corporative'       => 'required|email|unique:users,corporative, ' . $this->user->id,

            'birthday'     => 'date|nullable',
            'facebook'     => 'string|max:200|nullable|unique:profiles,facebook, ' . $this->profile->id,
            'instagram'    => 'string|max:200|nullable|unique:profiles,instagram, ' . $this->profile->id,
            'github'       => 'string|max:200|nullable|unique:profiles,github, ' . $this->profile->id,
            'website'      => 'string|max:200|nullable|unique:profiles,website, ' . $this->profile->id,
            'other'        => 'string|max:200|nullable|unique:profiles,other, ' . $this->profile->id,

            'status'     => 'required',
        ]);
    }

    public function saveAvatar()
    {
        $this->validate([
            'temporary'     => 'nullable|mimes:jpeg,png|max:4096',
            'name'          => 'required|string|max:200|unique:users,name, ' . $this->user->id,
            'description'   => 'required|string|max:500',
        ]);
        if ($this->user->id) {
            $usuario = User::find($this->user->id);
            $usuario->update([
                'name'  => $this->name,
            ]);

            $perfil = $usuario->profile;

            if ($this->temporary) {
                $avatarUser = time() . '_' . $this->temporary->getClientOriginalName();
                $this->temporary->storePubliclyAs('storage/users', $avatarUser, 'public_uploads');

                $perfil->update([
                    'avatar'        => $avatarUser,
                ]);
            }

            $perfil->update([
                'description'   => $this->description,
            ]);
            session()->flash('message1', 'Datos guardados correctamente.');
            $this->clean();
        }
    }

    public function saveUser()
    {
        $this->validate([
            'nameUser'          => 'required|string|max:200',
            'firstLastname'     => 'required|string|max:200',
            'secondLastname'    => 'required|string|max:200',
            'phone'             => 'required|numeric|unique:users,phone, ' . $this->user->id,
            'email'             => 'required|email|unique:users,email, ' . $this->user->id,
            'corporative'       => 'required|email|unique:users,corporative, ' . $this->user->id,
        ]);
        if ($this->user->id) {
            $usuario = User::find($this->user->id);
            $usuario->update([
                'nameUser'       => $this->nameUser,
                'firstLastname'  => $this->firstLastname,
                'secondLastname' => $this->secondLastname,
                'phone'          => $this->phone,
                'email'          => $this->email,
                'corporative'    => $this->corporative,
            ]);
            session()->flash('message2', 'Datos guardados correctamente.');
            $this->clean();
        }
    }

    public function saveProfile()
    {
        $this->validate([
            'birthday'     => 'date|nullable',
            'facebook'     => 'string|max:200|nullable|unique:profiles,facebook, ' . $this->profile->id,
            'instagram'    => 'string|max:200|nullable|unique:profiles,instagram, ' . $this->profile->id,
            'github'       => 'string|max:200|nullable|unique:profiles,github, ' . $this->profile->id,
            'website'      => 'string|max:200|nullable|unique:profiles,website, ' . $this->profile->id,
            'other'        => 'string|max:200|nullable|unique:profiles,other, ' . $this->profile->id,
        ]);
        if ($this->user->id) {
            $usuario = User::find($this->user->id);

            $perfil = $usuario->profile;

            $perfil->update([
                'birthday'    => $this->birthday,
                'facebook'    => $this->facebook,
                'instagram'   => $this->instagram,
                'github'      => $this->github,
                'website'     => $this->website,
                'other'       => $this->other,
            ]);
            session()->flash('message3', 'Datos guardados correctamente.');
            $this->clean();
        }
    }

    public function savePassword()
    {
        $this->validate([
            'password'    => 'required|password|min:8|max:100',
            'password1'   => 'required|min:8|max:100|confirmed',
            'password1_confirmation'   => 'required|min:8|max:100',
        ]);
        if ($this->user->id) {
            $usuario = User::find($this->user->id);
            if ($usuario->password = Hash::make($this->password)) {
                if ($this->password1 == $this->password1_confirmation) {
                    session()->flash('message4', 'Datos guardados correctamente.');
                    $usuario->update([
                        'password'  => Hash::make($this->password1),
                    ]);
                    $this->clean();
                } else {
                    session()->flash('message4.0', 'La contraseña nueva no coincide con la contraseña de confirmación.');
                }
            } else {
                session()->flash('message4.0', 'El campo de contraseña actual no es correcta.');
            }
        }
    }

    public function saveEstado()
    {
        $this->validate([
            'status'     => 'required',
        ]);
        if ($this->user->id) {
            $usuario = User::find($this->user->id);
            $usuario->update([
                'status'    => $this->status,
            ]);

            if ($this->status == 1) {
                $valor = "activada";
            } else {
                $valor = "desactivada";
            }
            
            session()->flash('message5', 'Cuenta ' . $valor . ' correctamente.');
            $this->clean();
        }
    }

    public function deleteAcount()
    {
        if ($this->user->id) {
            User::find($this->user->id)->delete();
            session()->flash('message6', 'Cuenta eliminada correctamente.');
            $this->clean();
        }
    }

    public function clean()
    {
        $this->reset([
            'user',
            'profile',
            'avatar',
            'temporary',
            'name',
            'description',
            'nameUser',
            'firstLastname',
            'secondLastname',
            'phone',
            'email',
            'corporative',
            'birthday',
            'facebook',
            'instagram',
            'github',
            'website',
            'other',
            'password',
            'password1',
            'password1_confirmation',
            'status',
        ]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.profile.profile-component');
    }
}
