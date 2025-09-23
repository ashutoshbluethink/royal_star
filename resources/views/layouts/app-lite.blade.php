<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Dashboard')</title>
  @include('partials.ui-kit')
  {{-- You can also include your existing CSS here --}}
</head>
<body>
  <div class="page-wrap">
    @include('partials.sidebar-modern')

    <main class="content">
      <div class="topbar">
        <button class="btn btn-outline-secondary d-lg-none" data-sidebar-toggle><i class="fas fa-bars"></i></button>
        <div class="chip"><i class="fas fa-building"></i> Departmental Dashboards</div>
        <div class="d-flex align-items-center" style="gap:8px;">
          <span class="chip"><i class="far fa-bell"></i> 5</span>
          <span class="chip"><i class="far fa-user"></i> You</span>
        </div>
      </div>

      @yield('content')
    </main>
  </div>
</body>
</html>
