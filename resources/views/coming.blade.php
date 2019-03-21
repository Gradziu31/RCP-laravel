@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Odbicia</div>
                <div class="card-body">



<div class="row">
   <div class="col-6">
   <h4>Odbij się!</h4>
  <!-- checkout -->
  @if($length > 0)
    @if (!($page->first()->created_at == $page->first()->updated_at))
    {!! Form::open(['url' => '/coming', 'method' => 'post', 'style' => 'display: flex']) !!}
        {!! Form::text('user_id', Auth::user()->id, ['type="hidden"']) !!}
        {!! Form::text('user', null, ['type="hidden"']) !!}
        {!! Form::text('created_at', date("Y-m-d H:i:s"), ['class="form-control datapicker" id="datetodays" autocomplete="off" required type="hidden"']) !!}
        {!! Form::text('updated_at', date("Y-m-d H:i:s"), ['class="form-control datapicker" id="datetodays1" autocomplete="off" required type="hidden"']) !!}
        {!! Form::submit('Check In',['class="btn btn-success"']) !!}
    {!! Form::close() !!}
    @endif
  @endif

  @if($length == 0)
    {!! Form::open(['url' => '/coming', 'method' => 'post', 'style' => 'display: flex']) !!}
        {!! Form::text('user_id', Auth::user()->id, ['type="hidden"']) !!}
        {!! Form::text('user', null, ['type="hidden"']) !!}
        {!! Form::text('created_at', date("Y-m-d H:i:s"), ['class="form-control datapicker" id="datetodays" autocomplete="off" required type="hidden"']) !!}
        {!! Form::text('updated_at', date("Y-m-d H:i:s"), ['class="form-control datapicker" id="datetodays1" autocomplete="off" required type="hidden"']) !!}
        {!! Form::submit('Check In',['class="btn btn-success"']) !!}
    {!! Form::close() !!}
  @endif

  <!-- checkin -->
  @if($length > 0)
  @if ($page->first()->created_at == $page->first()->updated_at)
    {!! Form::open(['url' => '/coming/'.$page->first()->id, 'method' => 'PATCH', 'action' => ['WorkController@update', $page->first()->id]]) !!}
        {!! Form::text('created_at', $page->first()->created_at, ['class="form-control datapicker" type="hidden"']) !!}
        {!! Form::submit('Check Out',['class="btn btn-danger"']) !!}
    {!! Form::close() !!}
  @endif
  @endif


  </div>

  <div class="col-6">
  @if($length > 0)
    @if (!($page->first()->created_at == $page->first()->updated_at))
  <h4>Dodaj godziny pracy ręcznie!</h4>
<a href="/coming/create" class="btn btn-success">Ustaw ręcznie</a>
@endif
@endif
  </div> 



</div>
<br>



                    <table class="table">
    <thead>
      <tr>
        <!-- <th>ID</th> -->
        <!-- <th>user</th> -->
        <th>Godzina rozpoczęcia</th>
        <th>Godzina zakończenia</th>
        <th>Przepracowane</th>
        <th>Dostępne opcje</th>
      </tr>
    </thead>
                    
                   


    <tbody>
    @foreach($page as $pages)
    @if ($pages->parent->id == Auth::user()->id)
      <tr>
        <!-- <td>{{$pages->id}}</td> -->
        <!-- <td>{{$pages->user}}</td> -->
        <td>{{$pages->created_at}}</td>
        <td>
        @if ($pages->created_at == $pages->updated_at)
        @else 
        {{$pages->updated_at}}
        @endif
        </td>
        <td>
        <div id="test{{$pages->id}}"></div>@if(isset($pages->user)) <small>({{$pages->user}})</small> @endif
        <script>
        $(function(){
            var s = new Date("{{$pages->created_at}}");
            var e = new Date("{{$pages->updated_at}}");
            var diffMs = (e-s);

            var diff =(s.getTime() - e.getTime()) / 1000;
            diff /= (60 * 60);
            
            var res = Math.abs(e - s) / 1000;

            var minuty = Math.round(((diffMs % 86400000) % 3600000) / 60000);
            if(minuty <= 9) {
              minuty = '0'+minuty
            } else {
              minuty
            }
            $('#test{{$pages->id}}').html('<span class="hours">'+Math.abs(Math.round(diff)) + '</span>:' + '<span class="min">' + minuty + '</span>')
        });
        </script>

        </td>
        <td>
        <div style="display: flex;">
          <a href="/coming/{{$pages->id}}/edit" class="btn btn-primary" style="margin-right: 5px;">Edytuj!</a>
          {!! Form::open(['url' => '/coming/'.$pages->id, 'method' => 'delete']) !!}
              {!! Form::submit('skasuj',['class="btn btn-danger" style="margin-right: 5px;"']) !!}
          {!! Form::close() !!}
          <a href="/coming/{{$pages->id}}" class="btn btn-warning" style="margin-right: 5px;">Info!</a>
        </div>
        </td>
      </tr>
      @endif
  @endforeach
  <tr>
  <td>@if($length > 10 ) {{$page->links()}} @endif</td>
  <td></td>
  <td></td>
  <td><b>Razem:</b> <span id="total"></span>
  
        <script>
        $(function(){
          var all = 0;
          var min = 0;
$( ".hours" ).each(function( ) {
  all += parseInt($(this).html());
});
$( ".min" ).each(function( ) {
  min += parseInt($(this).html());
});

    if(min > 59) {
      var mtoh = min/60;
      var lastmin = min % 60;
      all = all + mtoh;
      min = lastmin;
    }
    $('#total').html(Math.floor(all) + " godzin i " + min + 'minut.')
});
        </script>
  
  </td>
  </tr>
    </tbody>
  </table>
  <div>Do poprawienia/napisania: 
  <ul>
  <li>podział na miesiące</li>
  <li>wyświetlanie całego miesiąca w paginacji po około 30 dni</li>
  <li>liczenie czasu z całego miesiąca przy paginacji - teraz liczy tylko widoczne</li>
  <li>zabezpieczenie routów</li>
  <li>zablokowac przycisk checkIn/Out zanim ma datę</li>
  </ul>
  </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

setInterval(function(){ 
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1; //January is 0!
  var yyyy = today.getFullYear();
  var time = today.getHours();
  var time1 = today.getMinutes();
  var time2 = today.getSeconds();

  if(dd <= 9) {
    dd = '0'+dd;
  }
  if(mm <= 9) {
    mm = '0'+mm;
  }


  if(time <= 9) {
    time = '0'+time
  }

  if(time1 <= 9) {
    time1 = '0'+time1
  }

  if(time2 <= 9) {
    time2 = '0'+time2
  }
  var today = yyyy + '-' + mm + '-' + dd + ' ' + time + ':' + time1 + ':' + time2;
console.log(today)
  $('#datetodays').val(today);
  $('#datetodays1').val(today);
}, 1000);
</script>
@endsection
