@if ($paginator->getLastPage() > 1)
@if ($paginator->getCurrentPage() < $paginator->getLastPage())
<!--<input id="page_url" type="hidden" value="&#x2F;"/>-->
<a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}">
<input id="loadmore_btn" type="button" class="button" value="عرض المزيد"/>
</a>
@endif
@endif