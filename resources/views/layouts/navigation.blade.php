<nav class="al-navbar pr-2 {{request()->routeIs('home') ? 'al-bg-gradient-dark' : 'al-bg-white'}}">
  <ul
    class="al-navigation-ul d-flex justify-content-end {{request()->routeIs('home') ? 'al-nav-text-white' : 'al-nav-text-goldbrown'}}">
    <li class="d-inline p-3"><a href="{{route('home')}}">HOME</a></li>
    <li class="d-inline">
      <div class="px-3 pt-3">
        <span href="">PORTFOLIO<i
            class="fa fa-fw fa-angle-down {{request()->routeIs('home') ? 'text-white' : 'al-nav-text-goldbrown'}}"></i></span>
      </div>
      <div class="al-dropdown-content {{request()->routeIs('home') ? '' : 'al-opacity-full'}}">
        <ul>
          <a href="{{route('portfolio.wedding')}}">
            <li>WEDDING</li>
          </a>
          <a href="{{route('portfolio.prewed')}}">
            <li>PRE-WEDDING</li>
          </a>
          <a href="{{route('portfolio.sp')}}">
            <li>SIRAMAN/PENGAJIAN</li>
          </a>
          <a href="{{route('portfolio.lamaran')}}">
            <li>LAMARAN</li>
          </a>
        </ul>
      </div>
    </li>
    </li>
    <li class="d-inline p-3"><a href="{{route('about')}}">ABOUT</a></li>
    <li class="d-inline p-3"><a href="{{route('faq')}}">FAQ</a></li>
    <li class="d-inline p-3 al-circle-list-btn"><a href="{{route('booknow')}}" id='book-now-btn'>BOOK
        NOW</a></li>
    <li class="d-inline p-3"><a href="{{route('promo')}}">PROMO</a></li>
  </ul>
</nav>