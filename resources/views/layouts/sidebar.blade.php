
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      
      <div class="sidebar-brand">
        <a href="index.html">@yield('judul')</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">RPL</a>
      </div>
      <ul class="sidebar-menu">
        @if (Auth::user()->role_id=='1')
        <li class="active " >
          <a href="{{route('bendaharaDashboard')}}" onMouseOver="this.style.background='#F2F4F4'" onMouseOut="this.style.background='#FFF'" class="nav-link text-dark "><i class="fas fa-columns"></i> <span>Dashboard</span></a><hr class="bg-secondary">
        </li>
        <li class="active">
          <a href="{{route('bendaharaHome')}}" onMouseOver="this.style.background='#F2F4F4'" onMouseOut="this.style.background='#FFF'" class="nav-link text-dark"><i class="fas fa-dollar-sign"></i> <span>Bendahara</span></a><hr class="bg-secondary">
        </li>
        
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>PJK</span></a>
          <ul class="dropdown-menu">
            <li class="active">
              <a href="{{route('bendaharaPjk')}}" onMouseOver="this.style.background='#F2F4F4'" onMouseOut="this.style.background='#FFF'" class="nav-link text-dark"><i class="fas fa-book"></i> <span>PJK</span></a><hr class="bg-secondary">
            </li>
            <li class="active">
              <a href="{{route('honor')}}" onMouseOver="this.style.background='#F2F4F4'" onMouseOut="this.style.background='#FFF'" class="nav-link text-dark"><i class="fas fa-book"></i> <span>Honor</span></a><hr class="bg-secondary">
            </li>
          </ul>
        </li>
        @elseif(Auth::user()->role_id=='2')
        <li class="active">
          <a href="{{route('bendaharaDashboard')}}" onMouseOver="this.style.background='#F2F4F4'" onMouseOut="this.style.background='#FFF'" class="nav-link text-dark"><i class="fas fa-columns"></i> <span>Dashboard</span></a></a><hr class="bg-secondary">
        </li>
        <li class="active">
          <a href="{{route('bendaharaHome')}}" onMouseOver="this.style.background='#F2F4F4'" onMouseOut="this.style.background='#FFF'" class="nav-link text-dark"><i class="fas fa-dollar-sign"></i> <span>Report Bendahara</span></a></a><hr class="bg-secondary">
        </li>
        <li class="active">
          <a href="{{route('reportpjk')}}" onMouseOver="this.style.background='#F2F4F4'" onMouseOut="this.style.background='#FFF'" class="nav-link text-dark"><i class="fas fa-book"></i> <span>Report PJK</span></a></a><hr class="bg-secondary">
        </li>
        @elseif(Auth::user()->role_id=='3')
        <li class="active">
          <a href="{{route('bendaharaDashboard')}}" onMouseOver="this.style.background='#F2F4F4'" onMouseOut="this.style.background='#FFF'" class="nav-link text-dark"><i class="fas fa-columns"></i> <span>Dashboard</span></a></a><hr class="bg-secondary">
        </li>
        <li class="active">
          <a href="{{route('crud')}}" onMouseOver="this.style.background='#F2F4F4'" onMouseOut="this.style.background='#FFF'" class="nav-link text-dark"><i class="fas fa-users"></i><span>Manage User</span></a></a><hr class="bg-secondary">
        </li>
        <li class="active">
          <a href="{{route('bendaharaHome')}}" onMouseOver="this.style.background='#F2F4F4'" onMouseOut="this.style.background='#FFF'" class="nav-link text-dark"><i class="fas fa-dollar-sign"></i> <span>Report Bendahara</span></a></a><hr class="bg-secondary">
        </li>
        <li class="active">
          <a href="{{route('reportpjk')}}" onMouseOver="this.style.background='#F2F4F4'" onMouseOut="this.style.background='#FFF'" class="nav-link text-dark"><i class="fas fa-book"></i> <span>Report PJK</span></a></a><hr class="bg-secondary">
        </li>
        @endif
      </ul>
    </aside>
  </div>