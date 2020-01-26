<div class="sidebar" data-color="azure" data-background-color="black" data-image="{{ asset('img/img.png') }}">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{route('home')}}" class="simple-text logo-normal">
        Importa
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p> Inicio </p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'client' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('client.index') }}">
          <i class="material-icons">accessibility</i>
          <p>Clientes</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'product' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('product.index') }}">
                <i class="material-icons">widgets</i>
                <p>Productos</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'order' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('order.index') }}">
                <i class="material-icons">attach_money</i>
                <p>Compras</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'shipping' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('shipping.index') }}">
                <i class="material-icons">assignment_turned_in</i>
                <p>Envíos</p>
            </a>
        </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
            <i class="material-icons">work</i>
          <p> Gestión
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            {{-- <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li> --}}
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <i class="material-icons"></i>
                <p class="sidebar-normal"> Usuarios </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>
