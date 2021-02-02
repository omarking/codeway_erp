<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EventComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $event_id, $title, $description, $start, $end, $color, $textColor, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $page = 1, $total;

    public $rules = [
        'title'         => 'required|string|max:200|unique:events,title',
        'description'   => 'required|string',
        'start'         => 'required|date',
        'end'           => 'required|date',
        'color'         => 'required|string|max:100',
        'textColor'     => 'required|string|max:100',
    ];

    protected $queryString = [
        'search'  => ['except' => ''],
        'perPage' => ['except' => '10'],
    ];

    protected $validationAttributes = [
        'title'         => 'título',
        'description'   => 'descripción',
        'start'         => 'fecha inicio',
        'end'           => 'fecha terminó',
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

        $status = 'success';
        $content = 'Se agregó correctamente el evento';

        try {

            DB::beginTransaction();

            Event::create([
                'title'         => $this->title,
                'slug'          => Str::slug($this->title, '-'),
                'description'   => $this->description,
                'start'         => $this->start,
                'end'           => $this->end,
                'color'         => $this->color,
                'textColor'     => $this->textColor,
            ]);

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollBack();

            $status = 'error';
            $content = 'Ocurrió un error al agregar el evento';

        }

        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);

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

        $status = 'success';
        $content = 'Se actualizó correctamente el evento';

        try {

            DB::beginTransaction();

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
            }

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollBack();

            $status = 'error';
            $content = 'Ocurrió un error al actualizar el evento';

        }

        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);

        $this->clean();
        $this->emit('eventUpdatedEvent');
    }

    public function delete(Event $event)
    {
        $this->event_id     = $event->id;
        $this->title        = $event->title;
    }

    public function destroy()
    {
        $status = 'success';
        $content = 'Se eliminó correctamente el evento';

        try {

            DB::beginTransaction();

            Event::find($this->event_id)->delete();

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollBack();

            $status = 'error';
            $content = 'Ocurrió un error al eliminar el evento';

        }

        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);

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
