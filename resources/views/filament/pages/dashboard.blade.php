{{-- resources/views/filament/pages/dashboard.blade.php --}}

<x-filament-panels::page>
    <div class="dashboard-3d-container">
        {{-- 3D Tabs --}}
        <div class="tabs-3d">
            @foreach($this->getTabs() as $tabKey => $tab)
                <button 
                    wire:click="$set('activeTab', '{{ $tabKey }}')"
                    class="tab-3d {{ $this->activeTab === $tabKey ? 'active' : '' }}"
                >
                    @if(isset($tab['icon']))
                        <x-filament::icon 
                            :name="$tab['icon']" 
                            class="tab-icon"
                        />
                    @endif
                    <span>{{ $tab['label'] }}</span>
                </button>
            @endforeach
        </div>
        
        {{-- 3D Content Panel --}}
        <div class="content-3d">
            <div class="widgets-container">
                @foreach($this->getWidgets() as $widget)
                    @livewire($widget)
                @endforeach
            </div>
        </div>
    </div>
</x-filament-panels::page>