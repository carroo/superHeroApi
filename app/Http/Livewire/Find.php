<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

class Find extends Component
{
    public $data,$name,$find = 0,$detail;

    public function render()
    {
        return view('livewire.find');
    }
    public function find()
    {
        $this->find = 1;
        $response = Http::get('https://superheroapi.com/api/3161278757529559/search/'.$this->name);
        if($response->object()->response == "success"){
            $this->data = $response->json()["results"];
        }

    }
    public function detail($id)
    {
        $response = Http::get('https://superheroapi.com/api/3161278757529559/'.$id);

        if($response->object()->response == "success"){
            $this->detail = $response->json();
        }
        $d = [array_keys($this->detail['powerstats']),array_values($this->detail['powerstats']) ];
        $this->emit('detail',$d);
    }
}
