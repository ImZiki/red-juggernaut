@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300   focus:border-indigo-500  focus:ring-black  rounded-md shadow-sm']) }}>
