<div class="w-full text-center text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    @foreach ($daysAvailables as $dayAvailable)
        <button type="button" 
            @class([
                'cursor-not-allowed' => !$dayAvailable->isAvailable(),
                'relative',
                'inline-flex',
                'items-center',
                'w-full',
                'px-4',
                'py-2',
                'text-sm',
                'font-medium',
                'border-b',
                'border-gray-200',
                'rounded-t-lg',
                'hover:bg-gray-100' => $dayAvailable->isAvailable(),
                'hover:text-blue-700'  => $dayAvailable->isAvailable(),
                'focus:z-10 focus:ring-2'  => $dayAvailable->isAvailable(),
                'focus:ring-blue-700'  => $dayAvailable->isAvailable(),
                'focus:text-blue-700'  => $dayAvailable->isAvailable(),
                'dark:border-gray-600',
                'dark:hover:text-gray-500' => $dayAvailable->isAvailable(),
                'dark:focus:text-white'  => $dayAvailable->isAvailable(),
                'dark:focus:ring-gray-500'  => $dayAvailable->isAvailable(),
                'cursor-pointer'  => $dayAvailable->isAvailable(),
                'text-gray-500' => !$dayAvailable->isAvailable(),
            ])
            @disabled(!$dayAvailable->isAvailable())
            type="button">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
            </svg>
            {{"$dayAvailable->since " . __('hasta el') . " $dayAvailable->to"}}
        </button>
    @endforeach
</div>