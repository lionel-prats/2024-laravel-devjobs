<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @forelse ($vacantes as $vacante) 
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between items-center">
                <div class="space-y-3">
                    <a 
                        class="text-xl font-bold"
                        href="{{route("vacantes.show", $vacante)}}"
                    >{{$vacante->titulo}}</a>
                    <p class="text-sm text-gray-600 font-bold">{{$vacante->empresa}}</p>
                    <p class="text-sm text-gray-500">Último día: {{$vacante->ultimo_dia->format('d/m/Y')}}</p>
                </div>
                <div class="flex gap-3 flex-col items-stretch sm:flex-row mt-5 md:mt-0 ">
                    <a 
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                        href="{{route("candidatos.index", $vacante)}}"
                    >
                        {{$vacante->candidatos->count()}} 
                        @choice("Candidato|Candidatos", $vacante->candidatos->count())
                    </a>
                    <a 
                        class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                        href="{{route("vacantes.edit", $vacante->id)}}"
                    >Editar</a>
                    <button 
                        class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                        wire:click="$dispatch( 'mostrarAlerta', {vacante: {{$vacante->id}} })"
                    >Eliminar</button>
                </div>
            </div>
        @empty
            <p class="p-3 text-center text-sm text-gray-600">No hay vacantes</p>
        @endforelse
    </div>
    
    <div class="mt-10">
        {{$vacantes->links("pagination::tailwind")}}
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- una forma de hacerlo (v219) --}}
        <script>
            Livewire.on("mostrarAlerta", vacante => {
                Swal.fire({
                    title: "¿Eliminar Vacante?",
                    text: "Una vacante eliminada no se puede recuperar",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, ¡Eliminar!",
                    cancelButtonText: "Cancelar"
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        // ejecuto el metodo MostrarVacantes->eliminarVacante()
                        Livewire.dispatch("eliminarVacante", vacante);
                        // Livewire.dispatch("eliminarVacante", {vacante});
                        // Livewire.dispatch("eliminarVacante", [vacante]);
                        Swal.fire({
                            title: "Se eliminó la Vacante",
                            text: "Eliminado Correctamente",
                            icon: "success"
                        })
                        .then(() => {
                            window.location.href = "{{ route('vacantes.index') }}";
                        });
                    }
                });
            })    
        </script> 
        {{-- otra forma de hacerlo (v219) --}}
        {{--
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('mostrarAlerta', vacante => {
                    Swal
                    .fire({
                        title: '¿Seguro?',
                        text: "¡No podrás revertirlo!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '¡Sí, bórralo!',
                        cancelButtonText: 'Cancelar'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            // Livewire.dispatch("eliminarVacante", vacante);
                            // Livewire.dispatch("eliminarVacante", {vacante});
                            Livewire.dispatch("eliminarVacante", [vacante]);
                            Swal.fire(
                                '¡Borrado!',
                                'Tu vacante ha sido eliminado.',
                                'success'
                            )
                            .then(() => {
                                window.location.href = "{{ route('vacantes.index') }}";
                            });
                        }
                    });
                });
            });
        </script> 
        --}} 
    @endpush
</div>