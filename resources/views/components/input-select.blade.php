@props(['value', 'options' => [], 'name'])

<div class="inline-block relative w-64">
    <select class="border-gray-300 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 
    focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 
     dark:focus:ring-indigo-600 rounded-md shadow-sm" name="{{ $name }}[]" multiple>
     <option>Select categories</option>

     @foreach ($options as $option)
      <option value="{{ $option->id }}">{{ $option->name }}</option>
     @endforeach
      
    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
    </div>
  </div>