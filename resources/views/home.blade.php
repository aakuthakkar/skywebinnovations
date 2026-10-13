@extends('layouts.app')

@section('body')
<header>
  @include('partials.header')
</header>

<main id="top">

  @include('sections.hero')
  @include('sections.about')
  @include('sections.founder')
  @include('sections.why-us')
  @include('sections.services')
  @include('sections.work')
  @include('sections.process')
  @include('partials.marquee')
  @include('sections.contact')

</main>

@include('partials.footer')

@endsection
