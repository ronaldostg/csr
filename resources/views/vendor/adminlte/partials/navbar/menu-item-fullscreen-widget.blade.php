{{-- <li class="nav-item">
    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
    </a>
</li> --}}


{{-- <li class="nav-item">
    <a href="{{route('dest')}}" class="nav-link ">Logout
 <i class="fa fa-fw fa-power-off text-red"></i>
    </a>
</li> --}}


@php
    $tempUsername = '';   
    $usernameSession =(Session::get('user'))->data;

    $tempUsername= $usernameSession[0]->nama


    
@endphp

<li class="nav-item dropdown">
    <a class="nav-link"  data-toggle="dropdown" href="#" role="button">
      <i class="fas fa-power-off mr-2"></i>
      
      {{ $tempUsername }}
      {{-- {{ json_encode() }} --}}
    </a>

    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-item dropdown-header">  {{  $tempUsername }}</span>
      <div class="dropdown-divider"></div>


      <a href="{{route('dest')}}" class="dropdown-item">
           <i class="fas fa-power-off mr-2"></i> Logout
          
      </a>
    
    
    </div>
   
  </li>
