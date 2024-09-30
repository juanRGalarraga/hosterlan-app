@foreach ($publications as $publication)
    <tr>
        <td class="py-2 px-4 border-b border-gray-700">{{$publication->id}}</td>
        <td class="py-2 px-4 border-b border-gray-700">{{$publication->title}}</td>
        <td class="py-2 px-4 border-b border-gray-700">{{$publication->description}}</td>
        <td class="py-2 px-4 border-b border-gray-700">{{convert($publication->price)}}</td>
        <td class="py-2 px-4 border-b border-gray-700">{{$publication->created_at}}</td>
        <td class="py-2 px-4 border-b border-gray-700">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Editar</button>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Eliminar</button>
        </td>
    </tr>
@endforeach