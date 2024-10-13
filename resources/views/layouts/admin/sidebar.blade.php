<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Teknik Informatika | KSI</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">KSI</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('product*') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('admin.product') }}"><i class="fas fa-box"></i> 
        <span>Produk</span></a></li>
            <li class="{{ Route::is('admin.distributors') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.distributors') }}">
                    <i class="fas fa-home"></i>
                    <span>Distributor</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.flash_sales') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.flash_sales') }}">
                    <i class="fas fa-box"></i>
                    <span>Product Sale</span>
                </a>
            </li>
        </ul>
    </aside>
</div>

