<?php

namespace App\Http\Livewire\Project;

use App\Models\Category;
use App\Models\Clas;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $project_id, $avatar, $key, $name, $description, $status, $responsable, $created_at, $updated_at, $accion = "store";

    public $clase, $categoria, $clas_id, $category_id;

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'avatar'        => '',
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
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'avatar'        => '',
                'key'           => 'required|string|max:100|unique:projects,key',
                'name'          => 'required|string|max:200|unique:projects,name',
                'description'   => 'required|string',
                'responsable'   => 'required|string|max:100',
                'clas_id'       => 'required',
                'category_id'   => 'required',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'avatar'        => '',
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
        $validateData = $this->validate([
            'avatar'        => '',
            'key'           => 'required|string|max:100|unique:projects,key',
            'name'          => 'required|string|max:200|unique:projects,name',
            'description'   => 'required|string',
            'responsable'   => 'required|string|max:100',
            'clas_id'       => 'required',
            'category_id'   => 'required',
        ]);
        Project::create($validateData);
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
    }

    public function update()
    {
        $this->validate([
            'avatar'        => '',
            'key'           => 'required|string|max:100|unique:projects,key,' . $this->project_id,
            'name'          => 'required|string|max:200|unique:projects,name,' . $this->project_id,
            'description'   => 'required|string',
            'responsable'   => 'required|string|max:100',
            'status'        => 'required',
            'clas_id'       => 'required',
            'category_id'   => 'required',
        ]);
        if ($this->project_id) {
            $project = Project::find($this->project_id);
            $project->update([
                'avatar'        => $this->avatar,
                'key'           => $this->key,
                'name'          => $this->name,
                'description'   => $this->description,
                'status'        => $this->status,
                'responsable'   => Auth::user()->name,
                'clas_id'       => $this->clas_id,
                'category_id'   => $this->category_id,
            ]);
            session()->flash('message', 'Proyecto actualizado correctamente.');
            $this->clean();
            $this->emit('projectUpdatedEvent');
        }
    }

    public function delete(Project $project)
    {
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
            compact('clases', 'categorias')
        );
    }
}
