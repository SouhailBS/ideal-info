@props(['levels'])

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="{{url("/")}}">accueil</a></li>
                        @foreach($levels as $level)
                            @if($loop->last)
                                <li>{{$level->label}}</li>
                            @else
                                <li><a href="{{$level->route}}">{{$level->label}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
