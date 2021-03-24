<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Gestion de Réunion</title>
    <!-- TAG INPUT CDN -->
    <link href="{{asset('public/backend/css/onlineCss/bootstrap-tagsinput.css')}}" rel="stylesheet"/>

    <link href="{{asset('public/backend/css/onlineCss/toastr.css')}}" rel="stylesheet">
    <!-- vendor css -->
    <link href="{{asset('public/backend/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">

<!-- Data table -->
    <link href="{{asset('public/backend/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{asset('public/backend/css/starlight.css')}}">

    <link href="{{asset('public/backend/lib/summernote/summernote-bs4.css')}}" rel="stylesheet">
  </head>

  <body>
    @guest

    @else
  <!-- ########## START: LEFT PANEL ########## -->
  <div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i>TANAN MOUELA</a></div>
  <div class="sl-sideleft">
    <div class="sl-sideleft-menu">
      <a href="{{url('/home')}}" class="sl-menu-link active" id="tableaudebord">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
          <span class="menu-item-label">TABLEAU DE BORD</span>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <a href="#" class="sl-menu-link" id="participant">
        <div class="sl-menu-item">
          <i class="menu-item-icon ion-ios-people-outline tx-20"></i>
          <span class="menu-item-label">PARTICIPANT</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('creer')}}" class="nav-link">Ajouter</a></li>
        <li class="nav-item"><a href="{{route('listeMembre')}}" class="nav-link">Liste</a></li>
      </ul>
      <a href="#" class="sl-menu-link" id="reunion">
        <div class="sl-menu-item">
          <i class="menu-item-icon ion-ios-paper-outline tx-24"></i>
          <span class="menu-item-label">REUNION</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('creer.reunion')}}" class="nav-link">Réunion du jour</a></li>
        <li class="nav-item"><a href="{{route('liste.reunion')}}" class="nav-link">Liste des Réunion</a></li>
      </ul>
      <a href="{{route('liste.cotisation')}}" class="sl-menu-link" id="cotisations">
        <div class="sl-menu-item">
          <i class="menu-item-icon ion-ios-browsers-outline tx-20"></i>
          <span class="menu-item-label">COTISATIONS</span>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->

      <a href="#" class="sl-menu-link" id="evenement">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-stopwatch-outline tx-20"></i>
          <span class="menu-item-label">EVENEMENT</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('creer.evenement')}}" class="nav-link">Créer</a></li>
        <li class="nav-item"><a href="{{route('liste.evenement')}}" class="nav-link">Liste</a></li>
      </ul>

      <a href="#" class="sl-menu-link" id="procesverbal">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-copy-outline tx-20"></i>
          <span class="menu-item-label">PROCES VERBAL</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('creer.pv')}}" class="nav-link">Créer</a></li>
        <li class="nav-item"><a href="{{route('liste.pv')}}" class="nav-link">Liste</a></li>
      </ul>

      <a href="#" class="sl-menu-link" id="autres">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
          <span class="menu-item-label">AUTRES</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('liste.maj')}}" class="nav-link">Mise à jour Réunion</a></li>
        <li class="nav-item"><a href="{{route('liste.dons')}}" class="nav-link">Dons / Participation Excep</a></li>
        <li class="nav-item"><a href="{{route('liste.depenses')}}" class="nav-link">Dépenses</a></li>
        <li class="nav-item"><a href="{{route('liste.amandes')}}" class="nav-link">Amande</a></li>
        <li class="nav-item"><a href="" class="nav-link">Accorder une faveur</a></li>
      </ul>
    </div><!-- sl-sideleft-menu -->

    <br>
  </div><!-- sl-sideleft -->
  <!-- ########## END: LEFT PANEL ########## -->

  <!-- ########## START: HEAD PANEL ########## -->
  <div class="sl-header">
    <div class="sl-header-left">
      <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
      <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    </div><!-- sl-header-left -->
    <div class="sl-header-right">
      <nav class="nav">
        <div class="dropdown">
          <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            <span class="logged-name">{{Auth::user()->name}}</span>
            <img src="{{asset('public/backend/img/img3.jpg')}}" class="wd-32 rounded-circle" alt="">
          </a>
          <div class="dropdown-menu dropdown-menu-header wd-200">
            <ul class="list-unstyled user-profile-nav">
              <li><a href="{{route('password.change')}}"><i class="icon ion-ios-gear-outline"></i>Changer mot de passe</a></li>
              <li><a href="{{route('logout')}}"><i class="icon ion-power"></i>Déconnecter</a></li>
            </ul>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </nav>
    </div><!-- sl-header-right -->
  </div><!-- sl-header -->
  <!-- ########## END: HEAD PANEL ########## -->
  @endguest
    <!-- ########## START: MAIN PANEL ########## -->
  @yield('content')

    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{asset('public/backend/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('public/backend/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('public/backend/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/lib/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('public/backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>

    <!-- Data table script -->
    <script src="{{asset('public/backend/lib/highlightjs/highlight.pack.js')}}"></script>
    <script src="{{asset('public/backend/lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('public/backend/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('public/backend/lib/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('public/backend/js/onlineJs/toastr.min.js')}}"></script>
<script src="{{asset('public/backend/js/onlineJs/sweetalert2@10.js')}}"></script>
<script src="{{asset('public/backend/js/onlineJs/promise-polyfill.js')}}"></script>
    <script src="{{asset('public/backend/js/onlineJs/sweetalert.min.js')}}"></script>

<script>

  $('.nav-link').on('click',function(){
    var span = $(this).closest('ul').prev().find('span').html();

  localStorage.setItem("oldmenu", span);
    // var active = document.getElementsByClassName('active')[0];
    // active.classList.remove('active');
    // $(this).closest('a').classList.add('active');
  });
  $('.sl-menu-link').on('click',function(){
    var span = $(this).find('span').html();

    localStorage.setItem("oldmenu", span);
  });
    var menu = localStorage.getItem('oldmenu');
    if(menu !=null){
      menu = menu.split(" ");
      menu = menu.join("");
      var el = document.getElementById(menu.toLowerCase());
      var active = document.getElementsByClassName('active')[0];
      active.classList.remove('active');
      el.classList.add('active');
      }



</script>
    <script>
      $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Cherchez...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json",
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          responsive: true,
          language: {
            searchPlaceholder: 'Cherchez...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json",
          }
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>


    <script src="{{asset('public/backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('public/backend/lib/d3/d3.js')}}"></script>
    <script src="{{asset('public/backend/lib/rickshaw/rickshaw.min.js')}}"></script>

    <script src="{{asset('public/backend/lib/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('public/backend/lib/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('public/backend/lib/Flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('public/backend/lib/flot-spline/jquery.flot.spline.js')}}"></script>

    <script src="{{asset('public/backend/lib/medium-editor/medium-editor.js')}}"></script>
   <script src="{{asset('public/backend/lib/summernote/summernote-bs4.min.js')}}"></script>

   <script>
     $(function(){
       'use strict';

       // Inline editor
       var editor = new MediumEditor('.editable');

       // Summernote editor
       $('#summernote1').summernote({
         height: 150,
         tooltip: false
       })
   });

   </script>

   <script>
     $(function(){
       'use strict';

       // Inline editor
       var editor = new MediumEditor('.editable');

       // Summernote editor
       $('#summernote2').summernote({
         height: 150,
         tooltip: false
       })
   });

   </script>


    <script src="{{asset('public/backend/js/starlight.js')}}"></script>
    <script src="{{asset('public/backend/js/ResizeSensor.js')}}"></script>
    <script src="{{asset('public/backend/js/dashboard.js')}}"></script>
    <script src="{{asset('public/backend/js/onlineJs/toastrlatest.min.js')}}"></script>


	 <script>
        @if(Session::has('message'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('message') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('message') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
        @endif
     </script>

     <script>
         $(document).on("click", "#delete", function(e){
             e.preventDefault();
             var link = $(this).attr("href");
                swal({
                  title: "Voulez-vous suprimer?",
                  text: "Les données seront supprimées définitivement!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       window.location.href = link;
                  } else {
                    swal("Annulé!");
                  }
                });
            });
    </script>
<!-- CREER REUNION SCRIPT -->
  </body>
</html>
