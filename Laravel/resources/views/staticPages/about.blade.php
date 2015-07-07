@extends('staticPages.staticPage')

@section('content')
        <style>
            .text {
                font-size: 28px;
                border:0px solid #666;
            }
        </style>

                <div class="title">About <?= $name; ?></div>
                <div class="title">About {{ $name }}</div>
                <div class="text">Lorem ipsum dolor sit amet, at graeci malorum deserunt eam,
                ex vel hinc euismod hendrerit. Mel amet deserunt patrioque in. Ad lorem utamur
                labores mei, eu detracto volutpat mei. Est eu doctus offendit accusamus, sit eu
                quot aeque dignissim. Pro ipsum mazim habemus ex, quas soleat te nam.
                </div>
@stop

