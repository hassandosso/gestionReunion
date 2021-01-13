@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Liste des Cotisations Exceptionnelles
            <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cotisation" style="float:right">Nouvelle Cotisation</a>
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-10p">No</th>
                  <th class="wd-30p">Nom</th>
                  <th class="wd-10p">Montant Fixé</th>
                  <th class="wd-15p">Date d'ouverture</th>
                  <th class="wd-10p">Status</th>
                  <th class="wd-15p">Date Limite</th>
                  <th class="wd-25p">Actions</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($cotisations as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row->nom}}</td>
                  <td>{{$row->montant_fixe}}</td>
                  <?php
                    setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
                    $dt = utf8_encode(strftime("%d %B %Y", strtotime($row->created_at)));
                    if ($row->date_limite!=''){
                      $dt_l = utf8_encode(strftime("%d %B %Y", strtotime($row->date_limite)));
                    }
                  ?>
                  <td>{{$dt}}</td>
                  <td>
                    @if ($row->status == 1)
                      <span class="badge badge-success">Ouvert</span>
                    @else
                      <span class="badge badge-danger">Fermer</span>
                    @endif
                  </td>
                  <td>
                    @if ($row->date_limite =='')
                      @if ($row->status == 0)
                        <span class="badge badge-info">Cotisation bouclée</span>
                      @else
                        <span class="badge badge-info">Indéterminée</span>
                      @endif
                    @else
                      @if ($row->status == 0)
                        <span class="badge badge-info">Cotisation bouclée</span>
                      @else
                        <span class="badge badge-info">{{$dt_l}}</span>
                        @endif
                    @endif
                  </td>
                  <td>
                    <a href="{{URL::to('gestion/reunion/cotisation/details/'.$row->id)}}" class="btn btn-warning btn-sm" title="Détails"><i class="fa fa-eye"></i></a>
                    <a href="{{URL::to('gestion/reunion/modifier/cotisation/'.$row->id)}}" class="btn btn-info btn-sm" title="Modifier">
                      <i class="fa fa-edit"></i></a>
                    @if ($row->status == 1)
                    <a href="{{URL::to('gestion/reunion/cotisation/desactive/'.$row->id)}}" class="btn btn-success btn-sm" title="Cliquez pour désactiver"><i class="fa fa-thumbs-down"></i></a>
                    @else
                    <a href="{{URL::to('gestion/reunion/cotisation/active/'.$row->id)}}" class="btn btn-secondary btn-sm"
                      title="Cliquez pour activer" ><i class="fa fa-thumbs-up"></i></a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-mainpanel -->

    <!-- LARGE MODAL -->
<div id="cotisation" class="modal fade">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content tx-size-sm">
  <div class="modal-header pd-x-20">
    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Nouvelle Cotisation Exceptionnelles</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form method="post" action="{{route('creer.cotisation')}}">
    @csrf
  <div class="modal-body pd-20">

        <div class="form-group">
          <label for="nom">Nom</label>
          <input type="text" class="form-control" id="nom" name="nom" require>
        </div>
        <div class="form-group">
          <label for="montant">Montant Fixé</label>
          <input type="text" class="form-control" id="montant" name="montant_fixe" require>
        </div>
        <div class="form-group">
          <label for="date_limite">Date Limite</label>
          <input type="date" class="form-control" id="date_limite" name="date_limite">
        </div>

  </div><!-- modal-body -->
  <div class="modal-footer">
    <button type="submit" class="btn btn-info pd-x-20">Enregistrer</button>
    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Fermer</button>
  </form>
  </div>
</div>
</div><!-- modal-dialog -->
</div><!-- modal -->


    <!-- ########## END: MAIN PANEL ########## -->
@endsection()
