<div>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        @forelse ($vacantes as $vacante)
            <div class="p-6 text-gray-900 dark:text-gray-100 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-400 font-bold">{{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-400">Ultimo dia: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                </div>
    
                <div class="flex flex-col items-stretch gap-3 mt-5 md:mt-0">
                    <a href="#" class="bg-yellow-500 py-2 px-4 rounded-lg text-black text-xs font-bold uppercase text-center">
                        Candidatos
                    </a>
                    <a href="{{ route("vacantes.edit", $vacante->id) }}" class="bg-gray-400 py-2 px-4 rounded-lg text-black text-xs font-bold uppercase text-center">
                        Editar
                    </a>
                    <a href="#" class="bg-red-400 py-2 px-4 rounded-lg text-black text-xs font-bold uppercase text-center">
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

