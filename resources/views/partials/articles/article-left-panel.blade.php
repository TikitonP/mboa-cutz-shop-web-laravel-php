<div class="col-md-8 ftco-animate">
    {{-- Details area --}}
    <h2 class="mb-3">{{ $article->name }}</h2>
    <p><img src="{{ $article->image_src }}" alt="..." class="img-fluid"></p>
    <p>{!! $article->description !!}</p>

    <div class="tag-widget post-tag-container mb-5 mt-5">
        <div class="tagcloud">
            @foreach($article->tags as $tag)
                <a href="#" class="tag-cloud-link">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>

    {{-- Author area --}}
    <div class="about-author d-flex p-3 pb-0 ftco-bg-dark">
        <div class="desc">
            <img src="{{ $article->creator->avatar_src }}" alt="..." width="80" class="float-left mr-4">
            <h3>@lang('general.author')</h3>
            <h6>{{ $article->creator_name }}</h6>
            <p>{{ $article->creator->description }}</p>
        </div>
    </div>

    <div class="mt-5"
         id="article-comments-infinite-scroll"
         data-url="{{ locale_route('article.comments.ajax', compact('article')) }}"
    >
        {{-- Comment input area --}}
        <div class="comment-form-wrap mb-5 pb-4">
            @auth
                <h5 class="mb-2">@lang('general.leave_a_comment')</h5>
                <div class="mx-lg-5 my-2">@include('partials.toast-message')</div>
                <form action="{{ locale_route('articles.comment', compact('article')) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="description">
                            @if ($errors->has('description'))
                                <small class="text-danger">
                                    {{ $errors->first('description') }}
                                </small>
                            @endif
                        </label>
                        <textarea name="description" id="description" rows="5" class="form-control p-3">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                    </div>
                </form>
            @else
                <div class="alert alert-dark">
                    @lang('general.connect_before_comment') <br>
                    @lang('general.click') <a href={{ locale_route('login') }}>@lang('general.here')</a> @lang('general.to_connect')
                </div>
            @endauth
        </div>

        {{-- Comments area --}}
        <h5 class="mb-4">{{ $article->comments->count() }} @lang('general.comments')</h5>
        <article-comments-component></article-comments-component>
    </div>
</div>