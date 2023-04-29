<x-app-layout>
    <h1 style="text-align: center; font-size: large; margin-top: 10px">Пожалуйста заполните поля для списка "{{$item->name}}"</h1>
    <div class="container mt-18">
        <div class="row">
            <div class="col-md-6">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form enctype="multipart/form-data" method="POST" action="{{ route('update-item', $item->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail">Введите название книги</label>
                        <input name="name" type="text" class="form-control" id="exampleInputEmail" placeholder="{{$item->title}}">
                    </div>
                    <input name="image" type="file" class="w-full h-12" placeholder="Пожалуйста загрузите картинку для списка" />
                    <button type="submit" class="btn btn-primary mt-4" style="background-color: green">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
