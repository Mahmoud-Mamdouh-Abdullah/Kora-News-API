@extends('layouts.main')

@section('content')

    <div class="heading-page header-text">
        <section class="page-heading">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="text-content">
                  <h4>Admin Panel</h4>
                  <h2>Manage All News Here</h2>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <div class="container mt-5">
          <a href="{{url('news')}}" class="btn btn-block btn-dark btn-custom">Manage News</a>
          <a href="users/index" class="btn btn-block btn-dark btn-custom">Manage Users</a>
      </div>
@endsection