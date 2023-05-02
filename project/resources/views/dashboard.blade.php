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
                                    <div class="card-body">
                                        <a href="{{ route('create-item', $list->id)}}" class="btn btn-primary">Добавить новый пункт списка</a>
                                        <a href="{{ route('show-item', $list->id)}}" class="btn btn-success">Просмотреть пункты списка</a>
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
