@extends('edit.editForm')

@section('action', route('edit.update', $product->id))
@section('input')
    <input type="hidden" name="id" autocomplete="off" value="{{$product->id}}">
@endsection
