@include('view.header')

<div class="addForm">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Добавление книги') }}</div>

                <div class="card-body">
                    <form method="POST" action="/add/book" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Название') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <div class="form-group row">
                            <label for="pub_id" class="col-md-4 col-form-label text-md-right">{{ __('Издательство') }}</label>

                            <div class="col-md-6">
                                <select name="pub_id">
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->pub_id }}"
                                        @if ($publisher->pub_id == old('pub_id'))
                                            selected="selected"
                                        @endif
                                        >{{ $publisher->name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>

                        <br>
                        <div class="form-group row">
                            <label for="cat_id" class="col-md-4 col-form-label text-md-right">{{ __('Категория') }}</label>

                            <div class="col-md-6">
                                <select name="cat_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->cat_id }}"
                                        @if ($category->cat_id == old('cat_id'))
                                            selected="selected"
                                        @endif
                                        >{{ $category->name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>

                        <br>
                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Автор') }}</label>

                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" required autocomplete="author" autofocus>

                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <br>
                        <div class="form-group row">
                            <label for="pages" class="col-md-4 col-form-label text-md-right">{{ __('Кол-во страниц') }}</label>

                            <div class="col-md-6">
                                <input id="pages" type="text" class="form-control @error('pages') is-invalid @enderror" name="pages" value="{{ old('pages') }}" required autocomplete="pages" autofocus>

                                @error('pages')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <div class="form-group row">
                            <label for="dat" class="col-md-4 col-form-label text-md-right">{{ __('Год издания') }}</label>

                            <div class="col-md-6">
                                <input id="dat" type="text" class="form-control @error('dat') is-invalid @enderror" name="dat" value="{{ old('dat') }}" required autocomplete="dat" autofocus>

                                @error('dat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <br>
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Цена') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Обложка') }}</label>

                            <div class="col-md-6">
                                <input value="Загрузить обложку" name="image" required type="file" id="image">
                            </div>
                        </div>

                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Добавить') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('view.footer')

