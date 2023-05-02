<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добро пожаловать в приложение ToDoList') }}
        </h2>
    </x-slot>
    @if (session('status'))
        <div class="alert alert-success mt-4">
            {{ session('status') }}
        </div>
    @endif
    <div style="margin-left: 160px">
    <a href="{{ route('create-list') }}" class="btn btn-success mb-4 mt-6">Добавить новый список</a>
    <form method="post" action="{{ route('filter') }}">
        @csrf
        <label for="name_tag">Найти теги в списках</label>
        <div class="py-2">
        <input name="name_tag" type="text" id="name_tag" class="w-full h-12" placeholder="Введите название тега в списке" style="width: 270px"/><br>
        <button type="submit" id="filter_tag" class="btn btn-primary mt-2" style="background-color: blueviolet">Отфильтровать</button>
        </div>
    </form>
    <a href="{{ route('dashboard') }}" class="btn btn-success mb-4 mt-2">Показать все списки</a>
    </div>
    @foreach($lists as $list)
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h8 class="card-header">Название списка: {{$list->name}}</h8>
                                    <?php $i = 0; ?>
                                    @if(count($list->getItems))
                                        <h8 class="card-header">Пункты списка:</h8>
                                        @foreach($list->getItems as $item)
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
                                    @endif
                                    <div class="card-body">
                                        <a href="{{ route('create-item', $list->id)}}" class="btn btn-success">Добавить новый пункт списка</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
{{--<script>--}}
{{--    $('#filter_tag').on("click", function () {--}}
{{--        let name_tag = $('#name_tag').val();--}}
{{--        let url = 'filter';--}}
{{--        $.ajax({--}}
{{--            url: url,--}}
{{--            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
{{--            method: 'post',--}}
{{--            data: {'name_tag': name_tag},--}}
{{--            success: function(data){--}}
{{--                alert(data);--}}
{{--            },--}}
{{--            error: function (data) {--}}
{{--                alert('Произошла ошибка! Проверьте корректное название тега спика.');--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
