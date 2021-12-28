<div class="input-group date-time" id="{{$id}}" data-target-input="nearest">
    <input type="text" class="form-control datetimepicker-input" data-target="#{{$id}}"
           placeholder="yyyy-MM-DD HH:mm:ss" name="{{$id}}" value="{{$input ?? ''}}"/>
    <div class="input-group-append" data-target="#{{$id}}" data-toggle="datetimepicker">
        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
    </div>
</div>

