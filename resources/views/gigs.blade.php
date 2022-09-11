<h1>{{$heading}}</h1>

@if (count($gigs) > 0)
    @foreach ($gigs as $gig)
        <h2><a href="/gig/{{$gig['id']}}">{{$gig['title']}}</a></h2>
        <p>{{$gig['description']}}</p>
    @endforeach
    @else
    <p>There's No Gigs Found.</p>
@endif