@extends("layouts.app")
@section("title", "Nos services")

@section("content")
    <x-breadcrumbs :levels="[(object) array('label' => 'Nos services')]"/>
    <!--services img area-->
    <div class="services_gallery mt-60">
        <div class="container">
            <div class="row">
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="single_services">
                            <div class="services_thumb">

                                @if($service->photos->isEmpty())
                                    <img src="assets/img/service/services1.jpg" alt="">
                                @else
                                    <img
                                        src="{{route("dolibarr", ["file"=>'produit/' . $service->ref . '/' .$service->photos->get(0)])}}"
                                        alt="">

                                @endif
                            </div>
                            <div class="services_content">
                                <h3>{{$service->label}}</h3>
                                <p>{!! $service->description !!}</p>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--services img end-->

@endsection
@push("scripts")
@endpush
