@extends('layouts.app')

@section('content')

<x-hero />

<x-about />

<x-category />

<x-featured-products :products="$featuredProducts" />

@endsection