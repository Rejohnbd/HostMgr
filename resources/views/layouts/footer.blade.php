{{-- /Container Fluid--}}
</div>
{{-- Footer --}}
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>copyright &copy; <script>
          document.write(new Date().getFullYear());
        </script> - developed by
        <b><a href="{{ url('/') }}" target="_blank">Hostbd</a></b>
      </span>
    </div>
  </div>
</footer>
{{-- /Footer --}}
</div>
</div>

{{-- Scroll to top --}}
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script src="{{ asset('resources/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('resources/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('resources/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/admin.min.js') }}"></script>
@if(Request::is('domain-resellers') || Request::is('hosting-resellers') || Request::is('customers') || Request::is('services'))
<script src="{{ asset('resources/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('resources/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>
@endif
@if(Request::is('customers/create'))
<script src="{{ asset('resources/assets/vendor/select-option/js/select2.min.js') }}"></script>
<script src="{{ asset('resources/assets/vendor/datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#customerEmail').select2();
    $('#custJoinDate').datepicker({
      format: 'yyyy-mm-dd',
      todayHighlight: true
    });
    $('#joinYear').datepicker({
      format: 'yyyy',
      viewMode: "years",
      minViewMode: "years",
    });
  });
</script>
@endif

@if(Request::is('services/create'))
<script src="{{ asset('resources/assets/vendor/select-option/js/select2.min.js') }}"></script>
<script src="{{ asset('resources/assets/vendor/datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#customerEmail').select2();
    $('#domainReseller').select2();
    $('#hostingReseller').select2();
    $('#serviceStartDaty').datepicker({
      format: 'yyyy-mm-dd',
      todayHighlight: true
    });
    $('#serviceExpireDate').datepicker({
      format: 'yyyy-mm-dd',
      todayHighlight: true
    });
    // Domain Hosting show hide
    $('.domain-reseller').hide();
    $('.hosting-reseller').hide();
    $('.hosting-type').hide();
    $('#serviceFor').on('change', function() {
      var serviceName = $(this).children(':selected').val();
      if (serviceName === '1') {
        $('.domain-reseller').show();
        $('.hosting-reseller').show();
        $('.hosting-type').show();
      } else if (serviceName === '2') {
        $('.domain-reseller').hide();
        $('.hosting-reseller').show();
        $('.hosting-type').show();
      } else if (serviceName === '3') {
        $('.domain-reseller').show();
        $('.hosting-reseller').hide();
        $('.hosting-type').hide();
      } else {
        $('.domain-reseller').hide();
        $('.hosting-reseller').hide();
        $('.hosting-type').hide();
      }
    });

    // Package show hide
    $('.custom-package').hide();
    $('.hosting-package').hide();
    $('#hostingType').on('change', function() {
      var package = $(this).children(':selected').val();
      if (package === 'custom') {
        $('.custom-package').show();
        $('.hosting-package').hide();
      } else if (package === 'package') {
        $('.hosting-package').show();
        $('.custom-package').hide();
      } else {
        $('.custom-package').hide();
        $('.hosting-package').hide();
      }
    })
  });
</script>
@endif
</body>

</html>