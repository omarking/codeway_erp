<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class EventComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $event_id, $title, $description, $start, $end, $color, $textColor, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'title'         => 'required|string|max:200|unique:events,title',
        'description'   => 'required|string',
        'start'         => 'required|date',
        'end'           => 'required|date',
        'color'         => 'required|string|max:100',
        'textColor'     => 'required|string|max:100',
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
        'title'         => 'titulo',
        'description'   => 'descripción',
        'start'         => 'fecha inicio',
        'end'           => 'fecha termino',
        'color'         => 'color',
        'textColor'     => 'color de texto',
    ];

    public function mount()
    {
        $this->total = count(Event::all());
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'title'         => 'required|string|max:200|unique:events,title',
                'description'   => 'required|string',
                'start'         => 'required|date',
                'end'           => 'required|date',
                'color'         => 'required|string|max:100',
                'textColor'     => 'required|string|max:100',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'title'         => 'required|string|max:200|unique:events,title,' . $this->event_id,
                'description'   => 'required|string',
                'start'         => 'required|date',
                'end'           => 'required|date',
                'color'         => 'required|string|max:100',
                'textColor'     => 'required|string|max:100',
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'title'         => 'required|string|max:200|unique:events,title',
            'description'   => 'required|string',
            'start'         => 'required|date',
            'end'           => 'required|date',
            'color'         => 'required|string|max:100',
            'textColor'     => 'required|string|max:100',
        ]);
        Event::create([
            'title'         => $this->title,
            'slug'          => Str::slug($this->title, '-'),
            'description'   => $this->description,
            'start'         => $this->start,
            'end'           => $this->end,
            'color'         => $this->color,
            'textColor'     => $this->textColor,
        ]);
        session()->flash('message', 'Evento creado correctamente.');
        $this->clean();
        $this->emit('eventCreatedEvent');
    }

    public function show(Event $event)
    {
        $created            = new Carbon($event->created_at);
        $updated            = new Carbon($event->updated_at);
        $this->event_id     = $event->id;
        $this->title        = $event->title;
        $this->description  = $event->description;
        $this->start        = $event->start;
        $this->end          = $event->end;
        $this->color        = $event->color;
        $this->textColor    = $event->textColor;
        $this->status       = $event->status;
        $this->created_at   = $created->format('l jS \\of F Y h:i:s A');
        $this->updated_at   = $updated->format('l jS \\of F Y h:i:s A');
        /* $this->created_at   = $event->created_at;
        $this->updated_at   = $event->updated_at; */
    }

    public function close()
    {
        $this->clean();
        $this->emit('eventShowEvent');
    }

    public function edit(Event $event)
    {
        $this->event_id     = $event->id;
        $this->title        = $event->title;
        $this->description  = $event->description;
        $this->start        = $event->start;
        $this->end          = $event->end;
        $this->color        = $event->color;
        $this->textColor    = $event->textColor;
        $this->status       = $event->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'title'         => 'required|string|max:200|unique:events,title,' . $this->event_id,
            'description'   => 'required|string',
            'start'         => 'required|date',
            'end'           => 'required|date',
            'color'         => 'required|string|max:100',
            'textColor'     => 'required|string|max:100',
        ]);
        if ($this->event_id) {
            $event = Event::find($this->event_id);
            $event->update([
                'title'         => $this->title,
                'slug'          => Str::slug($this->title, '-'),
                'description'   => $this->description,
                'start'         => $this->start,
                'end'           => $this->end,
                'color'         => $this->color,
                'textColor'     => $this->textColor,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Evento actualizado correctamente.');
            $this->clean();
            $this->emit('eventUpdatedEvent');
        }
    }

    public function delete(Event $event)
    {
        $this->event_id     = $event->id;
        $this->title        = $event->title;
    }

    public function destroy()
    {
        Event::find($this->event_id)->delete();
        session()->flash('message', 'Evento eliminado correctamente.');
        $this->clean();
        $this->emit('eventDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'event_id',
            'title',
            'description',
            'start',
            'end',
            'color',
            'textColor',
            'status',
            'accion',
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
        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }

        return view(
            'livewire.event.event-component',
            [
                'events' => Event::latest('id')
                    ->where('title', 'LIKE', "%{$this->search}%")
                    ->orWhere('description', 'LIKE', "%{$this->search}%")
                    ->orWhere('start', 'LIKE', "%{$this->search}%")
                    ->orWhere('end', 'LIKE', "%{$this->search}%")
                    ->orWhere('color', 'LIKE', "%{$this->search}%")
                    ->orWhere('textColor', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ]
        );
    }
}
