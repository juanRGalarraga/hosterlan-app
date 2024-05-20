<x-app-layout>
    <div class="text-white flex flex-row p-3">
        <div class="basis-1/2" id="description">
            <div id="publisher"></div>
            <div id="picture">
                <div id="dropzone"></div>
            </div>
            <select name="rent-type" id="rent-type">
                <option value="house">{{__("Casa")}}</option>
                <option value="depto">{{__("Departamento")}}</option>
                <option value="hut">{{__("Cabaña")}}</option>
            </select>

            <div class="max-w-2xl mx-auto">
                <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Username</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        @
                    </span>
                    <input type="text" id="website-admin" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="elonmusk">
                </div>
            </div>
            
        </div>
        <div class="">
            
        </div>
    </div>
</x-app-layout>