       <div class="modal fade" id="exampleModal{{$professional->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Doctor information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p><img src="{{asset('/img/professionals')}}/{{$professional->image}}" class="table-user-thumb" alt="" width="200"></p>
                    <p class="badge badge-pill badge-dark">Role: {{$professional->role->name}}</p>
                    <p>Nombre:{{$professional->name}} {{$professional->lastnames}}</p>
                    <p>Genero:{{$professional->gender}}</p>
                    <p>Email:{{$professional->email}}</p>
                    <p>Dirección:{{$professional->address}}</p>
                    <p>Celular:{{$professional->phone_number}}</p>
                    <p>Área:{{$professional->department}}</p>
                    <p>Titulo:{{$professional->education}}</p>
                    <p>Descripción:{{$professional->description}}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                  </div>
                </div>
              </div>
            </div>
