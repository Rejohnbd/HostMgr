{{-- /Container Fluid--}}
</div>
{{-- Footer --}}
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; 2020 to <script>
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
@if(Request::is('domain-resellers*') || Request::is('hosting-resellers*') || Request::is('customers') || Request::is('services*') || Request::is('invoices*') || Request::is('payments') || Request::is('expenses') || Request::is('email-templates') || Request::is('transactions'))
<script src="{{ asset('resources/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('resources/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable({
      "aaSorting": []
    });
  });
</script>
@endif
@if(Request::is('domain-reseller/*/renew') || Request::is('hosting-reseller/*/renew') || Request::is('invoices/*/create') || Request::is('services'))
<script src="{{ asset('resources/assets/vendor/datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $("#resellerRenewDate").datepicker({
      format: "dd-mm-yyyy",
      todayHighlight: true,
    });
  });
</script>
@endif
@if(Request::is('customers/create') || Request::is('customers/*/edit'))
<script src="{{ asset('resources/assets/vendor/datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/customers.js') }}"></script>
@endif
@if(Request::is('services/create') || Request::is('payments/*/invoice') || Request::is('services') || Request::is('email-send'))
<script src="{{ asset('resources/assets/vendor/select-option/js/select2.min.js') }}"></script>
<script src="{{ asset('resources/assets/vendor/datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/services.js') }}"></script>
@endif
@if(Request::is('services/*/edit'))
<script src="{{ asset('resources/assets/vendor/select-option/js/select2.min.js') }}"></script>
<script src="{{ asset('resources/assets/vendor/datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endif
@yield('scripts')
</body>

</html>