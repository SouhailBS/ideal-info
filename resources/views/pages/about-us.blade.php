@extends("layouts.app")
@section("title", "Contactez-nous")

@section("content")
    <x-breadcrumbs :levels="[(object) array('label' => 'À propos de nous')]"/>
    <!--about section area -->
    <section class="about_section mt-60">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <figure>
                        <div class="about_thumb">
                            <img src="assets/img/about/about1.jpg" alt="">
                        </div>
                        <figcaption class="about_content">
                            <h1>À propos de nous</h1>
                            <p>{{config("company.MAIN_INFO_SOCIETE_OBJECT")}}</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!--about section end-->

    <!--team area start-->
    <div class="team_area">
        <div class="container">
            <div class="row">
                @foreach($employees as $employee)
                    <div class="col-lg-3 col-md-6">
                        <article class="team_member">
                            <figure>
                                <div class="team_thumb">
                                    <img
                                        src="{{route("dolibarr", ["file"=>'users/' . $employee->rowid . '/' .$employee->photo])}}"
                                        alt="{{$employee->lastname}} {{$employee->firstname}}">
                                </div>
                                <figcaption class="team_content">
                                    <h3>{{$employee->lastname}} {{$employee->firstname}}</h3>
                                    <h5>{{$employee->job}}</h5>
                                    <p>@if($employee->office_phone!='')Tél: {{$employee->office_phone}} <br>@endif
                                        @if($employee->office_phone!='')Email: {{$employee->email}}@endif</p>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--team area end-->
@endsection
@push("scripts")
@endpush
