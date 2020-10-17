
@if ($paginator->lastPage() > 1)
    <ul style="color: #9d9d9d;" class="pagination">
        <li class="{{ ($paginator->currentPage() == 1) ? 'disabled' : '' }}">
            <a style="font-size: 25px; background-color: #f2f2f2" href="{{ $paginator->url(1) }}"><i class="fa fa-angle-left"></i></a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                <a style="font-size: 25px;background-color: #f2f2f2" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'disabled' : '' }}">
            <a style="font-size: 25px;background-color: #f2f2f2" href="{{ $paginator->url($paginator->currentPage()+1) }}" ><i class="fa fa-angle-right"></i></a>
        </li>
    </ul>
@endif

