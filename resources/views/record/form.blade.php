@if(count($bookings)>0)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$booking->user_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{route('record')}}" method="post">@csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ficha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="app">

        <input type="hidden" name="user_id" value="{{$booking->user_id}}">
        <input type="hidden" name="professional_id" value="{{$booking->professional_id}}">
        <input type="hidden" name="date" value="{{$booking->date}}">

        <div class="form-group">
            <label>Motivo Consulta</label>
            <input type="text" name="motive" class="form-control" required="">
        </div>
          <div class="form-group">
            <label>Sintomas</label>

            <textarea name="symptoms" class="form-control" placeholder="symptoms" required=""></textarea>
        </div>

        <div class="form-group">
          <label>Receta o Ejercicios</label>
          <add-btn></add-btn>

        </div>
          <div class="form-group">
            <label>Instrucciones de Receta o Ejercicios</label>

              <textarea name="instructions" class="form-control" placeholder="" required=""></textarea>
        </div>
          <div class="form-group">
            <label>Otros Comentarios</label>
            <textarea name="feedback" class="form-control" placeholder="" required=""></textarea>

        </div>
        <div class="form-group">
            <label>Firma</label>
            <input type="text" name="signature" class="form-control" required="">
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </form>
  </div>
</div>
@endif
