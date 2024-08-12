<!-- To use this component we need to laod calendar.js plugin before -->
<div>
    <label for="availableDayFrom" class="block text-sm font-medium text-gray-900 dark:text-gray-300">{{$label}}</label>
    <div {{ $attributes->merge(['class' => 'wrapper-datepicker']) }}>
        <input {{ $attributes->merge(['data-class' => 'black-theme rounded-lg', 'class'=>"w-full", "data-datepicker" => ""]) }}/>
    </div>
</div>

<style>
    .wrapper-datepicker input {
        background-color: rgb(55 65 81 / var(--tw-bg-opacity)) !important;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        border-style: none;
    }
</style>