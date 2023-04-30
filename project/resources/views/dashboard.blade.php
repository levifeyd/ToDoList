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
    <a href="{{ route('create-item') }}" class="btn btn-success mb-4 mt-6" style="margin-left: 160px">Добавить новый список</a>
    @foreach($items as $item)
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h8 class="card-header">Название списка: {{ $item->name }}</h8>
                                    <?php $i = 0; ?>
                                    @if(count($item->getTags))
                                        <h8 class="card-header">Теги:
                                        @foreach($item->getTags as $tag)
                                                <br>{{ ++$i.". ".$tag->name}}
                                        @endforeach
                                    @endif
                                    @if(isset($item->image))
                                    <div class="card-body">
                                        <a>Картинка списка : </a>
                                        <img src="/storage/images/{{$item->image}}" width="150" height="150">
                                    </div>
                                     @endif
                                    <div class="card-body">
                                        <a href="{{ route('create-tag', $item->id) }}" class="btn btn-success">Добавить новый тег для спсика</a>
                                    </div>
                                        @if(Auth::user()->hasRole('editor'))
                                    <div class="card-body">
                                        <a href="{{route('edit-item', $item->id)}}" class="btn btn-primary">Редактировать список</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
