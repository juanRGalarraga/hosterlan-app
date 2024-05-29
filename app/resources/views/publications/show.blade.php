<x-app-layout>

<div class="bg-gray-900 text-white flex flex-col lg:flex-row h-screen w-full relative">
  <!-- Botón de cierre -->
  <button class="absolute top-4 right-4 bg-gray-700 text-white rounded-full p-2 focus:outline-none">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </button>

  <!-- Lado izquierdo más grande (carrousel) -->
  <div class="lg:w-3/4 w-full h-full relative bg-gray-800 flex items-center justify-center">
    <!-- Botón izquierdo -->
    <button class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white rounded-full p-2 focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </button>

    <!-- Contenido del carrousel -->
    <div class="w-full h-full flex items-center justify-center">
      <img src="https://via.placeholder.com/600x400" alt="Carrousel Image" class="object-cover w-full h-full">
    </div>

    <!-- Botón derecho -->
    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white rounded-full p-2 focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </button>
  </div>

  <!-- Lado derecho más pequeño con scroll independiente -->
  <div class="lg:w-1/4 w-full h-full bg-gray-700 p-4 flex flex-col justify-start overflow-y-auto scrollbar-hide">
    <!-- Título -->
    <h1 class="text-2xl font-bold mb-4">Título de la Publicación</h1>
    
    <!-- Precio -->
    <div class="text-xl text-green-400 font-semibold mb-4">$ Precio por noche</div>

    <!-- Grupo de botones -->
    <div class="flex space-x-2 mb-4">
      <button class="bg-blue-600 text-white px-4 py-2 rounded focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
        </svg>
      </button>
      <button class="bg-yellow-600 text-white px-4 py-2 rounded focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
      </button>
      <button class="bg-gray-600 text-white px-4 py-2 rounded focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>

    <!-- Descripción -->
    <div class="text-gray-300">
      <p>
        Descripción de la publicación. Este es el espacio donde se detallan las características del alquiler, comodidades, reglas de la casa y otra información relevante.
      </p>
    </div>
  </div>
</div>




</x-app-layout>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        width: 0 !important;
        height: 0 !important;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollbar-hide:hover::-webkit-scrollbar {
        width: 6px !important;
        height: 6px !important;
    }
</style>
