@extends('layouts.plane')
@section('body')
 <div  class="row">
    <!--otro nav -->
    <header class="header white-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Barra de navegación"></div>
        </div>
        <!--logo start-->
        <a href="#" title="Mi empresa" class="logo">Mi empresa</a>
            <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-calendar"></i>
                            <span class="badge bg-important">5</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-red"></div>
                            <li>
                                <p class="red">Tienes 
                                     <li>5 Actividades
                                        <a href="#">
                                            <!-- <span class="photo"><img alt="avatar" src="<?php //echo base_url()?>public/img/avatar-mini.jpg"></span> -->
                                            <span class="subject">
                                            <span class="from"></span>
                                            </span>
                                            <span class="message">
                                                <strong>Empresa:</strong> 
                                            </span>Alferzia
                                             <span class="message">
                                                <strong>Tarea:</strong> 
                                            </span>Mesas Cuadradas
                                             <span class="message">
                                                <strong>Responsable:</strong> 
                                            </span>Mantenimiento
                                        </a>
                                    </li>
                            
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="#">
                            <span class="username"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Perfil</a></li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-key"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
  


       
              <!-- Otro menu -->
        <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="active" href="#">
                          <i class="fa fa-dashboard"></i>
                          <span>Inicio</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-group"></i>
                          <span>Tareas</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="{{ url('services')}}">Alta</a></li>
                          <li><a  href="{{ url('Listservices')}}">Listado</a></li>
                          <li><a  href="{{ url('Asignar')}}">Asignar Responsables</a></li>
                          <li><a  href="{{ url('listado_resp')}}">Listado Responsables</a></li>
                       </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Servicios</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="{{URL::to('solicitarServicio')}}">Solicitar Servicio</a></li>
                          <li><a  href="{{URL::to('Listserv_solicitados')}}">Listado</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-dashboard"></i>
                          <span>Eventos</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="{{URL::to('eventos')}}">Dar de alta</a></li>
                          <li><a id="listado_orden_produccion" href="{{URL::to('Listeventos')}}">Listado de eventos</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-calculator"></i>
                          <span>Tareas Asignadas</span>
                      </a>
                      <ul class="sub">
                          <li><a href="{{URL::to('listTags')}}">listado de tareas</a></li>
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!-- Termina -->
    <div id="main-content">
        <div id="wrapper" style="background:#ECEFF1;">
			 <div class="state-overview col-sm-6">
                <div class="col-lg-12">
                    <h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
				@yield('section')

            </div>
            @yield('javascript')
            <script src="{{ asset("js/jquery.js")}}" type="text/javascript"></script>
            <!-- /#page-wrapper -->
        </div>
    </div>    
    </div>