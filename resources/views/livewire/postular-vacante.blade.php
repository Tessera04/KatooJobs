<div class="p-5 mt-10 text-gray-800 dark:text-gray-200 flex flex-col justify-center items-center bg-gray-900 rounded">
    <h3 class="text-center text-2xl font-bold my-4">Postularse a esta vacante</h3>

    @if (session()->has('mensaje'))
        <div class="uppercase border border-green-600 bg-green-100 text-green-600 font-bold p-2 my-5">
            {{ session('mensaje') }}
        </div>
    @else
        <form class="w-96 mt-5">
            <div class="mb-4">
                <x-input-label for="cv" :value="__('Curriculum Vitae (PDF)')" />
                <x-text-input id="cv" type="file" wire:model='cv' accept=".pdf" class="block mt-1 w-full" />
            </div>

            @error('cv')
                <livewire:mostrar-alerta :message="$message" />
            @enderror

            <x-primary-button class="my-5">
                {{ __('Postularse') }}
            </x-primary-button>
        </form>
    @endif

</div>
