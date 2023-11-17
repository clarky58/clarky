<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        MMCZ<span>F.M.S</span>
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
          <a href="{{ route('secretary.dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">Department Users</li>
        <li class="nav-item">
          <a href="{{route('secretary.users')}}" class="nav-link">
            <i class="link-icon" data-feather="users"></i>
            <span class="link-title">Users</span>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{route('secretary.folders')}}" class="nav-link">
              <i class="link-icon" data-feather="inbox"></i>
              <span class="link-title">Folders</span>
            </a>
          </li>
        <li class="nav-item">
            <a href="pages/apps/chat.html" class="nav-link">
              <i class="link-icon" data-feather="file"></i>
              <span class="link-title">Accessed Files</span>
            </a>
          </li>
        <li class="nav-item">
          <a href="pages/apps/calendar.html" class="nav-link">
            <i class="link-icon" data-feather="repeat"></i>
            <span class="link-title">File Requests</span>
          </a>
        </li>
        <li class="nav-item nav-category">Manage Files</li>
        <li class="nav-item">
            <a href="{{route('secretary.files')}}" class="nav-link">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Manage Files</span>
            </a>
          </li>
      </ul>
    </div>
  </nav>
