<!-- Sidebar -->
<div class="sidebar sidebar-style-2">

    <div class="sidebar-wrapper scrollbar scrollbar-inner">

        <div class="sidebar-content">

            <ul class="nav nav-primary">

                @php
                    $role = auth()->user()->role;
                    $menus = config('sidebar.menu');
                @endphp

                @foreach ($menus as $menu)

                    @if (in_array($role, $menu['roles']))
                        <li class="nav-item">

                            @if (isset($menu['submenu']))
                                <a data-toggle="collapse" href="#menu{{ $loop->index }}">

                                    <i class="{{ $menu['icon'] }}"></i>

                                    <p>{{ $menu['title'] }}</p>

                                    <span class="caret"></span>

                                </a>

                                <div class="collapse" id="menu{{ $loop->index }}">

                                    <ul class="nav nav-collapse">

                                        @foreach ($menu['submenu'] as $sub)
                                            <li>

                                                <a href="{{ $sub['url'] }}">

                                                    <span class="sub-item">{{ $sub['title'] }}</span>

                                                </a>

                                            </li>
                                        @endforeach

                                    </ul>

                                </div>
                            @else
                                <a href="{{ $menu['url'] ?? $menu['route'][$role] }}">

                                    <i class="{{ $menu['icon'] }}"></i>

                                    <p>{{ $menu['title'] }}</p>

                                </a>
                            @endif

                        </li>
                    @endif

                @endforeach

            </ul>

        </div>

    </div>

</div>

<!-- End Sidebar -->
