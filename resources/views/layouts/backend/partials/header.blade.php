<header class="page-topbar" id="header">
  <div class="navbar navbar-fixed"> 
    <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
      <div class="nav-wrapper">
        <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
          <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="{{__('Search')}}" data-search="template-list">
          <ul class="search-list collection display-none"></ul>
        </div>
        <ul class="navbar-list right">
          <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="{{asset('assets/backend/app-assets/images/avatar/avatar-7.png')}}" alt="avatar"><i></i></span></a></li>
          {{-- <li ><a class="waves-effect waves-block waves-light" href="#"><span class="flag-icon flag-icon-{{ $lang->language_flag_code}}"></span></a></li> --}}
          <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
          <li class="hide-on-large-only search-input-wrapper"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
          
        </ul>
        <!-- translation-button-->
        {{-- <ul class="dropdown-content" id="translation-dropdown">
          <li class="dropdown-item"><a class="grey-text text-darken-1" href="{{ route('siteSetting.languageDynamic','ar') }}" data-language="ar"><i class="flag-icon flag-icon-sa"></i> {{__('Arabic')}} </a></li>
          <li class="dropdown-item"><a class="grey-text text-darken-1" href="{{ route('siteSetting.languageDynamic','en') }}" data-language="en"><i class="flag-icon flag-icon-gb"></i> {{__('English')}} </a></li>
        </ul> --}}
        
        <!-- profile-dropdown-->
        <ul class="dropdown-content" id="profile-dropdown">
          <li><a class="grey-text text-darken-1" href="{{ route('profile.userProfile',Auth::user()->id) }}"><i class="material-icons">person_outline</i> {{ Auth::user()->name }}</a></li>
          
          <li class="divider"></li>
          <li><a class="grey-text text-darken-1" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="material-icons">keyboard_tab</i>{{ __('Logout') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
        </li>
        </ul>
      </div>
      <nav class="display-none search-sm">
        <div class="nav-wrapper">
          <form id="navbarForm">
            <div class="input-field search-input-sm">
              <input class="search-box-sm mb-0" type="search" required="" id="search" placeholder="Search" data-search="template-list">
              <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
              <ul class="search-list collection search-list-sm display-none"></ul>
            </div>
          </form>
        </div>
      </nav>
    </nav>
  </div>
</header>