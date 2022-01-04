@if ($paginator->lastPage() > 1)
<small>Showing {{$paginator->currentPage()}} of {{$paginator->lastPage()}} pages </small>
<ul class="pagination">
    <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url($paginator->currentPage()-1) }}" >Previous</a>
    </li> 
    @if ($paginator->currentPage() == $paginator->lastPage() && $paginator->lastPage() > 2)
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url($paginator->currentPage()-2) }}">{{ $paginator->currentPage()-2 }}</a>
        </li>
    @endif
    @if ($paginator->currentPage() != 1)   
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url($paginator->currentPage()-1) }}">{{ $paginator->currentPage()-1 }}</a>
        </li>
    @endif
    
    <li class="page-item active">
        <a class="page-link" href="{{ $paginator->url($paginator->currentPage()) }}">{{ $paginator->currentPage() }}</a>
    </li>
    @if ($paginator->currentPage() != $paginator->lastPage())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}">{{ $paginator->currentPage()+1 }}</a>
        </li>
    @endif
    @if ($paginator->currentPage() == 1 && $paginator->lastPage() > 2)
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+2) }}">{{ $paginator->currentPage()+2 }}</a>
        </li>
    @endif
    <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}" >Next</a>
    </li>
</ul>
@endif
