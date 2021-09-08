 <div class="modal fade" id="Modal{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información Alumno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header">
            {{$student->name}} {{$student->lastnames}}
          </div>
          <div class="card-body">
            <h5 class="card-title">Plan: {{$student->plan()['name']}}</h5>
            <p class="card-text">Precio plan completo: {{$student->planprice()}}</p>
            <p class="card-text">Fecha Inscripción: {{$student->student->created_at->format('Y-m-d')}}</p>
            <p class="card-text">Fecha Ultimo Pago: {{$student->student->updated_at->format('Y-m-d')}}</p>
            <form action="{{ url('/student', ['id' => $student->id])}}" method="POST" class="row g-3 needs-validation">
              @csrf
              @method('PUT')
              <div class="col-md-6">
                <label for="emaiil" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="{{$student->email}}">
              </div>
              <div class="col-md-6">
                <label for="phone" class="form-label">Celular</label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{$student->phone}}">
              </div>
              <div class="col-md-6">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="adress" id="address" value="{{$student->address}}">
              </div>
              <div class="col-md-6">
                <label for="discount" class="form-label">Descuento (%)</label>
                <input type="number" class="form-control" name="discount" id="discount" value="{{$student->discount}}" required>
              </div>
              <div class="col-12 mt-2">
                <button class="btn btn-primary" type="submit">Actualizar</button>
              </div>
            </form>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
