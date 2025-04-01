<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserSetting;
class UserSettingsComponent extends Component
{
    public $show_forwarding;
    public $edit_forwarding;
    public $disable_forwarding;
    public $show_shortnotes;
    public $edit_own_shortnotes_only;

    public function mount()
    {
        $settings = auth()->user()->settings;

        $this->show_forwarding = (bool)($settings->show_forwarding ?? false);
        $this->edit_forwarding = (bool)($settings->edit_forwarding ?? false);
        $this->disable_forwarding = (bool)($settings->disable_forwarding ?? false);
        $this->show_shortnotes = (bool)($settings->show_shortnotes ?? false);
        $this->edit_own_shortnotes_only = (bool)($settings->edit_own_shortnotes_only ?? false);
    }

    public function save()
    {
        auth()->user()->settings()->updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'show_forwarding' => (bool) $this->show_forwarding,
                'edit_forwarding' => (bool) $this->edit_forwarding,
                'disable_forwarding' => (bool) $this->disable_forwarding,
                'show_shortnotes' => (bool) $this->show_shortnotes,
                'edit_own_shortnotes_only' => (bool) $this->edit_own_shortnotes_only,
            ]
        );

        $this->mount();
        session()->flash('message', 'Einstellungen gespeichert!');
    }

    public function render()
    {
        return view('livewire.user-settings');
    }
}
