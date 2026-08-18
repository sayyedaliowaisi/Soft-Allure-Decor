@extends('layouts.app')

@section('content')

<x-hero />

<x-about />

<x-category />

<x-featured-products :products="$featuredProducts" />

<x-why-us />

<x-applications />

<x-cta />

<x-testimonials />

<x-contact-section />

@endsection