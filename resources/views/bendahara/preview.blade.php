@extends('layouts.master')
@section('title','Bendahara Page')
@section('judul','Bendahara Page')
@section('section-header')
    <h1>Detail Transaksi Bendahara</h1>
@endsection
@section('section-body')
{{-- <iframe src="https://docs.google.com/spreadsheets/d/1j2WkT9MbwegQGGy0MovHzTU4-QnMB58x/edit#gid=1389807665" frameborder="no" style="width:100%;height:500px"></iframe> --}}
{{-- {{$file=fopen("pjk.docx","r")}} --}}
@foreach ($word as $item)
    echo $item;
@endforeach
@endsection
