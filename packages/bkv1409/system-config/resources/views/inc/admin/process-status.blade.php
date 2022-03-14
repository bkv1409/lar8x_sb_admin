@switch($status)
    @case(1)
    <span class="badge bg-success">SUCCESS</span>
    @break
    @case(2)
    <span class="badge bg-danger">FAILED</span>
    @break
    @case(3)
    <span class="badge bg-primary">IN PROGRESS</span>
    @break
    @case(4)
    <span class="badge bg-success">FETCHED</span>
    @break
    @default
    <span class="badge bg-secondary">INIT</span>
@endswitch
