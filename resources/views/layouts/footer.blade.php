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
<script src="{{ asset('resources/assets/vendor/datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/customers.js') }}"></script>
@endif
@if(Request::is('services/create'))
<script src="{{ asset('resources/assets/vendor/select-option/js/select2.min.js') }}"></script>
<script src="{{ asset('resources/assets/vendor/datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/services.js') }}"></script>
@endif
@yield('scripts')
</body>

</html>