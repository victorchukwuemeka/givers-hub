<!DOCTYPE html>
<html lang="en" class="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{settings('title')}}</title>

    <!-- ===== TALLSTACK DIALOG & TOAST Start ===== -->   
    <tallstackui:script /> 
    <!-- ===== TALLSTACK DIALOG & TOAST End ===== -->   
    <!-- Tailwind is included -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Tailwind is included -->
    <link rel="stylesheet" href="/assets/account/css/main.css?v=1628755089081">
    <link rel="icon" type="image/png"  href="{{asset(settings('favicon'))}}" />
    <meta name="description" content="{{settings('description')}}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130795909-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-130795909-1');
    </script>
  </head>
  <body>
    @persist('taost') 
    <x-toast /> 
    <x-dialog /> 
    <x-banner wire:offline text="🚨 You are not connected to the internet" close animated color="red" />
    @endpersist
    @if (user()->must_upgrade)
    <x-banner text="🚨⚠️📢 Please upgrade your account to receive payments from affiliates and downlines 🚨⚠️📢" close animated :enter="2" :leave="30" color="red" />
    @endif


    <div id="app">
      <nav id="navbar-main" class="navbar is-fixed-top">
        <div class="navbar-brand">
          <a class="navbar-item mobile-aside-button">
            <span class="icon">
              <i class="mdi mdi-forwardburger mdi-24px"></i>
            </span>
          </a>
         
        </div>
        <div class="navbar-brand is-right">
          <a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
            <span class="icon">
              <i class="mdi mdi-dots-vertical mdi-24px"></i>
            </span>
          </a>
        </div>
        <div class="navbar-menu" id="navbar-menu">
          <div class="navbar-end">
          
            <div class="navbar-item dropdown has-divider has-user-avatar">
              <a class="navbar-link">
                <div class="user-avatar">
                  <img src="https://avatars.dicebear.com/v2/initials/john-doe.svg" alt="{{user()->name}}" class="rounded-full">
                </div>
                <div class="is-user-name">
                  <span>{{user()->name}}</span>
                </div>
                <span class="icon">
                  <i class="mdi mdi-chevron-down"></i>
                </span>
              </a>
              <div class="navbar-dropdown">
                <a href="{{route('profile')}}" class="navbar-item">
                  <span class="icon">
                    <i class="mdi mdi-account"></i>
                  </span>
                  <span>My Profile</span>
                </a>
                <a href="{{route('messages')}}" class="navbar-item">
                  <span class="icon">
                    <i class="mdi mdi-email"></i>
                  </span>
                  <span>Messages</span>
                </a>
                <hr class="navbar-divider">
                @livewire('profile.logout')
              </div>
            </div>
          </div>
        </div>
      </nav>
      <aside class="aside is-placed-left is-expanded">
        <div class="aside-tools">
          <div> 
            <a href="{{route('dashboard')}}">
                <b class="font-black">{{settings('app_name')}}</b>
            </a>
          </div>
        </div>
        <div class="menu is-menu-main">
          <p class="menu-label">General</p>
          <ul class="menu-list">
            <li class="active">
              <a href="{{route('dashboard')}}">
                <span class="icon">
                  <i class="mdi mdi-desktop-mac"></i>
                </span>
                <span class="menu-item-label">Dashboard</span>
              </a>
            </li>
          </ul>
          <p class="menu-label">Menus</p>
          <ul class="menu-list">
            <li class="--set-active-tables-html">
              <a href="{{route('upgrades')}}">
                <span class="icon">
                    <x-icon name="arrow-up-right" class="h-5 w-5" />
                </span>
                <span class="menu-item-label">Upgrades</span>
              </a>
            </li> 
            <li class="--set-active-forms-html">
                <a href="{{route('approve-upgrades')}}">
                  <span class="icon">
                    <x-icon name="check-badge" class="h-5 w-5" />
                  </span>
                  <span class="menu-item-label">Approve Upgrades</span>
                </a>
              </li>
            <li class="--set-active-forms-html">
              <a href="{{route('affiliates')}}">
                <span class="icon">
                    <x-icon name="users" class="h-5 w-5" />
                </span>
                <span class="menu-item-label">Affiliates</span>
              </a>
            </li>
            {{-- <li class="--set-active-profile-html">
              <a href="{{route('transactions')}}">
                <span class="icon">
                    <x-icon name="clipboard-document-list" class="h-5 w-5" />
                </span>
                <span class="menu-item-label">Transactions</span>
              </a>
            </li> --}}
            <li>
              <a href="{{route('wallet')}}">
                <span class="icon">
                    <x-icon name="wallet" class="h-5 w-5" />
                </span>
                <span class="menu-item-label">My Wallet</span>
              </a>
           </li>
           <li>
            <a href="{{route('support')}}">
              <span class="icon">
                <x-icon name="chat-bubble-left-ellipsis" class="h-5 w-5" />
              </span>
              <span class="menu-item-label">Contact Support</span>
            </a>
         </li>
            {{--  <li>
              <a class="dropdown">
                <span class="icon">
                  <i class="mdi mdi-view-list"></i>
                </span>
                <span class="menu-item-label">Submenus</span>
                <span class="icon">
                  <i class="mdi mdi-plus"></i>
                </span>
              </a>
              <ul>
                <li>
                  <a href="#void">
                    <span>Sub-item One</span>
                  </a>
                </li>
                <li>
                  <a href="#void">
                    <span>Sub-item Two</span>
                  </a>
                </li>
              </ul>
            </li> --}}
          </ul>
         
        </div>
      </aside>
   


        {{$slot}}



      <footer class="footer">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
          <div class="flex items-center justify-start space-x-3">
            <div> © 2024 {{Settings('app_name')}} </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- Scripts below are for demo only -->
    <script type="text/javascript" src="/assets/account/js/main.min.js?v=1628755089081"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script type="text/javascript" src="/assets/account/js/chart.sample.min.js"></script>
    <script>
      ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
          n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '658339141622648');
      fbq('track', 'PageView');
    </script>
    <noscript>
      <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=658339141622648&ev=PageView&noscript=1" />
    </noscript>
    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
  </body>
</html>