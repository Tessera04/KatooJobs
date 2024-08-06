<div>

    <livewire:filtrar-vacantes />

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <h3 class="font-extrabold text-xl text-gray-200 mb-12">Nuestras Vacantes Disponibles</h3>

            <div class="bg-gray-800 shadow-sm rounded-lg p-6 divide-y divide-gray-600">
                @forelse ($vacantes as $vacante)
                    <div class="md:flex md:justify-between md:items-center py-5">
                        <div class="md:flex-1">
                            <a class="font-extrabold text-3xl text-white" href="{{ route('vacantes.show', $vacante->id) }}">{{ $vacante->titulo }}</a>
                            <p class="text-gray-300 mt-3 text-base font-bold">{{ $vacante->empresa }}</p>
                            <p class="text-gray-300">{{ $vacante->categoria->categoria }}</p>
                            <p class="text-gray-300">{{ $vacante->salario->salario }}</p>
                            <p class="text-gray-300 text-base font-bold">
                                Ultimo dia para postularse: 
                                <span class="font-normal">{{ $vacante->ultimo_dia->format('d/m/Y') }}</span>
                            </p>
                        </div>

                        <div class="mt-5 md:mt-0">
                            <a class="inline-flex items-center shadow-sm px-2.5 py-0.5 border hover:border-yellow-600 border-yellow-400 text-sm leading-5 font-medium rounded-full text-gray-700 bg-yellow-400 hover:bg-yellow-600" href="{{ route('vacantes.show', $vacante->id) }}">Ver Vacante</a>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-center text-sm text-gray-200">No hay vacantes aun</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
