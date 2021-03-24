@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->
        <?php
          $last = DB::table('paiement_cotisations')->where('id_cotisation',$info_cotisation->id)->orderBy('dates','DESC')->first();
          $nb_part = DB::table('participants')->get();
          $count = count($nb_part);
          foreach($nb_part as $nb){
            if($nb->decede ==1){
              $count--;
            }
          }
          $montantApaye = $count * $info_cotisation->montant_fixe
        ?>
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Cotisation: <i class="text-danger">{{$info_cotisation->nom}}</i></h6>
          <h6 class="card-body-title">Montant Exigé par personne: <i class="text-danger">{{$info_cotisation->montant_fixe}}</i></h6>
          <h6 class="card-body-title">Total collecté: <i class="text-danger">{{$montant_collecte}}</i></h6>
          <h6 class="card-body-title">Dernière entrée ({{$last->dates}}): <i class="text-info">{{$last->montant_total}}</i></h6>
          <h6 class="card-body-title">Total crédit: <i class="text-danger">{{($montantApaye - $montant_collecte)}}</i></h6>

          <div class="table-wrapper">
            <div style="text-align:center">
              <label for="c_date">Date de la Reunion</label>
              <input type="date" class="c_date" name="dates" id="c_date">
          </div>
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">No</th>
                  <th class="wd-15p">Nom & Pénoms</th>
                  <th class="wd-15p">Payé</th>
                  <th class="wd-20p">Reste à payer</th>
                  <th class="wd-20p">Actions</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($membres as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td class="infos">{{$row->nom}} {{$row->prenom}} / {{$row->surnom }} ({{$row->identification}})</td>
                  <?php
                    $paye = 0;
                    foreach ($detailcot as $value) {
                      if($value->id_participant !=NULL){
                        $ids = explode(',',$value->id_participant);
                        array_unshift($ids,10000);
                        $paies = explode(',',$value->paiement);
                        array_unshift($paies,0);
                        $index = array_search($row->id,$ids);
                        if($index){
                          $paye = $paye + intval($paies[$index]);
                        }
                      }
                    }

                    if ($paye == $info_cotisation->montant_fixe){
                        $reste = "Soldée";
                    }elseif ($paye == 0){
                      $reste = $info_cotisation->montant_fixe;
                    }else{
                      $reste = $info_cotisation->montant_fixe - $paye;
                    }
                  ?>
                  <td class="montant">{{$paye}}</td>
                  @if ($reste == "Soldée" || $reste < 0)
                  <td>{{$reste}}</td>
                  @else
                  <td>
                    @if ($row->decede == null)
                    <input type="text" value="{{$reste}}" class="payer">
                    @else
                    <span class="badge badge-danger">DECEDE</span>
                    @endif
                  </td>

                  @endif
                  <td>
                    @if ($row->decede == null)
                    @if ($reste != "Soldée" && $reste > 0)
                    <button data-id="{{$row->id}}" class="btn btn-primary btn-sm validercotisation" >Valider</button>
                    @endif

                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
          <button class="btn btn-primary btn-sm valideListe" data-id="{{$info_cotisation->id}}" style="float:right; width:150px;">Valider La Liste</button>
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
      var allCot = [];
      $('.validercotisation').on('click',function(){
        var id;
        var cotisation;
        if($(this).html()==='Valider'){
          id = $(this).data('id');
          cotisation = $(this).closest('tr').find('.payer').val();
          $(this).html('Annuler?');
          $(this).removeClass('btn-primary');
          $(this).addClass('btn-warning');
          allCot.push(cotisation);
          allId.push(id);
        }else{
          id = $(this).data('id');
          var index = allId.indexOf(id);
          allId.splice(index,1);
          allCot.splice(index,1);
          $(this).html('Valider');
          $(this).removeClass('btn-warning');
          $(this).addClass('btn-primary');
        }
      });

      $('.valideListe').on('click',function(){
     // Get total amount
        var id = $(this).data('id');
         var totalCot = 0;
         $.each( allCot, function(key,value) {
           totalCot = totalCot + parseInt(value);
         });
     //----End
     var date = $('.c_date').val();
          $.ajax({
            url:"{{url('gestion/reunion/payer/cotisation')}}",
            type:"get",
            data:{
              id_participant:allId,
              paiement:allCot,
              montant_total:totalCot,
              dates:date,
              id_cotisation:id
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
                    location.reload();
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
