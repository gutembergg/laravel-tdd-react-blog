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
    
  </div>