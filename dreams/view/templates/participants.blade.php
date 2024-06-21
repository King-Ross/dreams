@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">

  <div class="pagetitle">
    <h1>All Participant</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Home</a></li>
        <li class="breadcrumb-item active">All participants.</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    
  </section>

</main><!-- End #main -->

@include('partials/footer')