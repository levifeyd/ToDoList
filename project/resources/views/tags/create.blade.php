<x-app-layout>
    <h1 style="text-align: center; font-size: large; margin-top: 10px">Пожалуйста заполните поле для создания тега пункта в списке в приложении</h1>
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
                <form method="post" action="{{ route('store-tag', $item->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail">Введите название тега</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>
                    <button type="submit" id="send_form_item" class="btn btn-primary" style="background-color: green">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

