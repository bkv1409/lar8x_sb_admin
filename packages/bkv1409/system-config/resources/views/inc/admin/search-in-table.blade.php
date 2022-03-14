<div>
    <form action="{{$route ?? ''}}" method="GET" class="input-group input-group-sm">
        <input type="text" name="search" class="form-control float-right"
               placeholder="{{$desc ?? 'Name or Description'}}" value="{{$search ?? ''}}">

        <div class="input-group-text input-group-sm">
            <a class="btn btn-default " href="{{$route ?? ''}}">
                <i class="fa fa-recycle"></i>
            </a>
            <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
            </button>
        </div>

    </form>
</div>
