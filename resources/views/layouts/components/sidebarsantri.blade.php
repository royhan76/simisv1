<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a  href="{{ route('santri') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Profil</p>
                    </a>
                </li>

                <li class="nav-item collapse">
                    <a href="{{ route('maarif') }}">
                        <i class="fas fa-university"></i>
                        <p>Ma'arif</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('maarif') }}">
                        <i class="fas fa-user-secret"></i>
                        <p>Keamanan</p>
                    </a>
                </li>
                <li class="nav-item collapse">
                    <a href="{{ route('maarif') }}">
                        <i class="far fa-money-bill-alt"></i>
                        <p>Keuangan</p>
                    </a>
                </li>
            </li>
        </div>
    </div>
</div>
