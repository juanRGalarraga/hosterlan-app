<!-- To use this component we need to laod calendar.js plugin before -->

<div class="wrapper-datepicker">
    <label for="availableDayFrom" class="mr-3">{{$label}}</label>
    <input {{ $attributes->merge(['data-class' => 'black-theme', 'data-datepicker' => '']) }}/>
</div>

<style>
    .wrapper-datepicker input {
        background-color: black !important;
    }
</style>