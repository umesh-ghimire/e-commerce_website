{{-- resources/views/filament/pages/settings.blade.php --}}

<x-filament-panels::page>
    <x-filament-panels::form id="settingsForm" wire:submit="save">
        {{ $this->form }}
        
        <div class="flex justify-end gap-3 mt-6">
            <x-filament::button type="submit" color="primary">
                Save Changes
            </x-filament::button>
        </div>
    </x-filament-panels::form>
</x-filament-panels::page>