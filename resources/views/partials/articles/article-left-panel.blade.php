<div class="col-md-8 ftco-animate">
    {{-- Details area --}}
    <h2 class="mb-3">{{ $article->name }}</h2>
    <p>{{ $article->description }}</p>
    <p><img src="{{ $article->image_src }}" alt="..." class="img-fluid"></p>

    <div class="tag-widget post-tag-container mb-5 mt-5">
        <div class="tagcloud">
            @foreach($article->tags as $tag)
                <a href="#" class="tag-cloud-link">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>

    {{-- Author area --}}
    <div class="about-author d-flex p-3 ftco-bg-dark">
        <div class="bio mr-4">
            <img src="{{ $article->creator->avatar_src }}" alt="..." width="150">
        </div>
        <div class="desc">
            <h3>@lang('general.author')</h3>
            <h6>{{ $article->creator_name }}</h6>
            <p>{{ $article->creator->description }}</p>
        </div>
    </div>

    {{-- Comments area --}}
    <div class="pt-5 mt-5">
        <h3 class="mb-5">{{ $article->comments->count() }} @lang('general.comments')</h3>
        <ul class="comment-list">
            @foreach($article->comments as $comment)
                @if($comment->creator !== null)
                    <li class="comment">
                        <div class="vcard bio">
                            <img src="{{ $comment->creator->avatar_src }}" alt="Image placeholder">
                        </div>
                        <div class="comment-body">
                            <h3>{{ $comment->creator_name }}</h3>
                            <div class="meta">{{ $comment->creation_date }}</div>
                            <p>{{ $comment->description }}</p>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>

        {{-- Comment input area --}}
        <div class="comment-form-wrap pt-5">
            @auth
                <h3 class="mb-5">@lang('general.leave_a_comment')</h3>
                <div class="my-4">
                    @include('partials.app-error-message')
                </div>
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
    </div>
</div>