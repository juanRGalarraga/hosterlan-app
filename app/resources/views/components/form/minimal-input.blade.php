<div {{ $attributes->merge(['class' => 'max-w-2xl mx-auto']) }}>
    @if(!empty($label))
    <label for="{{$id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $label }}</label>
    @endif
    <div class="flex">
        @if(!empty($labelIcon))
        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
            {{$labelIcon}}
        </span>
        @endif
        <input type="{{$type}}" id="{{$id}}" name="{{$name}}" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{$placeholder}}"z>
    </div>
</div>