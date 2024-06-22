<div class="bg-gray-100 p-5 mt-10 flex flex-col justify-center items-center">
    <h3 class="text-center text-2xl font-bold my-4">Postularme a esta vacante</h3>
    {{-- @session('mensaje') --}}
    @if (session()->has("mensaje"))
        <p class="uperacse border border-green-600 bg-green-100 text-green-600 font-bold p-2 my-5 text-sm rounded-lg">
            {{session("mensaje")}}
        </p>
    @else
        <form class="w-96 mt-5" wire:submit.prevent="postularme">
            <div class="mb-4">
                <x-input-label for="cv" :value="__('Hoja de Vida o Curriculum (PDF)')" />
                <x-text-input 
                    class="block mt-1 w-full" 
                    id="cv" 
                    type="file"  
                    autocomplete="off" 
                    accept=".pdf"
                    wire:model="cv" {{-- conectamos a este input con el atributo $cv de la clase PostularVacante --}}
                />
            </div>
            @error('cv')
                <livewire:mostrar-alerta :message="$message" />
            @enderror 
            <x-primary-button class="my-5">
                Postularme
            </x-button>
        </form>
    @endif
    {{-- @endsession --}}
</div>
