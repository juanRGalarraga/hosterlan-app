@props(['label' => '', 'checked' => 0])

<div class="flex justify-between">
    @if (!empty($label))
        <x-form.label text="{{$label}}"></x-form.label>
    @endif
    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
        <input @checked($checked == 1) {{ $attributes->merge(["type"=>"checkbox", "class" => "toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer", 'onclick' => 'toggleSwitchOnChange(this)', 'value' => 0]) }}/>
        <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
    </div>
</div>
<script>
    function toggleSwitchOnChange(inputCheckBox){
        let newValue = inputCheckBox.getAttribute('value') == 1 ? 0 : 1;
        inputCheckBox.setAttribute('value', newValue);
    }
</script>

<style>
    /* CHECKBOX TOGGLE SWITCH */
    /* @apply rules for documentation, these do not work as inline style */
    .toggle-checkbox:checked {
        @apply: right-0 border-green-400;
        right: 0;
        border-color: #68D391;
    }
    .toggle-checkbox:checked + .toggle-label {
        @apply: bg-green-400;
        background-color: #68D391;
    }
</style>