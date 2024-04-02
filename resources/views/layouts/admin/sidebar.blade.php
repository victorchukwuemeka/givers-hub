<ul class="navbar-nav" id="navbar-nav">
    <li class="menu-title"><span data-key="t-menu">Main Menu</span></li>
    <li class="nav-item">
        <a class="nav-link menu-link " href="{{route("admin.dashboard.index")}}">
            <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboard</span>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link menu-link " href="{{route("admin.pages.index")}}">
           <i class="ri-pages-line"></i> <span data-key="t-Pages">Pages</span>
        </a>
    </li> --}}


    
 

    <li class="nav-item">
        <a class="nav-link menu-link" href="#Users" data-bs-toggle="collapse" role="button"
           aria-expanded="false" aria-controls="sidebarAuth">
           <i class="mdi mdi-account-group"></i> <span data-key="t-Users">Users</span>
        </a>
        <div class="collapse menu-dropdown " id="Users">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="{{route('admin.users.index')}}" class="nav-link " data-key="t-calculator"> All Users </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.permissions.index')}}" class="nav-link " data-key="t-apply"> Permissions</a>
                </li>
                
                <li class="nav-item">
                    <a href="{{route('admin.roles.index')}}" class="nav-link " data-key="t-calculator"> Roles </a>
                </li>
              
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link menu-link" href="#Configurations" data-bs-toggle="collapse" role="button"
           aria-expanded="false" aria-controls="sidebarAuth">
           <i class="ri-list-settings-fill"></i> <span data-key="t-Configurations">Configurations</span>
        </a>
        <div class="collapse menu-dropdown " id="Configurations">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link " href="{{route("admin.configurations.index")}}">
                         <span data-key="t-widgets">Edit Configurations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("admin.configurations.edit-configurations.index")}}">
                         <span data-key="t-widgets">Add Configuration</span>
                    </a>
                </li>
              
            </ul>
        </div>
    </li>


   
   
</ul>
