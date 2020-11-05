@extends ('layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div class="title">
                    <h2>Articles</h2>
                </div>
            <ul>
                @forelse($articles as $article)
                    <li>
                        <h3>
                            <a href="{{$article->path()}}">{{ $article->title }}</a>
                        </h3>
                        <p>{{ $article->excerpt }}.</p>
                    </li>
                @empty <p>No relevant articles yet</p>
                @endforelse
            </ul>
            </div>
        </div>
    </div>
@endsection