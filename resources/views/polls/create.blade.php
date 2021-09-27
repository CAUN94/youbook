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
    <div class="card col-12 col-lg-10 mx-auto mt-4">
      <h5 class="card-header" style="background-color:#f2715a; color: white;">Encuesta seguimiento y satisfacción usuaria</h5>
      <div class="card-body">
        <p class="card-text">
          El objetivo de esta encuesta es generar un seguimiento en la atención en salud y obtener feedback de la condición de salud y la percepción de la calidad de atención hacia el usuario.
        </p>
      </div>
    </div>

    <div class="card col-12 col-lg-10 mx-auto mt-4">
      <h6 class="card-header" style="color:#f2715a; background-color: white;">RUT sin puntos con guion (EJ:11111111-1) *</h6>
      <div class="card-body">
        <p class="card-text">
          form
        </p>
      </div>
    </div>

    <div class="card col-12 col-lg-10 mx-auto mt-4">
      <h6 class="card-header" style="color:#f2715a; background-color: white;">En una escala del 0 al 100%, siendo 100% lo normal o lo mejor para usted. ¿Cómo puntuaría el estado actual de su lesión o dolor?</h6>
      <div class="card-body d-inline-flex flex-row justify-content-around">
          <div class="d-flex flex-column-reverse flex-sm-row px-4 px-sm-2">
            <p class="form-check-label mx-sm-2">0%</p>
          </div>
          @for ($i = 0; $i < 11; $i++)
          <div class="d-flex flex-column-reverse flex-sm-row px-sm-2">
            <input class="form-check-input mx-sm-1" type="radio" value="{{$i}}" name="pain" id="flexRadioDefault{{$i}}">
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
            <input class="form-check-input mx-sm-1" type="radio" value="{{$i}}" name="satisfaction" id="flexRadioDefault{{$i}}">
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
