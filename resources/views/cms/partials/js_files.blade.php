
{{-- in webpack --}}
<script src="{{ asset('cms-template/template/assets/js/libs/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('cms-template/js/all.js') }}"></script>

<!-- Demo JS -->
<script>
$(document).ready(function(){
    "use strict";
    App.init(); // Init layout and core plugins
    Plugins.init(); // Init all plugins
    FormComponents.init(); // Init all form-specific plugins
});
</script>

{{-- <script src="{{asset('js/all1.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
@include('cms/partials/datatables')

<script type="text/javascript" src="{{asset('cms-template/template/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>

{{-- base url for laravel app --}}
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
</script>

{{-- air-datepicker js --}}
<script src="{{ asset('cms-template/packages/air-datepicker-master/dist/js/datepicker.min.js') }}"></script>

<!-- Include English language -->
<script src="{{ asset('cms-template/packages/air-datepicker-master/dist/js/i18n/datepicker.en.js') }}"></script>

{{-- air-datepicker functions --}}
<script src="{{ asset('cms-template/js/air-datepicker/index.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('cms-template/js/select2.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- 02/21/2022 --}}

<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('[data-toggle="popover"]').popover({
        container: 'body'
    });
});
</script>