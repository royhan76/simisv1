@extends('master')



@section('body')
<form method="POST" action="{{ route('updateFoto', $data->santri_id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <br>
    {{-- {{$data->path}} --}}
    <br>
    <label for="photo">Photo:</label>
    <input type="file" name="photo">
    <button type="submit">Update</button>
</form>
@endsection
