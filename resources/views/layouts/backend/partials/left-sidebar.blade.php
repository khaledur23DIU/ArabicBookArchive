<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square total-position position">
        <div class="brand-sidebar position">
            <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ route('dashboard') }}"><img class="hide-on-med-and-down" src="{{asset('assets/backend/app-assets/images/logo/materialize-logo-color.png')}}" alt="{{ config('app.name', 'Archive') }} logo"/><h4 class="show-on-medium-and-down hide-on-med-and-up" style="color: white;">{{ config('app.name', 'Archive') }}</h4><span class="logo-text hide-on-med-and-down">{{ config('app.name', 'Archive') }}</span></a></h1>
        </div>

        @auth
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow position" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

          <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }} bold"><a class="{{ Request::routeIs('dashboard') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('dashboard') }}"><i class="material-icons">dashboard</i><span class="menu-title">{{__('Dashboard')}}</span></a>
          </li>
          
          @can('personCategory-list-list')
          <li class="{{ Request::routeIs('personCategoryList.*') ? 'active' : '' }} bold"><a class=" {{ Request::routeIs('personCategoryList.*') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('personCategoryList.index') }}"><i class="material-icons">category</i><span class="menu-title">{{__('Person Category')}}</span></a>
          </li>
          @endcan

          @can('person-list-list')
          <li class="{{ Request::routeIs('person-info.*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan {{ Request::routeIs('person-info.edit') || Request::routeIs('person-info.show') ? 'active' : '' }}" href="JavaScript:void(0)"><i class="material-icons">people</i><span class="menu-title">{{__('Person Info')}}</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                @can('person-list-list')
                <li class="bold {{ Request::routeIs('person-info.index') ? 'active' : '' }}"><a class="{{ Request::routeIs('person-info.index') ? 'active' : '' }}" href="{{ route('person-info.index') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('List')}}</span></a>
                </li>
                @endcan
                 @can('person-list-create')
                <li class="bold {{ Request::routeIs('person-info.create') ? 'active' : '' }}"><a class="{{ Request::routeIs('person-info.create') ? 'active' : '' }}" href="{{ route('person-info.create') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('Create New')}}</span></a>
                </li>
                @endcan
              </ul>
            </div>
          </li>
          @endcan

          @can('library-list-list')
          <li class="{{ Request::routeIs('libraryList.*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan {{ Request::routeIs('libraryList.edit') || Request::routeIs('libraryList.show') ? 'active' : '' }}" href="JavaScript:void(0)"><i class="material-icons">av_timer</i><span class="menu-title">{{__('Libraries')}}</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                @can('library-list-list')
                <li class="bold {{ Request::routeIs('libraryList.index') ? 'active' : '' }}"><a class="{{ Request::routeIs('libraryList.index') ? 'active' : '' }}" href="{{ route('libraryList.index') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('List')}}</span></a>
                </li>
                @endcan
                @can('library-list-create')
                <li class="bold {{ Request::routeIs('libraryList.create') ? 'active' : '' }}"><a class="{{ Request::routeIs('libraryList.create') ? 'active' : '' }}" href="{{ route('libraryList.create') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('Create New')}}</span></a>
                </li>
                @endcan
              </ul>
            </div>
          </li>
          @endcan

          @can('publication-info-list')
          <li class="{{ Request::routeIs('publicationInfo.*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan {{ Request::routeIs('publicationInfo.edit') || Request::routeIs('publicationInfo.show') ? 'active' : '' }}" href="JavaScript:void(0)"><i class="material-icons">publish</i><span class="menu-title">{{__('Publications')}}</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                @can('publication-info-list')
                <li class="bold {{ Request::routeIs('publicationInfo.index') ? 'active' : '' }}"><a class="{{ Request::routeIs('publicationInfo.index') ? 'active' : '' }}" href="{{ route('publicationInfo.index') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('List')}}</span></a>
                </li>
                @endcan
                @can('publication-info-create')
                <li class="bold {{ Request::routeIs('publicationInfo.create') ? 'active' : '' }}"><a class="{{ Request::routeIs('publicationInfo.create') ? 'active' : '' }}" href="{{ route('publicationInfo.create') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('Create New')}}</span></a>
                </li>
                @endcan
              </ul>
            </div>
          </li>
          @endcan

          @can('bookCategory-list')
          <li class="{{ Request::routeIs('bookCategory.*') ? 'active' : '' }} bold"><a class=" {{ Request::routeIs('bookCategory.*') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('bookCategory.index') }}"><i class="material-icons">class</i><span class="menu-title">{{__('Book Category')}}</span></a>
          </li>
          @endcan

          @can('book-list-list')
          <li class="{{ Request::routeIs('bookBasicInfo.*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan {{ Request::routeIs('bookBasicInfo.edit') || Request::routeIs('bookBasicInfo.show') ? 'active' : '' }}" href="JavaScript:void(0)"><i class="material-icons">book_online</i><span class="menu-title">{{__('Book Basic Info')}}</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                @can('book-list-list')
                <li class="bold {{ Request::routeIs('bookBasicInfo.index') ? 'active' : '' }}"><a class="{{ Request::routeIs('bookBasicInfo.index') ? 'active' : '' }}" href="{{ route('bookBasicInfo.index') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('List')}}</span></a>
                </li>
                @endcan
                @can('book-list-create')
                <li class="bold {{ Request::routeIs('bookBasicInfo.create') ? 'active' : '' }}"><a class="{{ Request::routeIs('bookBasicInfo.create') ? 'active' : '' }}" href="{{ route('bookBasicInfo.create') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('Create New')}}</span></a>
                </li>
                @endcan
              </ul>
            </div>
          </li>
          @endcan

          @can('Manuscript-list')
          <li class="{{ Request::routeIs('manuscriptInfo.*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan {{ Request::routeIs('manuscriptInfo.edit') || Request::routeIs('manuscriptInfo.show') ? 'active' : '' }}" href="JavaScript:void(0)"><i class="material-icons">donut_large</i><span class="menu-title">{{__('Manuscript Info')}}</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                @can('Manuscript-list')
                <li class="bold {{ Request::routeIs('manuscriptInfo.index') ? 'active' : '' }}"><a class="{{ Request::routeIs('manuscriptInfo.index') ? 'active' : '' }}" href="{{ route('manuscriptInfo.index') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('List')}}</span></a>
                </li>
                @endcan
                @can('Manuscript-create')
                <li class="bold {{ Request::routeIs('manuscriptInfo.create') ? 'active' : '' }}"><a class="{{ Request::routeIs('manuscriptInfo.create') ? 'active' : '' }}" href="{{ route('manuscriptInfo.create') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('Create New')}}</span></a>
                </li>
                @endcan
              </ul>
            </div>
          </li>
          @endcan

          @can('PublishedBook-list')
          <li class="{{ Request::routeIs('publishedBookInfo.*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan {{ Request::routeIs('publishedBookInfo.edit') || Request::routeIs('publishedBookInfo.show') ? 'active' : '' }}" href="JavaScript:void(0)"><i class="material-icons">eco</i><span class="menu-title">{{__('Published Book')}}</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                @can('PublishedBook-list')
                <li class="bold {{ Request::routeIs('publishedBookInfo.index') ? 'active' : '' }}"><a class="{{ Request::routeIs('publishedBookInfo.index') ? 'active' : '' }}" href="{{ route('publishedBookInfo.index') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('List')}}</span></a>
                </li>
                @endcan
                @can('PublishedBook-create')
                <li class="bold {{ Request::routeIs('publishedBookInfo.create') ? 'active' : '' }}"><a class="{{ Request::routeIs('publishedBookInfo.create') ? 'active' : '' }}" href="{{ route('publishedBookInfo.create') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('Create New')}}</span></a>
                </li>
                @endcan
              </ul>
            </div>
          </li>
          @endcan

          @can('mazhab-list')
          <li class="{{ Request::routeIs('mazhabList.*') ? 'active' : '' }} bold"><a class="{{ Request::routeIs('mazhabList.*') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('mazhabList.index') }}"><i class="material-icons">outlet</i><span class="menu-title">{{__('Mazhab')}}</span></a>
          </li>
          @endcan

          @can('country-list-list')
          <li class="{{ Request::routeIs('countryList.*') ? 'active' : '' }} bold"><a class=" {{ Request::routeIs('countryList.*') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('countryList.index') }}"><i class="material-icons">flag</i><span class="menu-title">{{__('Country')}}</span></a>
          </li>
          @endcan

          @can('place-list-list')
          <li class="{{ Request::routeIs('placeList.*') ? 'active' : '' }} bold"><a class=" {{ Request::routeIs('placeList.*') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('placeList.index') }}"><i class="material-icons">ac_unit</i><span class="menu-title">{{__('Places')}}</span></a>
          </li>
          @endcan

          @can('language-list-list')
          <li class="{{ Request::routeIs('languageList.*') ? 'active' : '' }} bold"><a class="{{ Request::routeIs('languageList.*') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('languageList.index') }}"><i class="material-icons">language</i><span class="menu-title">{{__('Language')}}</span></a>
          </li>
          @endcan

          
          <li class="{{ Request::routeIs('siteSetting.*') || Request::routeIs('roles.*') || Request::routeIs('profile.*') || Request::routeIs('users.*') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings</i><span class="menu-title">{{__('Settings')}}</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                @can('settings-list')
                <li class="bold {{ Request::routeIs('siteSetting.*') ? 'active' : '' }}"><a class="{{ Request::routeIs('siteSetting.*') ? 'active' : '' }}" href="{{ route('siteSetting.settings') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('Site Settings')}}</span></a>
                </li>
                @endcan

                @can('user-list')
                <li class="bold {{ Request::routeIs('users.*') ? 'active' : '' }}"><a class="{{ Request::routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('User Management')}}</span></a>
                </li>
                @endcan
                
                <li class="bold {{ Request::routeIs('profile.*') ? 'active' : '' }}"><a class="{{ Request::routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.userProfile',Auth::user()->id) }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('User Profile')}}</span></a>
                </li>
                
                
                @can('role-list')
                <li class="bold {{ Request::routeIs('roles.*') ? 'active' : '' }}"><a class="{{ Request::routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}"><i class="material-icons">radio_button_unchecked</i><span>{{__('Roles and Permissions')}}</span></a>
                </li>
                @endcan
              </ul>
            </div>
          </li>
          

        </ul>
        @endauth
        <div class="navigation-background"></div>
          <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>