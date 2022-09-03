<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="{{ url('/dashboard') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('/categories') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
        Categories
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('/tasks') }}" class="nav-link {{ request()->is('tasks*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Tasks
        </p>
      </a>
    </li>
  </ul>