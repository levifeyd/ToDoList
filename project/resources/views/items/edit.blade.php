<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/vanillajs@1.0.1/dest/cjs/index.min.js"></script>
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
                        <label for="exampleInputEmail">Введите название пункта</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="{{$item->name}}">
                    </div>
                    <input name="image" type="file" id="image" class="w-full h-12" placeholder="Пожалуйста загрузите картинку для списка" />
                    <div class="col-md-12 mb-2">
                        <a href="javascript:imageLink();" id="src_link">
                        <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                             alt="preview image" style="height: 150px; width: 150px">
                        </a>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4" style="background-color: green">Отправить</button>
                </form>
                    <a href="{{ route('delete-items-image', $item->id) }}" class="btn btn-danger mb-4 mt-6">Удалить картинку в списке</a>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function (e) {
        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
    function imageLink() {
        const c = document.getElementById("preview-image-before-upload"); // берем картинку по id
        const d = c.src; // берем ее src
        const w = window.open('about:blank','new image'); // открываем окно
        w.document.write("<img src='" + d + "' alt='from old image' />"); //  вставляем картинку
    }
</script>
