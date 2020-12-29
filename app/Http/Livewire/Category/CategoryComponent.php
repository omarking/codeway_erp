<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $description, $status, $category_id, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'description'  => 'required|string|min:4|max:100|unique:categories,description',
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
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|min:4|max:100|unique:categories,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|min:4|max:100|unique:categories,description,' . $this->category_id,
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'description' => 'required|min:4|max:100|unique:categories,description',
        ]);
        Category::create($validateData);
        session()->flash('message', 'Categoria creada correctamente.');
        $this->clean();
        $this->emit('categoryCreatedEvent');
    }

    public function show(Category $categories)
    {
        $this->category_id  = $categories->id;
        $this->description  = $categories->description;
        $this->status       = $categories->status;
        $this->created_at   = $categories->created_at;
        $this->updated_at   = $categories->updated_at;
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
            'description' => 'required|min:4|max:100|unique:categories,description,' . $this->category_id,
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
        $this->status       = $categories->status;
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
        $this->reset(['description', 'status', 'category_id', 'accion', 'created_at', 'updated_at',]);
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        return view(
            'livewire.category.category-component',
            ['categories' => Category::where('description', 'LIKE', "%{$this->search}%")
            ->orWhere('id', 'LIKE', "%{$this->search}%")
            ->paginate($this->perPage)]
        );
    }

    /* Codigo útil */

    /* public $contentIsVisible = false;

    public $rules = [
        'description'  => 'required|string|min:4|max:100|unique:categories,description',
    ];

    protected $messages = [
        'description.required' => 'La descripción es de ahuevo cabron.',
        'description.unique' => 'La descripción debe ser unica perro, esa ya esta en uso.',
    ];

    protected $validationAttributes = [
        'description' => 'descripción'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validateData = $this->validate();

        Category::create($validateData);

        session()->flash('message', 'Categoria agregada correctamente XD.');

        $this->clean();
    }
    public function toggleContent()
    {
        if ($this->contentIsVisible == true) {
            $this->contentIsVisible == false;
        } else {
            $this->contentIsVisible == true;
        }
    } */

    /* Hasta aqui termina el código útil */
}
