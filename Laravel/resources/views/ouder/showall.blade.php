@extends('staticPages.staticPage')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>
                Lijst Ouders
            </h1>
            <p>
                Om een ouder of volwassene aan te maken vertrek je van een bestaande <a href="/jongere">jongere uit de lijst</a> of maak je eerst de <a href="/jongere/create">nieuwe jongere</a> aan
            </p>
        </div>
    </div>
    @unless(!$ouders)
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Naam</th>
                        <th>Origine</th>
                        <th>Relatie met</th>
                    </tr>

                    @foreach ($ouders as $ouder)
                        <tr>
                            <td>
                                <a href="ouder/{{$ouder->id}}">
                                    {{ $ouder->naam }}&nbsp;{{ $ouder->voornaam }}
                                </a>
                            </td>
                            <td>
                                {{ $ouder->getOrigine() }}
                            </td>
                            <td>
                                @foreach($ouder->getJongeren as $jongere)
                                    <b>{{ $jongere->getOuderRelatie($ouder->id) }}</b> van <a href="/jongere/{{$jongere->id}}">{{$jongere->naam}}&nbsp;{{$jongere->voornaam}}</a><br />
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endunless


@stop
