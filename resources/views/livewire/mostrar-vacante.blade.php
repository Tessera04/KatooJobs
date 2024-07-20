<div class="p-10 text-gray-800 dark:text-gray-200">
    <div class="mb-5">
        <h3 class="font-bold text-3xl  my-3">
            {{ $vacante->titulo }}
        </h3>

        <div class="md:grid md:grid-cols-2 bg-gray-900 p-4 my-5 rounded">
            <p class="font-bold text-sm my-3">
                Empresa: <span class="normal-case font-normal">{{ $vacante->empresa }}</span>
            </p>

            <p class="font-bold text-sm my-3">
                Ultimo dia para postularse: <span class="normal-case font-normal">{{ $vacante->ultimo_dia->toFormattedDateString() }}</span>
            </p>

            <p class="font-bold text-sm my-3">
                Categoria: <span class="normal-case font-normal">{{ $vacante->categoria->categoria }}</span>
            </p>

            <p class="font-bold text-sm my-3">
                Salario: <span class="normal-case font-normal">{{ $vacante->salario->salario }}</span>
            </p>
        </div>
    </div>

    <div class="md:grid md:grid-cols-6 gap-4">
        <div class="md:col-span-2">
            <img class="rounded" src="{{ asset('storage/vacantes/' . $vacante->imagen) }}" alt="{{ 'Imagen vacante ' . $vacante->titulo}}">
        </div>

        <div class="md:col-span-4">
            <h3 class="text-2xl font-bold mb-5">Descripcion del puesto</h3>
            <p> {{ $vacante->descripcion }} </p>
        </div>
    </div>

    @guest
        <div class="mt-5 border border-gray-700 p-5 text-center bg-gray-900">
            <p>
                Deseas aplicar a esta vacante? 
                <a class="text-yellow-500 font-bold" href="{{ route('register') }}">Obten una cuenta</a>
                totalmente gratis!
            </p>
        </div>
    @endguest

    @cannot('create', App\Models\Vacante::class)
        <livewire:postular-vacante :vacante="$vacante" />
    @endcannot
</div>
