<x-app-layout>
{{dd($publication->picture)}}
    <div>
        <div id="photoSection">
            <img src="" alt="" srcset="">
        </div>
        <div id="infoSection">
            <h4>{{$publication->title}}</h4>
            <div id="price"></div>
            <div id="timestamp"></div>
            <div id="buttonsAction">
                <button>Button</button>
                <button>Button</button>
            </div>

            <div id="description"></div>

            <div id="ownerDescription">

            </div>
        </div>    
    </div>
</x-app-layout>
