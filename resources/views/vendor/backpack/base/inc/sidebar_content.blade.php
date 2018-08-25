<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>


@if(auth()->user()->can('manage-wiki'))
    <li class="header">Manage Wiki</li>
    <li><a href="{{ backpack_url('wikis') }}"><i class='fa fa-file-text'></i> <span>Wiki Pages</span></a></li>
    <li><a href="{{ backpack_url('wiki_categories') }}"><i class='fa fa-list-ol'></i> <span>Wiki Categories</span></a></li>
@endif

@if(auth()->user()->can('manage-problems'))
    <li class="header">Manage Practice Problems</li>
    <li><a href="{{ backpack_url('problems') }}"><i class='fa fa-list-ul'></i> <span>Problems</span></a></li>
@endif

@if(auth()->user()->can('manage-problems'))
    <li class="header">Manage Books</li>
    <li><a href="{{ backpack_url('books') }}"><i class='fa fa-book'></i> <span>Books</span></a></li>
@endif

@if(auth()->user()->can('manage-courses'))
    <li class="header">Manage Courses</li>
    <li><a href="{{ backpack_url('courses') }}"><i class='fa fa-camera'></i> <span>Courses</span></a></li>
@endif


@if(auth()->user()->can('manage-core'))
    <li class="header">Manage Core Data</li>
    <li><a href="{{ backpack_url('subjects') }}"><i class='fa fa-th'></i> <span>Subjects</span></a></li>
    <li><a href="{{ backpack_url('topics') }}"><i class='fa fa-list-ul'></i> <span>Topics</span></a></li>
    <li><a href="{{ backpack_url('colors') }}"><i class='fa fa-circle'></i> <span>Category Colors</span></a></li>
@endif

@if(auth()->user()->hasRole('admin'))
<li class="header">Manage Users</li>
<!-- Users, Roles Permissions -->
  <li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
      <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
      <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
    </ul>
  </li>
@endif