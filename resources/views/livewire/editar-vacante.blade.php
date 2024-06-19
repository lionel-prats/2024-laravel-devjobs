
<form 
    class="md:w-1/2 space-y-5" 
    wire:submit.prevent="editarVacante"
>
    <!-- Titulo Vacante -->
    <div>
        <x-input-label for="titulo" :value="__('Título Vacante')" />
        <x-text-input 
            class="block mt-1 w-full" 
            id="titulo" 
            type="text" 
            wire:model="titulo" 
            autocomplete="off" 
            placeholder="Título Vacante"
        />
        {{-- <x-input-error :messages="$errors->get('titulo')" class="mt-2" /> --}}
        @error('titulo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror 
    </div>
    <!-- Salario -->
    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
            wire:model="salario" 
            id="salario"
        >
            <option>-- Seleccione --</option>
            @foreach ($salarios as $salario)
                <option 
                    value="{{$salario->id}}" 
                >{{$salario->salario}}</option>
            @endforeach
        </select>
        {{-- <x-input-error :messages="$errors->get('salario')" class="mt-2" /> --}}
        @error('salario')
            <livewire:mostrar-alerta :message="$message" />
        @enderror 
    </div>
    <!-- Categoría -->
    <div>
        <x-input-label for="categoria" :value="__('Categoría')" />
        <select 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
            wire:model="categoria" 
            id="categoria"
        >
            <option>-- Seleccione --</option>
            @foreach ($categorias as $categoria)
                <option 
                    value="{{$categoria->id}}" 
                >{{$categoria->categoria}}</option>
            @endforeach
        </select>
        {{-- <x-input-error :messages="$errors->get('categoria')" class="mt-2" /> --}}
        @error('categoria')
            <livewire:mostrar-alerta :message="$message" />
        @enderror 
    </div>
    <!-- Empresa -->
    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input 
            class="block mt-1 w-full" 
            id="empresa" 
            type="text" 
            wire:model="empresa" 
            autocomplete="off" 
            placeholder="Empresa: ej. Netflix, Uber, Shopify"
        />
        {{-- <x-input-error :messages="$errors->get('empresa')" class="mt-2" /> --}}
        @error('empresa')
            <livewire:mostrar-alerta :message="$message" />
        @enderror 
    </div>
    <!-- Fecha límite postulación -->
    <div>
        <x-input-label for="ultimo_dia" :value="__('Último día para postularse')" />
        <x-text-input 
            class="block mt-1 w-full" 
            id="ultimo_dia" 
            type="date" 
            wire:model="ultimo_dia" 
            autocomplete="off" 
        />
        {{-- <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" /> --}}
        @error('ultimo_dia')
            <livewire:mostrar-alerta :message="$message" />
        @enderror 
    </div>
    <!-- Descripción del trabajo -->
    <div>
        <x-input-label for="descripcion" :value="__('Descripción puesto')" />
        <textarea 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full h-72"
            id="descripcion"
            wire:model="descripcion"
            placeholder="Descripción general del puesto, experiencia"
        ></textarea>
        {{-- <x-input-error :messages="$errors->get('descripcion')" class="mt-2" /> --}}
        @error('descripcion')
            <livewire:mostrar-alerta :message="$message" />
        @enderror 
    </div>
    <!-- Imagen -->
    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input 
            class="block mt-1 w-full" 
            id="imagen" 
            type="file" 
            wire:model="imagen"
            accept="image/*" {{-- atributo html para restringir la carga de archivos a imagenes --}} 
        />
        <div class="my-5 w-80">
            <x-input-label :value="__('Imagen actual')" />
            <img src="{{asset("storage/vacantes/$imagen")}}" alt="{{"Imagen Vacante $titulo"}}">
        </div> 
        {{-- 
        <div class="my-5 w-80">
            @if ($imagen)
                Imagen:
                <img src="{{$imagen->temporaryUrl()}}">
            @endif
        </div> 
        --}}

        @error('imagen')
            <livewire:mostrar-alerta :message="$message" />
        @enderror 
    </div>
    <x-primary-button>
        Guardar Cambios
    </x-button>
</form>