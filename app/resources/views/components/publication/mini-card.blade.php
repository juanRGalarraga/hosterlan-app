@props([
    'srcImage',
    'title',
    'subtitle'
])

<div class=" bg-gray-800 text-white rounded-lg shadow-md overflow-hidden mb-3 w-full mx-auto">
    <!-- Imagen -->
    <div class="relative">
        <img class="w-full h-48 object-cover" src="{{$srcImage}}" alt="La Carmelita">
    </div>

    <!-- Contenido -->
    <div class="p-4">
        <h3 class="text-lg font-semibold">{{$title}}</h3>
        <p class="text-sm text-gray-400 mt-2">{{$subtitle}}</p>
        <!-- Calificación -->
        <!-- <div class="flex items-center mt-3">
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.049 2.927C9.469 1.637 10.531 1.637 10.951 2.927L12.3 6.818C12.449 7.232 12.846 7.5 13.293 7.5H17.292C18.592 7.5 19.057 8.971 18.097 9.742L14.688 12.442C14.318 12.726 14.156 13.219 14.287 13.684L15.361 17.553C15.742 18.864 14.468 19.924 13.401 19.191L10.1 17.07C9.686 16.79 9.148 16.79 8.735 17.07L5.434 19.191C4.366 19.924 3.093 18.864 3.474 17.553L4.548 13.684C4.679 13.219 4.517 12.726 4.147 12.442L0.738 9.742C-0.222 8.971 0.243 7.5 1.543 7.5H5.542C5.989 7.5 6.386 7.232 6.535 6.818L7.884 2.927Z" />
        </svg>
        <span class="text-sm ml-2">4.96 (28 evaluaciones)</span>
        </div> -->
    </div>
</div>