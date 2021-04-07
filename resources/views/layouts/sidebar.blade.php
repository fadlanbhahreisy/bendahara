<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">@yield('judul')</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">RPL</a>
      </div>
      <ul class="sidebar-menu">

        
        @if (Auth::user()->role=='admin')
        <li class="nav-item">
          <a href="{{route('crud')}}" class=""><i class="fas fa-fire"></i><span>Manage User</span></a>
        </li>
        @elseif(Auth::user()->role=='bendahara')
        <li class="nav-item">
          <a href="{{route('bendaharaHome')}}" class="nav-link"><i class="fas fa-columns"></i> <span>Bendahara</span></a>
        </li>
        <li class="nav-item">
          <a href="{{route('bendaharaPjk')}}" class="nav-link"><i class="fas fa-columns"></i> <span>PJK</span></a>
        </li>
        @elseif(Auth::user()->role=='koordinator')
        <li class="active"><a class="nav-link" href="{{route('koordinatorHome')}}"><i class="far fa-square"></i> <span>Koordinator</span></a></li>
        <li class="nav-item">
          <a href="{{route('report')}}" class="nav-link"><i class="fas fa-th"></i> <span>Report Bendahara</span></a>
        </li>
        @endif
         
          
         
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
          </a>
        </div>
    </aside>
  </div>