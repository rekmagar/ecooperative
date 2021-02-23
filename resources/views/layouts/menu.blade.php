<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon cil-home"></i>Home
    </a>
</li>
<li class="c-sidebar-nav-item c-nav-dropdown">
    <a class="c-sidebar-nav-link" href="/charts">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-chart-pie"></use>
        </svg> Others
    </a>
</li>
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-star"></use>
        </svg> Settings
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <router-link to="/fyear">
                <a class="c-sidebar-nav-link"><span class="c-sidebar-nav-icon"></span>
                    F/Year
                    <span class="badge badge-success">Free</span>
                </a>
            </router-link>
        </li>
        <li class="c-sidebar-nav-item">
            <router-link to="/year">
                <a class="c-sidebar-nav-link"><span class="c-sidebar-nav-icon"></span>Years</a>
            </router-link>
        </li>
        <li class="c-sidebar-nav-item">
            <router-link to="/month">
                <a class="c-sidebar-nav-link"><span class="c-sidebar-nav-icon"></span>Months</a>
            </router-link>
        </li>
    </ul>
</li>