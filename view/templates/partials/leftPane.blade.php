<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">


    @if($role == 'Administrator')

    <li class="nav-item">
      <a class="nav-link " href="/{{$appName}}/dashboard/">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-heading mb-3">Pages</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="/{{$appName}}/dashboard/lessons/">
        <i class="bi bi-card-list"></i>
        <span>Manage Lessons / Skills</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="/{{$appName}}/dashboard/events/">
        <i class="bi bi-card-list"></i>
        <span>Manage Events</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="/{{$appName}}/dashboard/participant/register/">
        <i class="bi bi-card-list"></i>
        <span>Manage Participants</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="/{{$appName}}/dashboard/education-materials/">
        <i class="bi bi-card-list"></i>
        <span>Manage Education Materials</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="/{{$appName}}/dashboard/participants/progress/">
        <i class="bi bi-card-list"></i>
        <span>Partcipants Progress</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="/{{$appName}}/dashboard/reports/">
        <i class="bi bi-card-list"></i>
        <span>Reports</span>
      </a>
    </li>



    @endif


  </ul>

</aside><!-- End Sidebar-->