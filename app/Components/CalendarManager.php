<?php


namespace App\Components;


use App\Models\Machines;
use App\Models\Reservations;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CalendarManager extends Component
{

    protected $listeners = [
        'refresh-calendars' => '$refresh',
    ];

    public $MachineSelected;
    public $WeekSelected;

    public $state = [];
    public $machine = null;
    public $dayOfWeek = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'];

    public $days = [];
    public $prenotations = [];
    public $machines;
    public $stateModalBook = false;
    public $stateModalDelete = false;
    public $stateModalUpdate = false;

    public function week($changeValue)
    {
        $this->redirectRoute('calendar', ['machine' => Machines::find($this->MachineSelected)->name, 'week' => $this->WeekSelected+$changeValue]);
    }

    public function bookModal($day, $when)
    {
        $this->state['date'] = $day;
        $this->state['when'] = $when;
        $this->stateModalBook = true;
    }
    public function cancelBook()
    {
        $this->stateModalBook = false;
    }
    public function confirmBook()
    {
        $this->state['machine'] = $this->MachineSelected;
        $validate = Validator::make($this->state, [
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'when' => ['required', 'string', 'max:2'],
            'work' => ['required', 'string', 'max:255'],
            'machine' => ['required', 'numeric'],
        ])->validate();

        //dd(count(Reservations::where('date',$this->state['date'])->whereMachine($this->MachineSelected)->whereWhen($this->state['when'])->get()));

        if (count(Reservations::where('date',$validate['date'])->whereMachine($validate['machine'])->whereWhen($validate['when'])->get()) == 1) {

            $reservations = Reservations::where('date','>=',$this->state['date'])->get();
            //dd($reservations);
            if (strcmp($validate['when'],'PM')==0)
                unset($reservations[count($reservations)-1]);

            //dd($reservations);
            for ($i=1;$i<count($reservations);$i++) {
                Reservations::find($reservations[$i]->id)
                    ->update(['date' => $reservations[$i-1]->date, 'when' => $reservations[$i-1]->when]);
            }
            $next = $this->getFirstAvailable($validate['date'], $validate['when'], $this->MachineSelected);
            //dd($next);
            Reservations::find($reservations[0]->id)
                ->update(['date' => $next['date'], 'when' => $next['when']]);
            Reservations::create($validate);
        } else {
            Reservations::create($validate);
        }
        $this->redirectRoute('calendar', ['machine' => Machines::find($this->MachineSelected)->name, 'week' => $this->WeekSelected]);
        //$this->stateModalBook = false;
        //$this->emit('refresh-calendars');
    }

    public function deleteModal($day, $when)
    {
        $this->state['date'] = $day;
        $this->state['when'] = $when;
        $this->stateModalDelete = true;
    }
    public function cancelDelete()
    {
        $this->stateModalDelete = false;
    }
    public function confirmDelete($shift)
    {
        if ($shift) {
            $reservations = Reservations::where('date','>=',$this->state['date'])->get();
            for ($i=0;$i<count($reservations)-1;$i++) {
                Reservations::find($reservations[$i]->id)
                    ->update(['date' => $reservations[$i+1]->date, 'when' => $reservations[$i+1]->when]);
            }
            Reservations::find($reservations[count($reservations)-1]->id)->delete();
        } else {
            Reservations::where('date',$this->state['date'])->whereMachine($this->MachineSelected)->whereWhen($this->state['when'])->delete();
        }
        $this->redirectRoute('calendar', ['machine' => Machines::find($this->MachineSelected)->name, 'week' => $this->WeekSelected]);
        //$this->stateModalDelete = false;
        //$this->emit('refresh-calendars');
    }

    public function updateModal($day, $when)
    {
        $this->state['date'] = $day;
        $this->state['when'] = $when;
        $this->stateModalUpdate = true;
    }
    public function cancelUpdate()
    {
        $this->stateModalUpdate = false;
    }
    public function confirmUpdate()
    {
        $this->state['machine'] = $this->MachineSelected;
        $validate = Validator::make($this->state, [
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'when' => ['required', 'string', 'max:2'],
            'work' => ['required', 'string', 'max:255'],
            'machine' => ['required', 'numeric'],
        ])->validate();

        Reservations::whereDate('date', $validate['date'])->whereWhen($validate['when'])->whereMachine($validate['machine'])->update(['work' => $validate['work']]);

        $this->redirectRoute('calendar', ['machine' => Machines::find($this->MachineSelected)->name, 'week' => $this->WeekSelected]);
    }

    public function mount($machine, $week)
    {
        if (count(Machines::all())<1)
            return redirect()->route('machine');

        $this->machines = Machines::all();
        if (empty($machine))
            $this->machine = Machines::first()->id;
        else
            $this->machine = Machines::whereName($machine)->first()->id;
        $this->MachineSelected = $this->machine;
        $this->WeekSelected = $week;
        $this->prenotations = Reservations::whereMachine($this->machine)->get();
        $this->setDays();

    }


    public function render()
    {

        /*
        if(!empty($this->testMachineSelected)) {
            $this->state['name'] = Machines::find($this->testMachineSelected)->name;
        } else {
            $this->testMachineSelected = Machines::limit(1)->get()[0]->id;
            $this->state['name'] = Machines::find($this->testMachineSelected)->name;
        }
        */


        if($this->MachineSelected !== $this->machine) {
            //$this->MachineSelected = Machines::limit(1)->get()[0]->id;
            //dd(Machines::find($this->MachineSelected)->name);
            //$this->machine = $this->MachineSelected;
            //return view('dashboard.calendar.calendar', ['machine'=>$this->MachineSelected]);
            //$this->redirect(route('calendar', ['machine' => Machines::find($this->MachineSelected)->name, 'week' => 0]));
            $this->redirectRoute('calendar', ['machine' => Machines::find($this->MachineSelected)->name, 'week' => $this->WeekSelected]);
        }
        //$this->state['name'] = Machines::find($this->MachineSelected)->name;
        //print_r(Reservations::where('machine',$this->testMachineSelected)->get());
        //dd($this->days);
        //dd($this->prenotations);

        return view('dashboard.calendar.calendar');
    }

    private function setDays() {
        $dayNames = array("Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato", "Domenica");

        $today = date('Y-m-d', strtotime("this week"));
        if (strcmp(date("l"),"Saturday")==0 || strcmp(date("l"),"Sunday")==0)
            $today = date('Y-m-d', strtotime("next week"));
        $firstDay = strtotime($today);
        $scrollDay = $today;
        $lastDate = date('Y-m-d', strtotime($today.'+4 months'));
        $dates = array();

        while ($scrollDay < $lastDate) {
            $dates[] = ['date' => $scrollDay, 'name' => $dayNames[date('w', strtotime($scrollDay))-1]];
            $scrollDay = date('Y-m-d', strtotime($scrollDay."+1 day"));
            if(date('w', strtotime($scrollDay))==0)
                $scrollDay = date('Y-m-d', strtotime($scrollDay."+1 day"));

            /*
            $dates[] = ['date' => date('Y-m-d', strtotime("+2 day", $firstDay)), 'name' => 'Mercoledì'];
            $dates[] = ['date' => date('Y-m-d', strtotime("+3 day", $firstDay)), 'name' => 'Giovedì'];
            ...
            $dates[] = ['date' => date('Y-m-d', strtotime("+19 day", $firstDay)), 'name' => 'Sabato'];
            */
        }

        $this->days = array_slice($dates, $this->WeekSelected*6,6);
    }

    private function getFirstAvailable($dateLeave, $partOfDayLeave, $machine): array {
        $dateAvailable = $dateLeave;
        $when = $partOfDayLeave;
        do {
            $date = Reservations::where([['date',$dateAvailable],['when',$when],['machine',$machine]])
                ->exists();
            if ($date==1)
                if (strcmp($when,'PM')==0) {
                    $when = 'AM';
                    if (strcmp(date("l", strtotime($dateAvailable)),"Saturday")==0)
                        $dateAvailable = date('Y-m-d', strtotime("+2 day", strtotime($dateAvailable)));
                    else
                        $dateAvailable = date('Y-m-d', strtotime("+1 day", strtotime($dateAvailable)));
                } else
                    $when = 'PM';
        } while($date == 1);
        return array('date'=>$dateAvailable,'when'=>$when);
    }
}
