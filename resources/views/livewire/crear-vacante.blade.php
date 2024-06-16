
<form 
    class="md:w-1/2 space-y-5" 
>
    <!-- Titulo Vacante -->
    <div>
        <x-input-label for="titulo" :value="__('Título Vacante')" />
        <x-text-input 
            class="block mt-1 w-full" 
            id="titulo" 
            type="text" 
            name="titulo" 
            :value="old('titulo')" 
            autocomplete="off" 
            placeholder="Título Vacante"
        />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>
    <!-- Salario -->
    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
            name="salario" 
            id="salario"
        >
            <option value="">-- Selecciona un rol --</option>
            <option value="1" {{old('rol') == "1" ? "selected" : ""}}>Developer - Obtener Empleo</option>
            <option value="2" {{old("rol") == "2" ? "selected" : ""}}>Recruiter - Publicar Empleo</option>
        </select>
        <x-input-error :messages="$errors->get('salario')" class="mt-2" />
    </div>
    <!-- Categoría -->
    <div>
        <x-input-label for="categoria" :value="__('Categoría')" />
        <select 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
            name="categoria" 
            id="categoria"
        >
            <option value="">-- Selecciona un rol --</option>
            <option value="1" {{old('rol') == "1" ? "selected" : ""}}>Developer - Obtener Empleo</option>
            <option value="2" {{old("rol") == "2" ? "selected" : ""}}>Recruiter - Publicar Empleo</option>
        </select>
        <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
    </div>
    <!-- Empresa -->
    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input 
            class="block mt-1 w-full" 
            id="empresa" 
            type="text" 
            name="empresa" 
            :value="old('empresa')" 
            autocomplete="off" 
            placeholder="Empresa: ej. Netflix, Uber, Shopify"
        />
        <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
    </div>
    <!-- Fecha límite postulación -->
    <div>
        <x-input-label for="ultimo_dia" :value="__('Último día para postularse')" />
        <x-text-input 
            class="block mt-1 w-full" 
            id="ultimo_dia" 
            type="date" 
            name="ultimo_dia" 
            :value="old('ultimo_dia')" 
            autocomplete="off" 
        />
        <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" />
    </div>
    <!-- Descripción del trabajo -->
    <div>
        <x-input-label for="descripcion" :value="__('Descripción puesto')" />
        <textarea 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full h-72"
            id="descripcion"
            name="descripcion"
            placeholder="Descripción general del puesto, experiencia"
        >{{ old('descripcion') }}</textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>
    <!-- Imagen -->
    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input 
            class="block mt-1 w-full" 
            id="imagen" 
            type="file" 
            name="imagen"  
        />
    </div>
    <x-primary-button>
        Crear Vacante
    </x-button>
</form>