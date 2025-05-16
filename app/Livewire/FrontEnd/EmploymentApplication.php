<?php

namespace App\Livewire\FrontEnd;

use App\Models\EmployesJob;
use App\Models\EmploymentApplication as ModelsEmploymentApplication;
use App\Models\Nationality;
use App\Models\Season;
use Carbon\Carbon;
use Livewire\Component;

class EmploymentApplication extends Component
{
    public $nationalities;
    public $current_season;
    public $jobs;

    public $name;
    public $age;
    public $nationality;
    public $phone;
    public $years_experience;
    public $job_id;
    public $worked_here_before;
    public $content;

    public function active_season(  $season_id,  $season_slug ){

        $season = Season::where(['id'=> $season_id, 'slug'=> $season_slug])->first();        
        if( ! $season ){
            $this->current_season = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على موسم الحج!');
        }

        $this->current_season = $season;
        
    }

    public function addNewRequest()
    {
        if ( ! $this->current_season) {
            return $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: ' عفواً، لم يتم فتح باب التقدم للوظائف لهذا العام حتى الآن!');
        }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:200'],
            'age' => ['required', 'integer', 'between:15,100'],
            'nationality' => ['required', 'exists:nationalities,slug'],
            'phone' => ['required', 'numeric', 'digits_between:8,20'],
            'years_experience' => ['required', 'integer'],
            'job_id' => ['required', 'exists:employes_jobs,id'],
            'worked_here_before' => ['required', 'in:yes,no'],
            'content' => ['nullable', 'string', 'min:3', 'max:1000'],
        ]);

        $ipAddress = request()->ip();
        $check = ModelsEmploymentApplication::where('ip_address', $ipAddress)
                ->orWhere('name', $this->name)
                ->first();

        if( $check && $check->created_at >= Carbon::now()->subDays(30)){

            return $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: ' لقد تلقينا طلبك سابقاً، تحلى بالصبر وسيتواصل معك فريقنا!');
        
        }

        ModelsEmploymentApplication::create([
            'name' => $this->name,
            'age' => $this->age,
            'nationality' => $this->nationality,
            'phone' => $this->phone,
            'years_experience' => $this->years_experience,
            'job_id' => $this->job_id,
            'worked_here_before' => $this->worked_here_before,
            'content' => $this->content,
            'ip_address' => $ipAddress,
            'season_id' => $this->current_season->id,
        ]);

        $this->reset(
            'name',
            'age',
            'nationality',
            'phone',
            'years_experience',
            'job_id',
            'worked_here_before',
            'content'
        );

        return $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'لقد استلمنا طلبك، وسيتواصل معك فريقنا في أقرب وقت ممكن!');

    }

    public function mount()
    {
        $this->nationalities = Nationality::get();
        $this->jobs = EmployesJob::get();

        $now = now();

        $date = Season::whereDate('start_date', '<=', $now)
        ->whereDate('end_date', '>=', $now)
        ->first();

        if( $date ){
            $this->active_season( $date->id, $date->slug);
        }else{
            $date = Season::whereDate('start_date', '>', $now)
            ->orderBy('start_date', 'asc')
            ->first();
        }

        if( $date ){
            $this->active_season( $date->id, $date->slug);
        }
    }
    public function render()
    {
        return view('livewire.front-end.employment-application');
    }
}
