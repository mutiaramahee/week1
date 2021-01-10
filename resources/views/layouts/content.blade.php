<!DOCTYPE html>
<html lang="en">
  @include('template.head')
<body>
  <!-- navbar -->
  @include('template.navbar')
  <!-- sidebar -->
  @include('template.sidebar')

  <!-- content -->
  @yield('content')

  <!-- footer -->
  @include('template.footer')

  @yield('script')
</body>

</html>