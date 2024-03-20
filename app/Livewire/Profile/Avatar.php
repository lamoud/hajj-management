<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

class Avatar extends Component
{
    
    public function render()
    {
        $avatar = '<i class="fa fa-user-circle" style="font-size: 30px;"></i>';

        if( Auth::user() && Jetstream::managesProfilePhotos()){
            $avtUrl = Auth::user()->profile_photo_url;
            $avatar = '<img src="'.$avtUrl .'" alt="'.Auth::user()->name.'">';
        }

        return view('livewire.profile.avatar', compact('avatar'));
    }
}
