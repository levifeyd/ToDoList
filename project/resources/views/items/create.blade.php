<x-app-layout>
    <h1 style="text-align: center; font-size: large; margin-top: 10px">Пожалуйста заполните поля для создания нового пункта</h1>
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
                <form>
                    @csrf
                    <div class="form-group">
                        <label for="name">Введите название пункта</label>
                        <input name="name" type="text" class="form-control" id="name">
                        <input type="hidden" value="{{$list->id}}" name="id">
                    </div>
                    <button type="button" id="send_form_item" class="btn btn-primary mt-4" style="background-color: green">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $('#send_form_item').on("click", function () {
        let name = $('#name').val();
        let id = {{$list->id}};
        let url = 'store-item';
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'post',
            data: {'name': name,'id': id},
            // data: formData,
            success: function(data){
                alert("Ваша пункт добавлен!");
            },
            error: function (data) {
                alert('Произошла ошибка! Проверьте корректное название пункта.');
            }
        });
    });
</script>

