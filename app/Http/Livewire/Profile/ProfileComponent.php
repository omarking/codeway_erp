<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

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
        $status  = 'success';
        $content = 'Los datos se guardaron correctamente';
        try {
            DB::beginTransaction();
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
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al tratar de guardar los datos';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
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
        $status  = 'success';
        $content = 'Perfil actualizado correctamente';
        try {
            DB::beginTransaction();
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
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al tratar de actualizar su perfil';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
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
        $status  = 'success';
        $content = 'Datos guardados correctamente';
        try {
            DB::beginTransaction();
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
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al tratar de guardar sus datos';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
    }

    public function savePassword()
    {
        $this->validate([
            'password'    => 'required|password|min:8|max:100',
            'password1'   => 'required|min:8|max:100|confirmed',
            'password1_confirmation'   => 'required|min:8|max:100',
        ]);
        $status  = 'success';
        $content = 'Contraseña actualizada correctamente';
        try {
            DB::beginTransaction();
            if ($this->user->id) {
                $usuario = User::find($this->user->id);
                if ($usuario->password = Hash::make($this->password)) {
                    if ($this->password1 == $this->password1_confirmation) {
                        $usuario->update([
                            'password'  => Hash::make($this->password1),
                        ]);
                        session()->flash('process_result', [
                            'status'    => $status,
                            'content'   => $content,
                        ]);
                        $this->clean();
                    } else {
                        $status  = 'error';
                        $content = 'La contraseña nueva no coincide con la confirmación de la contresaña';
                        session()->flash('process_result', [
                            'status'    => $status,
                            'content'   => $content,
                        ]);
                    }
                } else {
                    $status  = 'error';
                    $content = 'La contraseña actual no es la correcta';
                    session()->flash('process_result', [
                        'status'    => $status,
                        'content'   => $content,
                    ]);
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al tratar de actualizar su contraseña';
        }
    }

    public function saveEstado()
    {
        $this->validate([
            'status'     => 'required',
        ]);
        $status  = 'success';
        $content = 'Su cuenta se ';
        try {
            DB::beginTransaction();
            if ($this->user->id) {
                $usuario = User::find($this->user->id);
                $usuario->update([
                    'status'    => $this->status,
                ]);
                if ($this->status == 1) {
                    $valor = "activo";
                } else {
                    $valor = "desactivo";
                }
                $content = 'Su cuenta se ' . $valor . ' correctamente';
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al tratar de guardar los datos';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
    }

    public function deleteAcount()
    {
        $status  = 'success';
        $content = 'Se elimino correctamente su cuenta';
        try {
            DB::beginTransaction();
            if ($this->user->id) {
                User::find($this->user->id)->deletes();
                /* User::find($this->user->id)->delete(); */
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al tratar de eliminar su cuenta';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
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
