<select required name="pres" id="pres" class="block w-full p-2 text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-200 focus:ring-blue-500 focus:border-blue-500 ">
    @foreach ($productos as $producto)
    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
    @endforeach
</select>
