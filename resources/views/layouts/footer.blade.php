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
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/admin.min.js') }}"></script>
@if(Request::is('domain-resellers'))
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>
@endif
</body>

</html>