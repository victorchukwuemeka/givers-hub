<!-- JAVASCRIPT -->
<script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/plugins.js') }}"></script>

<!-- validation init -->
<script src="{{ asset('assets/admin/assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/plugins/select2/dist/js/select2.min.js"></script>


 <!-- apexcharts -->
 <script src="{{ asset('assets/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
 <!-- Vector map-->
 <script src="{{ asset('assets/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
 <script src="{{ asset('assets/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>
 <!--Swiper slider js-->
 <!-- Sweet Alerts js -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 
 <script src="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
 <!-- App js -->
 <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>

 <script src="{{ asset('assets/admin/plugins/dropify/dropify.min.js') }}"></script>
 <script src="/assets/admin//plugins/summernote/summernote-bs4.js"></script>
 <!-- Date Picker Js -->
<script src="/assets/admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
 {{-- Chart Init --}}
 {{-- <script src="{{ asset('assets/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script> --}}

 <script>
  $(document).ready(function() {
    $('.dropify').dropify();
    $('.select2').select2();
    $('.date-picker').datepicker({ 
      clearBtn: true,
      autoclose: true
    });
    $(".summernote").summernote({
            height: 150
        });
      $(document).on('click', '.dropify-clear', function(e){

          const form_group= $(this).closest('.form-group');
          form_group.find('.dropify-wrapper .dropify-preview').css('display','none');
          form_group.find('input.dropify').removeAttr('data-default-file');
          form_group.find('input.dropify').val('');
          const fileName = form_group.find('input.dropify').attr('name');
          var fileInput = $('<input>').attr('type', 'hidden').attr('name', fileName).attr('value', 'NULL');
          $(this).closest('form').append(fileInput);

      });

  });
 </script>
 <script>
    function toggleFullscreen() {
      const doc = window.document;
      const docEl = doc.documentElement;
  
      const requestFullscreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
      const exitFullscreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;
  
      if (!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
        if (requestFullscreen) {
          docEl.requestFullscreen().catch(err => {
            console.log(`Error attempting to enable full-screen mode: ${err.message} (${err.name})`);
          });
        }
      } else {
        if (exitFullscreen) {
          doc.exitFullscreen();
        }
      }
    }

    function placeholder(count, col) {
    let ph = '<div class="row mb-4 mt-4">';
    
    for (let i = 0; i < count; i++) {
        ph += '<div class="col-md-' + col + '">';
        ph += '<div class="live-preview">';
        ph += '<span class="placeholder col-6"></span>';
        ph += '<span class="placeholder w-75"></span>';
        ph += '<span class="placeholder" style="width: 25%;"></span>';
        ph += '</div>';
        ph += '</div>';
        }
        
        ph += '</div>';
        return ph;
    }
    

    </script>

<script>
  $(document).ready(function() {
      var currentUrl = window.location.href;

      $('.nav-item a').each(function() {
          var linkUrl = $(this).attr('href');
          
          if (currentUrl === linkUrl) {
              $(this).addClass('active');
              $(this).closest('.collapse').addClass('show');
          }
      });
  });
</script>


 @yield('js')
 @stack('amicrud_js')

