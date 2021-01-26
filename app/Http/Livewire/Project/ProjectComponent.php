<?php

namespace App\Http\Livewire\Project;

use App\Models\Category;
use App\Models\Clas;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ProjectComponent extends Component
{
    use WithPagination;

    use WithFileUploads;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $project_id, $avatar, $key, $name, $description, $status, $responsable, $created_at, $updated_at, $accion = "store";

    public $clase, $categoria, $clas_id, $category_id, $temporary;

    public $search = '', $perPage = '10', $total, $projects_task;

    public $user = [], $projects_users = [], $message;

    public $rules = [
        'avatar'        => 'image|mimes:jpeg,png|max:5000',
        'key'           => 'required|string|max:100|unique:projects,key',
        'name'          => 'required|string|max:200|unique:projects,name',
        'description'   => 'required|string',
        'responsable'   => 'required|string|max:100',
        'clas_id'       => 'required',
        'category_id'   => 'required',
    ];

    /* protected $messages = [
        'description.required' => 'La descripción es requerida.',
        'description.unique' => 'La descripción ya esta en uso.',
    ]; */

    protected $queryString = [
        'search'  => ['except' => ''],
        'perPage' => ['except' => '10'],
    ];

    protected $validationAttributes = [
        'avatar'        => 'imagen',
        'temporary'     => 'imagen',
        'key'           => 'clave',
        'name'          => 'nombre',
        'description'   => 'descripción',
        'responsable'   => 'responsable',
        'clas_id'       => 'clase',
        'category_id'   => 'categoria',
    ];

    public function mount()
    {
        $this->total = count(Project::all());
        $this->responsable = Auth::user()->name;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'avatar'        => 'image|mimes:jpeg,png|max:5000',
                'key'           => 'required|string|max:100|unique:projects,key',
                'name'          => 'required|string|max:200|unique:projects,name',
                'description'   => 'required|string',
                'responsable'   => 'required|string|max:100',
                'clas_id'       => 'required',
                'category_id'   => 'required',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'avatar'        => 'image|mimes:jpeg,png|max:5000',
                'key'           => 'required|string|max:100|unique:projects,key,' . $this->project_id,
                'name'          => 'required|string|max:200|unique:projects,name,' . $this->project_id,
                'description'   => 'required|string',
                'responsable'   => 'required|string|max:100',
                'clas_id'       => 'required',
                'category_id'   => 'required',
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'temporary'     => 'image|mimes:jpeg,png|max:5000',
            'key'           => 'required|string|max:100|unique:projects,key',
            'name'          => 'required|string|max:200|unique:projects,name',
            'description'   => 'required|string',
            'responsable'   => 'required|string|max:100',
            'clas_id'       => 'required',
            'category_id'   => 'required',
        ]);

        if ($this->temporary != null) {
            if ($this->temporary->getClientOriginalName()) {
                $nameFile = time() . '_' . $this->temporary->getClientOriginalName();
                $this->temporary->storePubliclyAs('storage/projects', $nameFile, 'public_uploads');
            }
        } else {
            $nameFile = null;
        }

        $project = Project::create([
            'avatar'        => $nameFile,
            'key'           => $this->key,
            'name'          => $this->name,
            'slug'          => Str::slug($this->name, '-'),
            'description'   => $this->description,
            'responsable'   => Auth::user()->name,
            'clas_id'       => $this->clas_id,
            'category_id'   => $this->category_id,
        ]);

        $project->users()->sync($this->user);

        session()->flash('message', 'Proyecto creado correctamente.');
        $this->clean();
        $this->emit('projectCreatedEvent');
    }

    public function show(Project $project)
    {
        $this->project_id    = $project->id;
        $this->avatar        = $project->avatar;
        $this->key           = $project->key;
        $this->name          = $project->name;
        $this->description   = $project->description;
        $this->status        = $project->status;
        $this->responsable   = $project->responsable;
        $this->clas_id       = $project->clas_id;
        $this->category_id   = $project->category_id;
        $this->created_at    = $project->created_at;
        $this->updated_at    = $project->updated_at;

        if (isset($project->clas->description)) {
            $this->clase   = $project->clas->description;
        } else {
            $this->clase   = "Sin clase";
        }
        if (isset($project->category->description)) {
            $this->categoria     = $project->category->description;
        } else {
            $this->categoria     = "Sin categoria";
        }

        foreach ($project->users as $user) {
            $this->projects_users[] = $user->id;
        }
    }

    public function close()
    {
        $this->clean();
        $this->emit('projectShowEvent');
    }

    public function edit(Project $project)
    {
        $this->project_id    = $project->id;
        $this->avatar        = $project->avatar;
        $this->key           = $project->key;
        $this->name          = $project->name;
        $this->description   = $project->description;
        $this->status        = $project->status;
        $this->responsable   = $project->responsable;
        $this->clas_id       = $project->clas_id;
        $this->category_id   = $project->category_id;
        $this->created_at    = $project->created_at;
        $this->updated_at    = $project->updated_at;
        $this->accion        = "update";

        foreach ($project->users as $user) {
            $this->user[] = $user->id;
        }
    }

    public function update()
    {
        $this->validate([
            'temporary'     => 'image|mimes:jpeg,png|max:5000|nullable',
            'key'           => 'required|string|max:100|unique:projects,key,' . $this->project_id,
            'name'          => 'required|string|max:200|unique:projects,name,' . $this->project_id,
            'description'   => 'required|string',
            'responsable'   => 'required|string|max:100',
            'status'        => 'required',
            'clas_id'       => 'required',
            'category_id'   => 'required',
        ]);

        if ($this->temporary != null) {
            if ($this->temporary->getClientOriginalName()) {
                $nameFile = time() . '_' . $this->temporary->getClientOriginalName();
                $this->temporary->storePubliclyAs('storage/projects', $nameFile, 'public_uploads');
            }
        } else {
            $nameFile = $this->avatar;
        }

        if ($this->project_id) {
            $project = Project::find($this->project_id);
            $project->update([
                'avatar'        => $nameFile,
                'key'           => $this->key,
                'name'          => $this->name,
                'slug'          => Str::slug($this->name, '-'),
                'description'   => $this->description,
                'status'        => $this->status,
                'responsable'   => Auth::user()->name,
                'clas_id'       => $this->clas_id,
                'category_id'   => $this->category_id,
            ]);

            $project->users()->sync($this->user);

            session()->flash('message', 'Proyecto actualizado correctamente.');
            $this->clean();
            $this->emit('projectUpdatedEvent');
        }
    }

    public function limpia()
    {
        /* $this->reset(['user']); */
        $this->user = [];
    }

    /* public function delete(Project $project) */
    public function delete(Project $project)
    {
        /* $this->name    = Project::where('id', '=', $project)->get(); */
        /* $project = Project::where('id', '=', $project)->get(); */
        $this->project_id   = $project->id;
        $this->key          = $project->key;
        $this->name         = $project->name;
    }

    public function destroy()
    {
        Project::find($this->project_id)->delete();
        session()->flash('message', 'Proyecto eliminado correctamente.');
        $this->clean();
        $this->emit('projectDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'project_id',
            'avatar',
            'temporary',
            'key',
            'name',
            'description',
            'responsable',
            'status',
            'clas_id',
            'category_id',
            'created_at',
            'updated_at',
            'accion',
            'clase',
            'categoria',
            'user',
            'projects_users',
        ]);
        $this->mount();
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        $clases      = Clas::orderBy('description')->where('status', '1')->get();
        $categorias  = Category::orderBy('description')->where('status', '1')->get();
        $tareas      = Task::latest('id')->get();
        $usuarios    = User::latest('id')->get();

        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }

        return view(
            'livewire.project.project-component',
            [
                'projects' => Project::latest('id')
                    ->with('clas', 'category')
                    ->where('id', 'LIKE', "%{$this->search}%")
                    ->orWhere('key', 'LIKE', "%{$this->search}%")
                    ->orWhere('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('description', 'LIKE', "%{$this->search}%")
                    ->orWhere('responsable', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('clases', 'categorias', 'tareas', 'usuarios')
        );
    }
}
