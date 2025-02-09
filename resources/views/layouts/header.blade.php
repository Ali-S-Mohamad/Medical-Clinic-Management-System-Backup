<div class="header">
    <div class="header-left">
        <a href="{{route('home')}}" class="logo">
            <img src="{{$logoPath}}" width="35" height="35" alt="" style='border-radius: 50%'> <span>{{$clinicName}}</span>
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
    @if (Auth::check())
    <ul class="nav user-menu float-right">
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                <span class="user-img">
                    @php
            // Make sure the image is retrieved correctly
            $image_path = auth()->user()->image
                ? asset('storage/' . auth()->user()->image->image_path)
                : asset('assets/img/user.jpg');
            @endphp
            <img width="60" height="30" src="{{ $image_path }}" class="rounded-circle" alt="">
                <span>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</span>
            </a>
            <div class="dropdown-menu">
                @if(auth()->user()->hasRole('doctor') || auth()->user()->hasRole('employee'))
                <a class="dropdown-item" href="{{ route('employees.show', auth()->user()->employee->id) }}">My Profile</a>
                <a class="dropdown-item" href="{{ route('employees.edit', auth()->user()->employee->id) }}">Edit Profile</a>
                @endif

                @if(auth()->user()->hasRole('admin'))
                <a class="dropdown-item" href="settings.html">Settings</a>
                @endif
                {{-- add logout route --}}
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
    @endif
    <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            @if(auth()->user()->hasRole('doctor') || auth()->user()->hasRole('employee'))
            <a class="dropdown-item" href="{{ route('employees.show', auth()->user()->id) }}">My Profile</a>
            <a class="dropdown-item" href="{{ route('employees.edit', auth()->user()->id) }}">Edit Profile</a>
            @endif

            @if(auth()->user()->hasRole('admin'))
            <a class="dropdown-item" href="{{route('clinic.show')}}">Settings</a>
            @endif
            <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout
                </a>
        </div>
    </div>
</div>
