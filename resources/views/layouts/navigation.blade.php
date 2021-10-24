<nav id='al-navbar'
    class="fixed-top al-navbar pr-2 {{ request()->routeIs('home') ? 'al-bg-gradient-dark' : 'al-bg-white' }}">
    <a href="{{ route('home') }}" class="logo"><img
            class="{{ request()->routeIs('home') ? 'al-mamoto-white-logo' : 'al-mamoto-black-logo' }}"
            src="{{ url('/images/mamoto_picture_logo.png') }}" alt=""></a>
    <ul
        class="al-navigation-ul d-flex justify-content-end {{ request()->routeIs('home') ? 'al-nav-text-white' : 'al-nav-text-goldbrown' }}">
        <li class="d-inline p-3"><a href="{{ route('home') }}">HOME</a></li>
        <li class="d-inline portfolio-btn">
            <div class="px-3 pt-3">
                <span href="">PORTFOLIO
                    <i
                        class="fa fa-fw fa-angle-down {{ request()->routeIs('home') ? 'text-white' : 'al-nav-text-goldbrown' }}">
                    </i>
                </span>
            </div>
            <div class="al-dropdown-content {{ request()->routeIs('home') ? '' : 'al-opacity-full' }}">
                <ul>
                    <a href="{{ route('portfolio.wedding') }}">
                        <li>WEDDING</li>
                    </a>
                    <a href="{{ route('portfolio.prewed') }}">
                        <li>PRE-WEDDING</li>
                    </a>
                    <a href="{{ route('portfolio.sp') }}">
                        <li>SIRAMAN/PENGAJIAN</li>
                    </a>
                    <a href="{{ route('portfolio.lamaran') }}">
                        <li>LAMARAN</li>
                    </a>
                </ul>
            </div>
        </li>
        </li>
        <li class="d-inline p-3"><a href="{{ route('about') }}">ABOUT</a></li>
        <li class="d-inline p-3"><a href="{{ route('pricelist') }}">PRICELIST</a></li>
        <li class="d-inline p-3"><a href="{{ route('faq') }}">FAQ</a></li>
        <li class="d-inline p-3 al-circle-list-btn"><a href="{{ route('booknow') }}" id='book-now-btn'>BOOK NOW</a>
        </li>
        <li class="d-inline p-3 al-info mr-2">
            <a href="{{ route('promo') }}">PROMO</a>
            @if ($promos_count >= 1)
                <img src="/icons/info.png" alt="promo-notification">
            @endif
        </li>
    </ul>
</nav>

<nav id='al-navbar-mobile'
    class="fixed-top pr-2 {{ request()->routeIs('home') ? 'al-bg-gradient-dark' : 'al-bg-white' }}">
    <div class="al-navbar-mobile-container">
        <a href="{{ route('home') }}" class="logo">
            <img class="{{ request()->routeIs('home') ? 'al-mamoto-white-logo' : 'al-mamoto-black-logo' }}"
                src="{{ url('/images/mamoto_picture_logo.png') }}" alt="">
        </a>
        <a href="#" class="logo" id="al-right-menu-button">
            <i class="fa fa-lg fa-bars" style="color:{{ request()->routeIs('home') ? 'white' : 'black' }}"></i>
        </a>
    </div>
</nav>

<div class="al-black-background">

</div>
<div class="al-right-menu-wrapper">
    <a href="#">
        <i class="fa fa-lg fa-times al-menu-close-btn"></i>
    </a>
    <ul class="al-right-menu">
        <a href="{{ route('home') }}" class="al-menu-item">
            <li>
                Home
            </li>
        </a>
        <a href="#" class="portoflio al-menu-item" data-open="false"
            style="display: flex; align-items:center; justify-content:space-between">
            <li class="al-menu-item al-menu-parent-portfolio">Portfolio<i id="al-portfolio-menu-dropdown" class="fa fa-caret-down"></i>
            </li>
        </a>
        <ul class="al-portfolio-menu-item">
            <a href="{{ route('portfolio.wedding') }}" class="al-portflio-expand">
                <li>Wedding</li>
            </a>
            <a href="{{ route('portfolio.prewed') }}" class="al-portflio-expand">
                <li>Pre Wedding</li>
            </a>
            <a href="{{ route('portfolio.sp') }}" class="al-portflio-expand">
                <li>Siraman/Pengajian</li>
            </a>
            <a href="{{ route('portfolio.lamaran') }}" class="al-portflio-expand">
                <li>Lamaran</li>
            </a>
        </ul>
        <a href="{{ route('about') }}" class="al-menu-item">
            <li class="al-menu-item">
                About
            </li>
        </a>
        <a href="{{ route('pricelist') }}" class="al-menu-item">
            <li class="al-menu-item">
                Pricelist
            </li>
        </a>
        <a href="{{ route('faq') }}" class="al-menu-item">
            <li class="al-menu-item">
                FAQ
            </li>
        </a>
        <a href="{{ route('booknow') }}" class="al-menu-item">
            <li class="al-menu-item">
                Book Now
            </li>
        </a>
        <a href="{{ route('promo') }}" class="al-menu-item">
            <li class="al-menu-item">
                Promo
            </li>
        </a>
    </ul>
</div>
