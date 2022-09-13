<x-layout>
@section('title', 'Home Page')
@include('partials._hero')
@include('partials._search')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @if (count($gigs) > 0)
            @foreach ($gigs as $gig)
                <x-gig-card :gig="$gig" />
            @endforeach
            @else
            <p>There's No Gigs Found.</p>
        @endif
    </div>
</x-layout>