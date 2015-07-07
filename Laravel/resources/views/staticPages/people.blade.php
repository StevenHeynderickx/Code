@extends('staticPages.staticPage')

@section('content')
        <style>
            .text {
                font-size: 28px;
                border:0px solid #666;
            }
        </style>

                <div class="title">People</div>
                <div class="text">
                    @if(count($names))
                    <h3>My List</h3>
                    <ul>
                    @foreach($names as $person)
                    <li>{{ $person }}</li>
                    @endforeach
                    </ul>
                    @endif
                </div>
@stop