@foreach ($publications as $publication)
    <tr>
        <td class="py-2 px-4 border-b border-gray-700">{{$publication->id}}</td>
        <td class="py-2 px-4 border-b border-gray-700" title="{{$publication->title}}">{{elipsis($publication->title)}}</td>
        <td class="py-2 px-4 border-b border-gray-700" title="{{$publication->description}}">{{elipsis($publication->description)}}</td>
        <td class="py-2 px-4 border-b border-gray-700">{{convert($publication->price)}}</td>
        <td class="py-2 px-4 border-b border-gray-700">{{$publication->getDateShortFormat()}}</td>
        <td class="py-2 px-4 border-b border-gray-700 text-center">
            <div class="flex flex-row justify-between">
                <a href="{{ route('publications.edit', $publication->id) }}" class=" text-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white border border-blue-500 hover:border-transparent rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828zM4 12v4h4v-4H4z" />
                    </svg>
                </a>
                <a href="{{ route('publications.destroy', $publication->id) }}" title="{{__('Eliminar')}}" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white  border border-red-500 hover:border-transparent rounded col-span-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{$publication->id}}').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H3a1 1 0 100 2h1v10a2 2 0 002 2h8a2 2 0 002-2V6h1a1 1 0 100-2h-1V3a1 1 0 00-1-1H6zm3 4a1 1 0 112 0v8a1 1 0 11-2 0V6z" clip-rule="evenodd" />
                    </svg>
                </a>
                <form id="delete-form-{{$publication->id}}" action="{{ route('publications.destroy', $publication->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </td>
    </tr>
@endforeach