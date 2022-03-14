<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin - System Config</title>
    {{--        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />--}}
    <link href="{{asset('system-config/css/app.css')}}" rel="stylesheet" />
    @stack('css')
    <script src="{{asset('system-config/js/font-awesome.js')}}" ></script>
</head>
<body class="sb-nav-fixed">
{{--@include('system-config::inc.navbar')--}}
<div id="layoutSidenav">
{{--    @include('inc.side-nav')--}}
    <div id="layoutSidenav_content">
        <main id="app">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center mt-3">
                    <h1 class=" ">{{$title ?? 'Title'}}</h1>
                    <div class="ps-3 ms-3 d-flex">
                        @yield('control-button')
                    </div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{$title ?? 'Title'}}</li>
                </ol>

                @include('system-config::inc.generic-alert')

                @yield('content')
            </div>
        </main>
{{--        @include('system-config::inc.footer')--}}
    </div>
</div>
<script src="{{asset('system-config/js/app.js')}}"></script>
<script>
    /**
     * function support range input
     */
    function modifyOffset() {
        var el, newPoint, newPlace, offset, siblings, k;
        width = this.offsetWidth;
        newPoint = (this.value - this.getAttribute("min")) / (this.getAttribute("max") - this.getAttribute("min"));
        offset = -1;
        if (newPoint < 0) {
            newPlace = 0;
        } else if (newPoint > 1) {
            newPlace = width;
        } else {
            newPlace = width * newPoint + offset;
            offset -= newPoint;
        }
        siblings = this.parentNode.childNodes;
        for (var i = 0; i < siblings.length; i++) {
            sibling = siblings[i];
            if (sibling.id === this.id) {
                k = true;
            }
            if ((k === true) && (sibling.nodeName === "OUTPUT")) {
                outputTag = sibling;
            }
        }
        outputTag.style.left = newPlace + "px";
        outputTag.style.marginLeft = offset + "%";
        outputTag.innerHTML = this.value;
    }


    function modifyInputs() {
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].getAttribute("type") === "range") {
                inputs[i].onchange = modifyOffset;

                // the following taken from http://stackoverflow.com/questions/2856513/trigger-onchange-event-manually
                if ("fireEvent" in inputs[i]) {
                    inputs[i].fireEvent("onchange");
                } else {
                    var evt = document.createEvent("HTMLEvents");
                    evt.initEvent("change", false, true);
                    inputs[i].dispatchEvent(evt);
                }
            }
        }
    }

    /**
     * end function support range input
     */
    (function(old) {
        $.fn.attr = function() {
            if(arguments.length === 0) {
                if(this.length === 0) {
                    return null;
                }

                var obj = {};
                $.each(this[0].attributes, function() {
                    if(this.specified) {
                        obj[this.name] = this.value;
                    }
                });
                return obj;
            }

            return old.apply(this, arguments);
        };
    })($.fn.attr);

    function convertInputToTextarea($el) {
        if ($el.is('input')) {
            var attStr = getAttrString($el, {type: ''})
            var value = $el.val()
            return $el.replaceWith("<textarea " + attStr + ">" + value + "</textarea>");
        }
        return $el
    }

    function convertTextareaToInput($el, typeVal) {
        if ($el.is('textarea')) {
            var attStr = getAttrString($el, {value: $el.val(), type: typeVal})
            var value = $el.val()
            console.log('val' + value)
            console.log($el.text())
            $el.replaceWith("<input " + attStr + "/>");
        } else {
            $el.attr('type', typeVal)
        }
        return $el
    }
    function getAttrString($el, extObj) {
        var attrs = $el.attr();
        if (extObj) {
            attrs = {...attrs, ...extObj}
        }
        console.log(attrs)
        var attStr = ''
        Object.keys(attrs).forEach(el => {
            console.log(el)
            console.log(attrs[el])
            if (attrs[el]) attStr += el + "='" + attrs[el] + "' "
        })
        console.log(attStr)
        return attStr
    }

    function changeTypeSystemConfig() {
        $('#typeSelectId').on('change', function () {
            var selectedVal = $( "#typeSelectId option:selected" ).val();
            var $inputEl = $('#valueInput')
            var $previewEl = $('#valuePreviewId')

            console.log(selectedVal);
            switch (selectedVal) {
                case 'number':
                case 'boolean':
                    convertTextareaToInput($inputEl, 'number')
                    // $inputEl.attr('type', 'number')
                    $inputEl.removeAttr('pattern')
                    $previewEl.hide()
                    break
                case 'datetime':
                    convertTextareaToInput($inputEl, 'datetime-local')
                    // $inputEl.attr('type', 'datetime-local')
                    $inputEl.attr('pattern', "[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}")
                    $previewEl.hide()
                    break
                case 'file':
                    $inputEl = convertTextareaToInput($inputEl, 'file')
                    // $inputEl.attr('type', 'file')
                    $inputEl.removeAttr('pattern')
                    $previewEl.show()
                    break
                case 'textarea':
                    convertInputToTextarea($inputEl)
                    $inputEl.removeAttr('pattern')
                    $previewEl.hide()
                    break
                case 'text':
                default:
                    convertTextareaToInput($inputEl, 'text')
                    // $inputEl.attr('type', 'text')
                    $inputEl.removeAttr('pattern')
                    $previewEl.hide()

            }
            console.log($inputEl)
        })
    }

    $( document ).ready(function() {
        modifyInputs()
        changeTypeSystemConfig()
    });
</script>
@stack('js')
</body>
</html>

