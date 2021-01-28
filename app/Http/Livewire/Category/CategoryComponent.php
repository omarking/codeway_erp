<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use App\Models\Project;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $category_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total, $category;

    public $rules = [
        'description'  => 'required|string|max:200|unique:categories,description',
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
        'description' => 'descripción',
    ];

    public function mount()
    {
        $this->total = count(Category::all());
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:categories,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:categories,description,' . $this->category_id,
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'description' => 'required|max:200|unique:categories,description',
        ]);
        Category::create([
            'description'   => $this->description,
        ]);
        session()->flash('message', 'Categoria creada correctamente.');
        $this->clean();
        $this->emit('categoryCreatedEvent');
    }

    public function show(Category $categories)
    {
        $created            = new Carbon($categories->created_at);
        $updated            = new Carbon($categories->updated_at);
        $this->category_id  = $categories->id;
        $this->description  = $categories->description;
        $this->status       = $categories->status;
        $this->created_at   = $created->format('l jS \\of F Y h:i:s A');
        $this->updated_at   = $updated->format('l jS \\of F Y h:i:s A');
        /* $this->created_at   = $categories->created_at;
        $this->updated_at   = $categories->updated_at; */
        $this->category     = $categories;
    }

    public function close()
    {
        $this->clean();
        $this->emit('categoryShowEvent');
    }

    public function edit(Category $categories)
    {
        $this->category_id  = $categories->id;
        $this->description  = $categories->description;
        $this->status       = $categories->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'description' => 'required|max:200|unique:categories,description,' . $this->category_id,
        ]);
        if ($this->category_id) {
            $clase = Category::find($this->category_id);
            $clase->update([
                'description'   => $this->description,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Categoria actualizada correctamente.');
            $this->clean();
            $this->emit('categoryUpdatedEvent');
        }
    }

    public function delete(Category $categories)
    {
        $this->category_id  = $categories->id;
        $this->description  = $categories->description;
    }

    public function destroy()
    {
        Category::find($this->category_id)->delete();
        session()->flash('message', 'Categoria eliminada correctamente.');
        $this->clean();
        $this->emit('categoryDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'category_id',
            'description',
            'status',
            'accion',
            'category',
            'created_at',
            'updated_at',
        ]);
        $this->mount();
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        $proyectos = Project::orderBy('name')->get();

        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }

        return view(
            'livewire.category.category-component',
            [
                'categories' => Category::latest('id')
                    ->where('description', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('proyectos')
        );
    }
}
