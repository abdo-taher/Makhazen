'use strict' ;
$('#customer-slice').on('change',function (event){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: $(this).serialize(),
        success: function (data) {
            toastr.success($('.slice_id').data('success'));
        }
    });
});
