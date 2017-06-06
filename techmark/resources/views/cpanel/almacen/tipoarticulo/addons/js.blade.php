<script src="{{url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>

<script src="{{url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>

<script>
    // Select2
    $(".select2").select2();
    $('.selectpicker').selectpicker();
    //validation
    $(document).ready(function(){


        $("#form-articulo").attr('autocomplete', 'off');
        $('#articulo').bind("input",function(){
            @if(Request::segment(3)!='edit')
            var url = '{{url('validation/username')}}';
            @else
            var _id = '{{$art->id}}';
            var url = '{{url('validation/usernameUp')}}';
            @endif
            var user = $('#articulo').val();
            $.ajax({
                url: url,
                type: 'POST',
                @if(Request::segment(3)!='edit')
                data: { username: user} ,
                @else
                 data: { username: user,id:_id} ,
                @endif
                success: function (json) {
                    $('#Message').removeClass(' text-danger');
                    $('#Message').addClass(' text-success')
                    $('#Message').html(json);
                },
                error: function (data) {
                    var errors = '';
                    for(datos in data.responseJSON){
                        errors += data.responseJSON[datos] + '<br>';
                    }
                    $('#Message').removeClass(' text-success');
                    $('#Message').addClass(' text-danger');
                    $('#Message').show().html(errors); //this is my div with messages
                }
            });
        });


    });

</script>
@if(Request::segment(4)=='edit')
<script src="{{url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
<script>
    $('#btn-delete').click(function (e) {
        swal({
            title: "Esta usted Seguro?",
            text: "No podrás recuperar esta informacion",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Estoy seguro!",
            cancelButtonText: "No, Cancelar !",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $('#form-delete').submit()
            } else {
                swal("Cancelado", "Su informacion esta segura", "error");
            }
        });
    });
</script>
<script>
    $(window).load(function(){
        @if(Session::has('message'))
        swal("Actualizacion Exitosa", " ", "success")
        @endif
    });
</script>
@endif

<script>

    $('#cargo').on('change', function() {
        if( this.value =="Afiliado" || this.value =="2" ){
            $('#empresa').prop("disabled", false);
        }else{
            $('#empresa').prop("disabled", true);
        }
    });
    $(document).ready(function(){
        var x = $("#cargo").val();
        if( x =="Afiliado" || x =="2" ){
            $('#empresa').prop("disabled", false);
        }else{
            $('#empresa').prop("disabled", true);
        }
    });
</script>
