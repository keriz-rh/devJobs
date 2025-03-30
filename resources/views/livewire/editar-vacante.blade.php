<form class="md:w-1/2 space-y-5" action="" method="POST" enctype="multipart/form-data"
wire:submit.prevent="editarVacante">
    @csrf

    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')" 
        placeholder="Titulo Vacante"/>
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select wire:model="salario" id="salario" class="w-full border-gray-300 dark:border-gray-700
            dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600
            focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm ">      
        
        <option value="">-- Seleccione --</option>
        @foreach ($salarios as $salario)
        <option value="{{ $salario->id}}">{{$salario->salario}}</option>
        @endforeach
        </select>
        <x-input-error :messages="$errors->get('salario')" class="mt-2" />

    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select wire:model="categoria" id="categoria" class="w-full border-gray-300 dark:border-gray-700
            dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600
            focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm ">      

            <option value="">-- Seleccione --</option>
            @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')" 
        placeholder="Empresa: ej. Netflix, Uber, Shopify"/>
        <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Último día para postularse')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')" />
        <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="descripcion" :value="__('Descripción del trabajo')" />
        <textarea id="descripcion" wire:model="descripcion" maxlength="350"
            class="block mt-1 w-full h-72 border-gray-300 dark:border-gray-700
            dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600
            focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            placeholder="Descripción del puesto:">{{ old('descripcion') }}</textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input id="imagen" class="block mt-1 w-full" type="file" 
        accept="image/*" wire:model="imagen_nueva"/>
        <x-input-error :messages="$errors->get('imagen_nueva')" class="mt-2" />

    <div class="my-5 w-80">
        <x-input-label :value="__('Imagen Actual')" />
        <img src="{{ asset('storage/vacantes/' . $this->imagen) }}" alt="{{ 'Imagen Vacante ' . $titulo }}">
 
    </div>
      <div class="my-5 w-80">
            @if ($imagen_nueva)
                Imagen Nueva:
                <img src="{{ $imagen_nueva->temporaryUrl()}}" alt="">
            @endif
        </div>
    </div>

    <x-primary-button class="w-full justify-center">
        {{ __('Guardar Cambios') }}
    </x-primary-button>
</form>
