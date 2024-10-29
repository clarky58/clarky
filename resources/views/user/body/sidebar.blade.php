
<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        RDC<span>F.M.S</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{ route('users.dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">Files</li>
        <li class="nav-item">
          <a href="{{route('users.files')}}" class="nav-link">
            <i class="link-icon" data-feather="file"></i>
            <span class="link-title">My Files</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('users.files.requests')}}" class="nav-link">
            <i class="link-icon" data-feather="repeat"></i>
            <span class="link-title">Request Files</span>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{route('users.public.files')}}" class="nav-link">
              <i class="link-icon" data-feather="folder"></i>
              <span class="link-title">All Public Files</span>
            </a>
          </li>
      </ul>
    </div>
  </nav>
