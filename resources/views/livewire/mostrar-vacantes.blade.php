<div>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        @forelse ($vacantes as $vacante)
            <div class="p-6 text-gray-900 dark:text-gray-100 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-400 font-bold">{{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-400">Ultimo dia: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                </div>
    
                <div class="flex flex-col items-stretch gap-3 mt-5 md:mt-0">
                    <a href="{{ route("candidatos.index", $vacante) }}" class="bg-yellow-500 py-2 px-4 rounded-lg text-black text-xs font-bold uppercase text-center">
                        {{ $vacante->candidato->count() }}
                        Candidatos
                    </a>
                    <a href="{{ route("vacantes.edit", $vacante->id) }}" class="bg-gray-400 py-2 px-4 rounded-lg text-black text-xs font-bold uppercase text-center">
                        Editar
                    </a>
                    <a wire:click="$dispatch('mostrarAlerta', { vacante_id: {{ $vacante->id }} })" class="bg-red-400 py-2 px-4 rounded-lg text-black text-xs font-bold uppercase text-center">
                        Eliminar
                    </a>
                </div>
            </div>
        @empty
        <div class="p-6 text-gray-900 dark:text-gray-100 md:flex md:justify-between md:items-center">
            <div class="space-y-3">
                <p class="text-xl font-bold">No hay vacantes</p>
            </div>
        </div>
        @endforelse
    </div>
    
    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('mostrarAlerta', vacanteId => {
            Swal.fire({
                title: "Eliminar Vacante?",
                text: "La vacante eliminada no podra recuperarse!",
                icon: "warning",
                showCancelButton: true,
                color:"#fff",
                confirmButtonColor: "#e7b82a",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "Cancelar",
                background: "#1a202c"
            }).then((result) => {
                if (result.isConfirmed) {
                    //Eliminar vacante de bd
                    @this.call('eliminarVacante',vacanteId);

                    Swal.fire({
                        title: "Eliminado!",
                        text: "Se elimino la vacante correctamente.",
                        icon: "success",
                        background: "#1a202c",
                        color:"#fff",
                        confirmButtonColor: "#e7b82a",
                    });
                }
            });
        })
    </script>
@endpush