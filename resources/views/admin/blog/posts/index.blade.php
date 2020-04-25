@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{route('admin.blog.posts.create')}}">Создать</a>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Сортировка
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('admin.blog.posts.index')}}">Все</a>
                            <a class="dropdown-item" href="{{route('blog.posts.not-published')}}">Не опубликованные</a>
                        </div>
                    </div>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>Автор</td>
                                <td>Категория</td>
                                <td>Заголовок</td>
                                <td>Дата публикации</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                @php
                                    /** @var \App\Models\BlogPost $post */
                                @endphp
                                <tr @if(!$post->is_published) style="background-color: #ccc;" @endif>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->user_id}}</td>
                                    <td>{{$post->category_id}}</td>
                                    <td>
                                        <a href="{{route('admin.blog.posts.edit',$post->id)}}">{{$post->title}}</a>
                                    </td>
                                    <td>{{$post->created_at ? \Carbon\Carbon::parse($post->created_at)->format('d.M H:i') : ""}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($posts->total() > $posts->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
