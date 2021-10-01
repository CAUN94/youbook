<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>You Just Better</title>
  </head>
  <body class="container-fluid" style="background-color: rgb(44, 44, 44);">
    <form action="/encuesta" method="POST">
      @csrf
      <div class="card col-12 col-lg-10 mx-auto mt-4">
        <h5 class="card-header" style="background-color:#f2715a; color: white;">Encuesta seguimiento y satisfacción usuario/a</h5>
        <div class="card-body">
          <p class="card-text">
            El objetivo de esta encuesta es generar un seguimiento de su atención, obtener feedback de su condición de salud y su percepción de la calidad de su atención.
          </p>
        </div>
      </div>

      <div class="card col-12 col-lg-10 mx-auto mt-4 {{ $errors->has('rut') ? 'bg-warning' : '' }}">
        <h6 class="card-header" style="color:#f2715a; background-color: white;">Tu Rut</h6>
        <div class="card-body">
          <input name="rut" type="text" class="form-control" placeholder="11111111-1" required>
        </div>
        @error('rut')
          <div class="card-footer">
            <small class="ml-1 text-muted">{{$message}}</small>
          </div>
        @enderror
      </div>

      <div class="card col-12 col-lg-10 mx-auto mt-4">
        <h6 class="card-header" style="color:#f2715a; background-color: white;">En una escala del 0 al 100%, siendo 100% lo normal o lo mejor para usted. ¿Cómo puntuaría el estado actual de su lesión o dolor?</h6>
        <div class="card-body d-inline-flex flex-row justify-content-around">
            <div class="d-flex flex-column-reverse flex-sm-row px-4 px-sm-2">
              <p class="form-check-label mx-sm-2">0%</p>
            </div>
            @for ($i = 0; $i < 11; $i++)
            <div class="d-flex flex-column-reverse flex-sm-row px-sm-2">
              <input class="form-check-input mx-sm-1" type="radio" value="{{$i}}+1" name="pain" id="flexRadioDefault{{$i}}" {{(old('pain') == $i+1) ? 'checked' : ''}} required>
              <label class="form-check-label  mx-sm-1" for="flexRadioDefault{{$i}}">
                {{$i}}
              </label>
            </div>
            @endfor
            <div class="d-flex flex-column-reverse flex-sm-row  px-4 px-sm-2">
              <p class="form-check-label mx-sm-1">100%</p>
            </div>
        </div>
      </div>

      <div class="card col-12 col-lg-10 mx-auto mt-4">
        <h6 class="card-header" style="color:#f2715a; background-color: white;">En relación a su última atención. ¿Qué tan satisfecho se encuentra con la atención brindada?</h6>
        <div class="card-body d-inline-flex flex-row justify-content-around">
            <div class="d-flex flex-column-reverse flex-sm-row px-4 px-sm-2">
              <p class="form-check-label mx-sm-2">Poco Satisfecho</p>
            </div>
            @for ($i = 1; $i < 6; $i++)
            <div class="d-inline px-sm-1">
              <input class="form-check-input mx-sm-1" type="radio" value="{{$i}}" name="satisfaction" id="flexRadioDefault{{$i}}" {{(old('satisfaction') == $i) ? 'checked' : ''}} required>
              <label class="form-check-label  mx-sm-1" for="flexRadioDefault{{$i}}">
                {{$i}}
              </label>
            </div>
            @endfor
            <div class="d-flex flex-column-reverse flex-sm-row px-4 px-sm-2">
              <p class="form-check-label mx-sm-2">Muy Satisfecho</p>
            </div>
        </div>
      </div>

      <div class="card col-12 col-lg-10 mx-auto mt-4">
        <h6 class="card-header" style="color:#f2715a; background-color: white;">Puntuando del 1 al 5 e incluyendo desde el ingreso en recepción hasta la atención del profesional de salud ¿Con qué nota calificaría su experiencia en You?</h6>
        <div class="card-body d-inline-flex flex-row justify-content-around">
            <div class="d-flex flex-column-reverse flex-sm-row px-4 px-sm-2">
              <p class="form-check-label mx-sm-2">Mala</p>
            </div>
            @for ($i = 1; $i < 6; $i++)
            <div class="d-inline px-sm-1">
              <input class="form-check-input mx-sm-1" type="radio" value="{{$i}}" name="experience" id="flexRadioDefault{{$i}}" {{(old('experience') == $i) ? 'checked' : ''}} required>
              <label class="form-check-label  mx-sm-1" for="flexRadioDefault{{$i}}">
                {{$i}}
              </label>
            </div>
            @endfor
            <div class="d-flex flex-column-reverse flex-sm-row px-4 px-sm-2">
              <p class="form-check-label mx-sm-2">Muy Buena</p>
            </div>
        </div>
      </div>

      <div class="card col-12 col-lg-10 mx-auto mt-4">
        <h6 class="card-header" style="color:#f2715a; background-color: white;">Con respecto a su última atención. ¿Qué probabilidad existe de que nos recomiende a un amigo o colega?</h6>
        <div class="card-body d-inline-flex flex-row justify-content-around">
            <div class="d-flex flex-column-reverse flex-sm-row px-4 px-sm-2">
              <p class="form-check-label mx-sm-2">0%</p>
            </div>
            @for ($i = 1; $i < 6; $i++)
            <div class="d-inline px-sm-1">
              <input class="form-check-input mx-sm-1" type="radio" value="{{$i}}" name="friend" id="flexRadioDefault{{$i}}" {{(old('friend') == $i) ? 'checked' : ''}} required>
              <label class="form-check-label  mx-sm-1" for="flexRadioDefault{{$i}}">
                {{$i}}
              </label>
            </div>
            @endfor
            <div class="d-flex flex-column-reverse flex-sm-row px-4 px-sm-2">
              <p class="form-check-label mx-sm-2">100%</p>
            </div>
        </div>
      </div>

      <div class="card col-12 col-lg-10 mx-auto mt-4">
        <h6 class="card-header" style="color:#f2715a; background-color: white;">Nos encantaría mejorar. ¿Nos podrías comentar algo que te gustaría que cambiáramos?</h6>
        <div class="card-body d-inline-flex flex-row justify-content-around">
          <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
      </div>

      <div class="col-12 col-lg-10 mx-auto mt-4 mb-10">
        <div class="d-grid gap-2 d-block d-md-flex justify-content-md-end">
          <button type="submit" class="btn btn-primary btn-lg" style="background-color: #f2715a; border: #f2715a;" >Enviar</button>
        </div>
      </div>
    </form>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>
