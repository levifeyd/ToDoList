<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Доступы') }}
        </h2>
    </x-slot>
    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success mt-4">
                        {{ session('status') }}
                    </div>
                @endif
                @foreach($users as $user)
                    <div class="card mb-4">
                        <h5 class="card-header">{{$user->name}}</h5>
                        <h5 class="card-header"> Роль пользователя: "{{ $user->getRoleNames()[0]}}"</h5>
                        <div class="card-body">
                            @if(!strcmp('reader', $user->getRoleNames()[0]))
{{--                                <h8> Назначить роль 'editor'</h8>--}}
                                <a href="{{ route('roles-edit', $user->id) }}" class="btn btn-primary">Назначить роль 'editor'</a>
                            @else
{{--                                <h8> Назначить роль 'reader'</h8>--}}
                                <a href="{{ route('roles-edit', $user->id) }}" class="btn btn-primary">Назначить роль 'reader'</a>

                            @endif
                        </div>
{{--                        <div class="card-body">--}}
{{--                            <a href="{{ route('roles-edit', $user->id) }}" class="btn btn-primary">Сохранить</a>--}}
{{--                        </div>--}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
