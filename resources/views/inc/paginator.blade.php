@if(!empty($data) && $data->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="{{ $data->previousPageUrl() }}"
                   aria-label="Previous" @if($data->currentPage() == 1) disabled onclick="return false;" @endif>
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            @for($i = 1; $i <= $data->lastPage() ; $i++)
                @if($data->lastPage() >= 2)
                    <li class="page-item">
                        <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor
            <li class="page-item">
                <a class="page-link" href="{{ $data->nextPageUrl() }}" aria-label="Next"
                   @if($data->currentPage() == $data->lastPage()) disabled onclick="return false;" @endif>
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
@endif
