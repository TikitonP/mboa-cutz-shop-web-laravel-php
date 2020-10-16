@inject('articleService', 'App\Services\ArticleService')
<footer class="ftco-footer ftco-section img">
    <div class="overlay"></div>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">@lang('general.about')</h2>
                    <p>@lang('home.welcome_description', ['name' => config('app.name')])</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="{{ config('company.twitter') }}"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="{{ config('company.facebook') }}"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="{{ config('company.instagram') }}"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">@lang('general.recently')</h2>
                    @foreach($articleService->latestArticles() as $article)
                        @include('partials.articles.article-card-mini', compact('article'))
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">@lang('general.contact_us')</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">{{ config('company.address') }}</span></li>
                            <li><span class="icon icon-phone"></span><span class="text">{{ config('company.phone') }}</span></li>
                            <li><span class="icon icon-envelope"></span><span class="text">{{ config('company.email') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    Copyright &copy; MBOA CUTZ 2020 | Design by
                    <a href="https://croquignolex-tikiton.dmsemergence.com/" target="_blank">Croquignolex Tikiton</a>
                </p>
            </div>
        </div>
    </div>
</footer>