@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <div class="h4 card-title">All Participants</div>
            <hr>
            <h1>3</h1>
            <a href="/{{$appName}}/dashboard/participant/register/">View Participants</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <div class="h4 card-title">All Lessons</div>
            <hr>
            <h1>3</h1>
            <a href="/{{$appName}}/dashboard/lessons/">View Lessons</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <div class="h4 card-title">All Events</div>
            <hr>
            <h1>3</h1>
            <a href="/{{$appName}}/dashboard/events/">View Events</a>
          </div>
        </div>
      </div>
      
      
    </div>
  </section>

</main><!-- End #main -->

@include('partials/footer')