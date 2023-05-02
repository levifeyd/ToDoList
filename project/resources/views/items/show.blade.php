<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{--            {{ __('Пункты спсика "'.$list->name."\"") }}--}}
            {{ __('Пункты спсика') }}
        </h2>
    </x-slot>
    @if (session('status'))
        <div class="alert alert-success mt-4">
            {{ session('status') }}
        </div>
    @endif
    <div class="py-2" style="margin-left: 160px">
        <form method="post" action="{{ route('filter') }}">
            @csrf
            <label for="name_tag">Найти теги в пунктах списка</label>
            <div class="py-2">
            <input name="name_tag" type="text" id="name_tag" class="w-full h-12" placeholder="Введите название тега в списке" style="width: 270px"/><br>
            <button type="submit" id="filter_tag" class="btn btn-primary mt-2" style="background-color: blueviolet">Отфильтровать</button>
            </div>
        </form>
        <label for="name_tag">Найти пункт в списке</label><br>
        <input name="name_item" type="text" id="name_item" class="w-full h-12" placeholder="Введите название пункта в списке" style="width: 270px"/><br>
        <button type="button" id="search_button" class="btn btn-primary mt-2" style="background-color: blueviolet">Поиск</button>
    </div>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <ul id="items">
                                    <div class="card mb-4">
                                        <h8 class="card-header">Пункты списка:</h8>
                                    <?php $i = 0; ?>
                                    @foreach($items as $item)
                                        <li id="{{$item->name}}">
                                        <h8 class="card-header">
                                            <br>{{ ++$i.". ".$item->name}}
                                        </h8>
                                        @if(count($item->getTags))
                                        <div class="py-2 ml-4">
                                        <p>Теги пункта:</p>
                                            <?php $j = 0; ?>
                                            @foreach($item->getTags as $tags)
                                                <p>{{ ++$j.". ".$tags->name}}</p>
                                            @endforeach
                                        </div>
                                        @endif
                                        @if(isset($item->image))
                                            <div class="card-body">
                                                <a>Картинка пункта списка : </a>
                                                <img src="/storage/images/{{$item->image}}" width="150" height="150">
                                            </div>
                                        @endif
                                        <div class="card-body">
                                            <a href="{{ route('create-tag', $item->id) }}" class="btn btn-success">Добавить новый тег для пункта</a>
                                        @if(Auth::user()->hasRole('editor'))
                                            <a href="{{route('edit-item', $item->id)}}" class="btn btn-primary">Редактировать пункт списка</a>
                                            @endif
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $('#search_button').on("click", function () {
        let id = $('#name_item').val();
        console.log(id);
        const el = document.getElementById(id);
        el.scrollIntoView();
        el.scrollIntoView(false);
    });
</script>
