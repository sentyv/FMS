<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">

    <a href="{{ route('frontend.index') }}" class="navbar-brand">{{ app_name() }}</a>

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('labels.general.toggle_navigation')">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <!-- @auth -->

               {{-- <li class="nav-item dropdown">

                    <a class="nav-link btn btn-secondary dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Modules</a>

                    <ul class="dropdown-menu dropdown-menu-right text-left multi-level" aria-labelledby="dropdown01">
                   
                            <a href="{{ route('frontend.maprot.islands.index') }}" class="dropdown-item">{{ __('Island') }}</a>
                            <a href="{{ route('frontend.maprot.fishers.index') }}" class="dropdown-item">{{ __('Poster') }}</a>
                            <a href="{{ route('frontend.maprot.details.index') }}" class="dropdown-item">{{ __('Detail') }}</a>
                            <a href="{{ route('frontend.maprot.purposes.index') }}" class="dropdown-item">{{ __('Purpose') }}</a>
                            <a href="{{ route('frontend.maprot.preservations.index') }}" class="dropdown-item">{{ __('Preservation') }}</a>
                            <a href="{{ route('frontend.maprot.species.index') }}" class="dropdown-item">{{ __('Species') }}</a>
                            <li class="dropdown-divider"></li>
                     

                    </ul>
                </li>
--}}
                {{--<li class="nav-item">
                    <a href="{{route('frontend.user.dashboard')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}">@lang('navs.frontend.dashboard')</a>
                </li>--}}
            <!-- @endauth -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                {{--<li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>--}}
                {{--<li class="nav-item">
                  <a class="nav-link" href="#">Features</a>
                </li>--}}
                <li class="nav-item">
                 {{--<a class="nav-link" href="{{ route('frontend.maprot.fishers.index') }}">{{ __('Posting') }}</a>--}}
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="{{ route('frontend.fms.file.index') }}" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ __('File Management') }}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a href="{{ route('frontend.fms.publisher.index') }}" class="dropdown-item">{{ __('Publisher') }}</a>
                  <a href="{{ route('frontend.fms.reference.index') }}" class="dropdown-item">{{ __('Reference') }}</a>
                  <a href="{{ route('frontend.fms.file.index') }}" class="dropdown-item">{{ __('File') }}</a>
                  
                  </div>
                </li>
              </ul>
            </div>
          </nav>

    

        </ul>
    </div>
</nav>
