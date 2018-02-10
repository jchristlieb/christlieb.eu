<div class="card mb-4">
    <div class="card-header">
        {{$latestArticle->title}}
    </div>
    <div class="card-body">
        {{$latestArticle->getExcerpt(10)}}
    </div>
</div>
