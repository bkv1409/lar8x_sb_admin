@switch($status)
    @case(1)
    <span class="badge badge-success">SUCCESS</span>
    @break
    @case(2)
    <span class="badge badge-danger">FAILED</span>
    @break
    @case(3)
    <span class="badge badge-primary">IN PROGRESS</span>
    @break
    @case(4)
    <span class="badge badge-success">FETCHED</span>
    @break
    @default
    <span class="badge badge-secondary">INIT</span>
@endswitch
