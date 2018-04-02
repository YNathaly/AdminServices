@section('header')
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Barra de navegación"></div>
              </div>
            <!--logo start-->
            <a href="/home" title="Alferzia" class="logo">Alferzia<span></span></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
              

                <!--  notification end -->
            </div>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="/img/perfil/">
                            <span class="username">Alejandra GAlan</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Perfil</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Configuración</a></li>
                            <li><a href="#"><i class="fa fa-key"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
@endsection        