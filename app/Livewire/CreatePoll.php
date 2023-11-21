<?php

namespace App\Livewire;
use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = ['First'];
    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1|max:10',
        // rules for every items in an array 
        'options.*' => 'required|min:1|max:255'
    ];

    protected $messages = [
        'options.*' => 'The option can\'t be empty'
    ];

    public function render()
    {
        return view('livewire.create-poll');
    }
    // public function mount()
    // {

    // }
    public function addOption(){
        $this->options[] = '';
    }
    public function removeOption($index){
        // unset removes an element from the array 
        unset($this->options[$index]);
        // when we delete the element the array index doesnot get continous number 
        // index numbering milauna lai garinxa
        $this->options = array_values($this->options);
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function createPoll()
    {
        $this->validate();
        // create many options related with the poll where 
        // collect all the options and convert in laravel collection object
        // convert every single option in an object into another array 
        // createMany accepts array of arrays 
        Poll::create([
            'title' => $this->title
        ])->options()->createMany(
            collect($this->options)
            ->map(fn ($option) => ['name' => $option])
            ->all()
        );


        // foreach($this->options as $optionName){
        //     //create a option model and also associate the option with poll
        //     $poll->options()->create(['name' => $optionName]);
        // }
        $this->reset(['title','options']);
        $this->dispatch('pollCreated');
    }
}
