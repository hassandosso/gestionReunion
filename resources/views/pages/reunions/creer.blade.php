@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Fiche de réunion
          </h6>
          <div class="table-wrapper">
            <div style="text-align:center">
              <label for="r_date">Date de la Reunion</label>
              <input type="date" class="r_date" name="date" id="r_date">
          </div>
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-5p">No</th>
                  <th class="wd-25p">Nom et Prénoms</th>
                  <th class="wd-25p">Surnom / ID</th>
                  <th class="wd-15p">Présence</th>
                  <th class="wd-15p">Cotisation Du Jour</th>
                  <th class="wd-20p">Action</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($reunion as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row->nom}} {{$row->prenom}}</td>
                  <td>{{$row->surnom}} / {{$row->identification}}</td>
                  <td>
                    @if ($row->decede == null)
                  <input type="radio" value="absent" name="{{$row->identification}}" id="abs" checked><label for="abs"> Absent</label>
                  <input type="radio" value="present" name="{{$row->identification}}" id="pre"><label for="pre"> Présent</label>
                  @endif
                  </td>
                  <td>
                    @if ($row->decede == null)
                    <input type="text" value="0" class="cotisation"></td>
                    @endif
                  <td>
                    @if ($row->decede == null)
                    <button class="btn btn-primary btn-sm valideMembre" data-id="{{$row->identification}}">Valider</button>
                    @else
                    <span class="badge badge-danger">DECEDE</span>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
          <button class="btn btn-primary btn-sm valideReunion" style="float:right; width:150px;">Valider La Liste</button>
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
     crossorigin="anonymous"></script>
    <script src="{{asset('public/backend/js/onlineJs/jquery-3.5.1.min.js')}}"></script>
    <script type="text/javascript">

     $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });

     var allId = [];
     var allPres = [];
     var allCot = [];
     $('.valideMembre').on('click',function(){
       var id;
       var presence;
       var cotisation;
       if($(this).html()==='Valider'){
         id = $(this).data('id');
         presence = $(this).closest('tr').find('input:radio[name='+id+']:checked').val();
         cotisation = $(this).closest('tr').find('.cotisation').val();
         $(this).html('Annuler?');
         $(this).removeClass('btn-primary');
         $(this).addClass('btn-warning');
         allPres.push(presence);
         allCot.push(cotisation);
         allId.push(id);
       }else{
         id = $(this).data('id');
         var index = allId.indexOf(id);
         allId.splice(index,1);
         allPres.splice(index,1);
         allCot.splice(index,1);
         $(this).html('Valider');
         $(this).removeClass('btn-warning');
         $(this).addClass('btn-primary');
       }
     });

     $('.valideReunion').on('click',function(){
    // Count presence
        var countPres = 0;
        $.each( allPres, function(key,value) {
          if (value == 'present')
            countPres = countPres+1;
        });
    //----End
    // Get total amount
        var totalCot = 0;
        $.each( allCot, function(key,value) {
          totalCot = totalCot + parseInt(value);
        });
    //----End
    var date = $('.r_date').val();
         $.ajax({
           url:"{{url('validerlareunion')}}",
           type:"get",
           data:{
             identification:allId,
             presence:allPres,
             cotisation:allCot,
             nombre_present:countPres,
             montant_obtenu:totalCot,
             date:date
           },
           dataType:'json',
           cache:false,
           success:function(data){
             const Toast = Swal.mixin({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   timerProgressBar: true,
                   didOpen: (toast) => {
                     toast.addEventListener('mouseenter', Swal.stopTimer)
                     toast.addEventListener('mouseleave', Swal.resumeTimer)
                   }
                 })
                 if ($.isEmptyObject(data.error)){
                   Toast.fire({
                     icon: 'success',
                     title: data.success
                   });
                   window.location.replace("http://localhost/laravel_6_course/gestionReunion/gestion/reunion/reuniondujour/details/"+data.id);
                 }else{
                   Toast.fire({
                     icon: 'error',
                     title: data.error
                   });
                 }

           },

         });
     });
    </script>

@endsection()
