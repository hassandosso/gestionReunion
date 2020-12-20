@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Ajouter un membre</h6>
      <!-- card -->
    <!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <!-- LARGE MODAL -->

      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <form method="post" action="{{route('validerMembre')}}" enctype="multipart/form-data">
        @csrf
      <div class="modal-body pd-20">
        <div class="row">
            <div class="form-group col-lg-6">
              <label for="nom">Nom<span class="tx-danger">*</span></label>
              <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="form-group col-lg-6">
              <label for="prenom">Prénom<span class="tx-danger">*</span></label>
              <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
      </div>

      <div class="row">
          <div class="form-group col-lg-6">
            <label for="surnom">Surnom</label>
            <input type="text" class="form-control" id="surnom" name="surnom">
          </div>

          <div class="form-group col-lg-6">
            <label for="naissance">Date de naissance<span class="tx-danger">*</span></label>
            <input type="date" class="form-control" id="naissance" name="naissance" required>
          </div>
    </div>

    <div class="row">
        <div class="form-group col-lg-6">
          <label for="adresse">Adresse<span class="tx-danger">*</span></label>
          <input type="text" class="form-control" id="adresse" name="adresse" required>
        </div>

        <div class="form-group col-lg-6">
          <label for="numeroidentification">Numéro d'identification<span class="tx-danger">*</span></label>
          <input type="text" class="form-control" id="numeroidentification" name="identification" required>
        </div>
  </div>

  <div class="row">
      <div class="form-group col-lg-6">
        <label for="contact">Contact<span class="tx-danger">*</span></label>
        <input type="text" class="form-control" id="contact" name="contact" required>
      </div>

      <div class="form-group col-lg-6">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
</div>

<div class="row">
    <div class="form-group col-lg-6">
      <label for="situation">Situation matrimoniale</label>
      <select class="form-control" id="situation" name="situationmatri">
        <option>Choisissez la situation matrimoniale</option>
        <option value="marie">Marié</option>
        <option value="celibataire">Célibataire</option>
      </select>
    </div>
    <div class="form-group col-lg-6">
      <label for="pere">Père</label>
      <input type="text" class="form-control" id="pere" name="pere">
    </div>
</div>
<hr>
<div class="col-lg-4">
        <div class="form-group">
        <label class="form-control-label">Photo:</label>
        <label class="custom-file">
        <input type="file" id="photo" class="custom-file-input" name="photo" onchange="readURL(this);">
        <span class="custom-file-control"></span>
        <img src="#" id="one">
       </label>
      </div>
</div><!-- col-4 -->

      </div><!-- modal-body -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-info pd-x-20">Valider</button>
      </div>
      </form>
    </div>
</div>


<script type="text/javascript">
  function readURL(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader()
      reader.onload = function(e) {
        $('#one')
        .attr('src', e.target.result)
        .width(80)
        .height(80);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endsection
