<!-- To use this component we need to laod calendar.js plugin before -->
<div>
    <label for="availableDayFrom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$label}}</label>
    <div {{ $attributes->merge(['class' => 'wrapper-datepicker']) }}>
        <input data-class="black-theme rounded-lg"  data-datepicker/>
    </div>
</div>

<style>
    .wrapper-datepicker input {
        background-color: black !important;
        border-radius: 9px !important;
    }
</style>