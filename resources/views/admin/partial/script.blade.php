<!-- jQuery -->
<script src="{{asset ('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset ('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{-- <script>
  $.widget.bridge('uibutton', $.ui.button)
</script> --}}
<!-- Bootstrap 4 -->
<script src="{{asset ('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
{{-- <script src="{{asset ('admin/plugins/chart.js/Chart.min.js') }}"></script> --}}
<!-- Sparkline -->
{{-- <script src="{{asset ('admin/plugins/sparklines/sparkline.js') }}"></script> --}}
<!-- JQVMap -->
{{-- <script src="{{asset ('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
{{-- <script src="{{asset ('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
<!-- jQuery Knob Chart -->
{{-- <script src="{{asset ('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
<!-- daterangepicker -->
{{-- <script src="{{asset ('admin/plugins/moment/moment.min.js') }}"></script> --}}
<script src="{{asset ('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset ('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
{{-- <script src="{{asset ('admin/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
<!-- overlayScrollbars -->
{{-- <script src="{{asset ('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
<!-- AdminLTE App -->
<script src="{{asset ('admin/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset ('admin/dist/js/demo.js') }}"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{asset ('admin/dist/js/pages/dashboard.js') }}"></script> --}}
<!-- DataTables  & Plugins -->
<script src="{{asset ('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset ('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset ('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset ('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
    
{{-- <script>
    $('#flash-overlay-modal').modal();
</script> --}}

<script>
  $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  $(document).ready(function() {
$('#datatable').DataTable();
} );
  </script>
    
 <script type="text/javascript">
  
$('.sa-delete').on('click',function(){
    let form_id=$(this).data('form-id');
// alert(form_id);
    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $('#'+form_id).submit();
  }
});
})
</script>


  
<script type="text/javascript">
  
  $('.sa-delete').on('click',function(){
      let form_id=$(this).data('form-id');
  // alert(form_id);
      swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this imaginary file!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $('#'+form_id).submit();
    }
  });
  })
  </script>







@push('scripts')
    <script type="text/javascript">
        // Upload Image Preview
        $(document).ready(function (e) {
            //add more fields group
            $(".addMore").click(function(){
                    var fieldHTML='<div class="row prices p-3" style="margin-top:5px!important">'
                    +$(".pricesCopy").html()+'</div>';
                    $('body').find('.prices:last').after(fieldHTML);
                });
            //remove fields group
            $("body").on("click",".remove",function(){
                    $(this).parents(".prices").remove();
                });
        });
    </script>


<script>
     $(document).ready(function(){
            //-- Click on detail
            $("ul.menu-items > li").on("click",function(){
                $("ul.menu-items > li").removeClass("active");
                $(this).addClass("active");
            })

            $(".attr,.attr2").on("click",function(){
                var clase = $(this).attr("class");

                $("." + clase).removeClass("active");
                $(this).addClass("active");
            })

            //-- Click on QUANTITY
            $(".btn-minus").on("click",function(){
                var now = $(".section > div > input").val();
                if ($.isNumeric(now)){
                    if (parseInt(now) -1 > 0){ now--;}
                    $(".section > div > input").val(now);
                }else{
                    $(".section > div > input").val("1");
                }
            })            
            $(".btn-plus").on("click",function(){
                var now = $(".section > div > input").val();
                if ($.isNumeric(now)){
                    $(".section > div > input").val(parseInt(now)+1);
                }else{
                    $(".section > div > input").val("1");
                }
            })                        
        }) 
</script>










<script type="text/javascript">
  $(document).ready(function(e) {
      $('#image').change(function() {
          let reader = new FileReader();
          reader.onload = (e) => {
              $('#preview-image-before-upload').attr('src', e.target.result);
          }
          reader.readAsDataURL(this.files[0]);
      });

      // Hide Message After 5 Sec
      $("#successMessage").delay(5000).slideUp(300);

      //add more fields group
      $(".addMore").click(function() {
          var fieldHTML = '<div class="row prices g-0" style="margin-top:5px!important">' +
              $(".pricesCopy").html() + '</div>';
          $('body').find('.prices:last').after(fieldHTML);
      });

      //remove fields group
      $("body").on("click", ".remove", function() {
          $(this).parents(".prices").remove();
      });
  });

  // Delete Price List Data
  $('.deleteRecord').click(function() {

      var price_id = $(this).data('id');
      var token = $("meta[name='csrf-token']").attr("content");

      $.ajax({
          type: "POST",
          dataType: "json",
          cache: false,
          url: "{{ url('products/product/price-list') }}/" + price_id,
          data: {
              'price_id': price_id,
              '_token': token,
          },
          beforeSend: function() {
              return confirm("Are you sure want to delete this price ?");
          },

          success: function(data) {
              $(".del_row" + price_id).remove();
              $("#successMessage").html(data.success).show().delay(3000).fadeOut(400);
          }
      });
  })
</script>