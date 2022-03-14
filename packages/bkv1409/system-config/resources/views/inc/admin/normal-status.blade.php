@switch($status)
    @case(1)
    <span class="badge bg-success">ACTIVE</span>
    @break
    @case(0)
    <span class="badge bg-danger">DISABLE</span>
    @break
    @default
    <span class="badge bg-secondary">UNKNOWN</span>
@endswitch
