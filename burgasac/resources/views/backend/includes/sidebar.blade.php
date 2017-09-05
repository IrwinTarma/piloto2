<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php if (false) : ?>
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->
        <?php endif; ?>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <li class="{{ Active::pattern('admin/dashboard') }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>

            @permissions(['manage-users', 'manage-roles'])
            <li class="{{ Active::pattern('admin/access/*') }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu {{ Active::pattern('admin/access/*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/access/*', 'display: block;') }}">
                    @permission('manage-users')
                        <li class="{{ Active::pattern('admin/access/user*') }}">
                            <a href="{{ route('admin.access.user.index') }}">
                                <i class="fa fa-circle-o"></i>
                                <span>{{ trans('labels.backend.access.users.management') }}</span>
                            </a>
                        </li>
                    @endauth

                    @permission('manage-roles')
                        <li class="{{ Active::pattern('admin/access/role*') }}">
                            <a href="{{ route('admin.access.role.index') }}">
                                <i class="fa fa-circle-o"></i>
                                <span>{{ trans('labels.backend.access.roles.management') }}</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </li>
            @endauth

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>Mantenimiento</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li class="">
                        <a href="{{ route('empleados.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Empleados</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('tipo_proveedor.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Tipo de Proveedores</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('procedencias.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Procedencias</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('proveedores.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Proveedores</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('color.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Colores</span>
                        </a>
                    </li>
                    <li>
                    <li class="">
                        <a href="{{ route('proveedor_color_producto.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Proveedor Color Producto</span>
                        </a>
                    </li>
                    <li>
                      <a href="{{ route('titulos.index')}}">
                        <i class="fa fa-circle-o"></i>
                        <span>Titulos</span>
                      </a>
                    </li>
                    <li class="">
                        <a href="{{ route('insumos.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Insumos</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('accesorios.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Accesorios</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('productos.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Telas</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('locales.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Locales</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('maquinas.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Maquinas</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('bancos.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Bancos</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('tipos-pago.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Tipos de Pago</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('tipos-abono.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Tipos de Abono</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('compra-estados.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Estados de Compra</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="header">Procesos</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>Compras</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li class="">
                        <a href="{{ route('compras.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Compras</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('devoluciones.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Devoluciones</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('abonos.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Abonos</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
              <a href="{{route('recepcion-mp.index')}}">
                <i class="fa fa-circle-o"></i>
                <span>Recepción de Terceros</span>
              </a>
            </li>
            <li>

            <li class="treeview">
              <a href="#">
                  <i class="fa fa-list"></i>
                  <span>Planeamiento y Produccion</span>
                  <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li>
                  <a href="{{route('planeamientos.index')}}">
                    <i class="fa fa-circle-o"></i>
                    <span>Planeamientos</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('bandeja-produccion.index')}}">
                    <i class="fa fa-circle-o"></i>
                    <span>Produccion</span>
                  </a>
                </li>
                <li>
                <a href="{{route('compras.liquidacion')}}">
                  <i class="fa fa-circle-o"></i>
                  <span>Liquidacion de lotes</span>
                </a>
              </li>
              </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>Comercialización</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li>
                        <a href="{{route('comercializacion.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Bandeja de Recepcion</span>
                        </a>
                    </li>


                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                  <i class="fa fa-list"></i>
                  <span>Despachos</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li>
                    <a href="{{route('despacho-tintoreria.index')}}">
                        <i class="fa fa-circle-o"></i>
                        <span>Despacho a tintoreria</span>
                      </a>
                    </li>
                      
                    <li>
                      <a href="{{route('despacho-terceros.index')}}">
                        <i class="fa fa-circle-o"></i>
                        <span>Despacho a terceros</span>
                      </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
              <a href="#">
                  <i class="fa fa-list"></i>
                  <span>Reportes</span>
                  <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li>
                  <a href="{{ route('reportes.compra') }}">
                    <i class="fa fa-circle-o"></i>
                    <span>Compras</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('reportes.resumen') }}">
                    <i class="fa fa-circle-o"></i>
                    <span>Stock de Materia Prima</span>
                  </a>
                </li>
                <li>
                <a href="{{ route('reportes.telas') }}">
                  <i class="fa fa-circle-o"></i>
                  <span>Stock de Tela Producida</span>
                </a>
                </li>
                 <li>
                <a href="{{ route('reportes.despacho_tintoreria') }}">
                  <i class="fa fa-circle-o"></i>
                  <span>Stock de Tela en Tintoreria</span>
                </a>
                </li>
                <li>
                <a href="{{ route('reportes.planeamientos') }}">
                  <i class="fa fa-circle-o"></i>
                  <span>Planeamientos</span>
                </a>
                </li>
                <li>
                <a href="{{ route('reportes.produccion') }}">
                  <i class="fa fa-circle-o"></i>
                  <span>Produccion</span>
                </a>
              </li>
              <li>
              <a href="/reportes/proveedor_tela_deuda">
                  <i class="fa fa-circle-o"></i>
                  <span>Deuda de Tintoreria</span>
                </a>
                  
              </li>
              </ul>
            </li>

            <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>

            <li class="{{ Active::pattern('admin/log-viewer*') }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/log-viewer') }}">
                        <a href="{{ route('admin.log-viewer::dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/log-viewer/logs') }}">
                        <a href="{{ route('admin.log-viewer::logs.list') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->

        <!-- search form (Optional) -->
        {{ Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form']) }}
            <div class="input-group">
                {{ Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')]) }}

                  <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
            </div><!--input-group-->
        {{ Form::close() }}
        <!-- /.search form -->

    </section><!-- /.sidebar -->
</aside>
