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
    <a href="{{ route('create-list') }}" class="btn btn-success mb-4 mt-6" style="margin-left: 160px">Добавить новый список</a>
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
                                            <h8 class="text ml-2">Теги пункта:</h8>
                                                <?php $j = 0; ?>
                                                @foreach($item->getTags as $tags)
                                                    <h8 class="text ml-2">
                                                    <br>{{ ++$j.". ".$tags->name}}
                                                    </h8>
                                                @endforeach
                                            @endif
                                            @if(isset($item->image))
                                                <div class="card-body">
                                                    <a>Картинка списка : </a>
                                                    <img src="/storage/images/{{$item->image}}" width="150" height="150">
                                                </div>
                                            @endif
                                            <div class="card-body">
                                                <a href="{{ route('create-tag', $item->id) }}" class="btn btn-success">Добавить новый тег для пункта</a>
                                            </div>
                                            @if(Auth::user()->hasRole('editor'))
                                                <div class="card-body">
                                                    <a href="{{route('edit-item', $item->id)}}" class="btn btn-primary">Редактировать список</a>
                                                </div>
                                            @endif
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
