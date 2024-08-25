@props(['subtitle' => '', 'title'])
<div class="flex flex-col items-center justify-center h-64 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg shadow-md p-6">  
    <svg class="w-16 h-16 mb-4 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v4a2 2 0 002 2h10zm0 4H7a2 2 0 01-2-2v-1a2 2 0 012-2h10a2 2 0 012 2v1a2 2 0 01-2 2z"></path>
    </svg>
    
    <h2 class="text-xl font-semibold mb-2">{{$title}}</h2>
    
    <!-- Mensaje de instrucción adicional -->
    <p class="text-center text-gray-500 dark:text-gray-400">
        {{__($subtitle)}}
    </p>
</div>