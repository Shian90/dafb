@extends('layouts.backend.app')

@section('title')
Galleries
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endpush

@section('header-title')
All Galleries
@endsection

@section('add-menu')
<a  class="float-right" href="{{ route('app.galleries.create') }}">
  <label class="badge badge-success">Create Gallery</label>
</a>
@endsection

@section('content')
<div class='row'>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            
          </div>
        </div>
        <table id="order-listing" class="table">
          <thead>
            <tr>
              <th>Program</th>
              <th>Event</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($galleries as $gallery)
            <tr>
              <td>{{$gallery->project->headline['en']??'No program for the gallery'}}</td>
              <td>{{$gallery->event->headline['en']??'No event for the gallery'}}</td>
              <td>{{$gallery->created_at}}</td>
              <td>
                <a href="{{route('app.galleries.edit',$gallery->id)}}">
                  <button class="btn btn-outline-primary">Add content</button>
                </a>
                <a data-toggle="modal" href="" data-target="#delete{{ $gallery->id }}" class="btn btn-outline-danger">Delete</a>
                
              </td>
              <div class="modal fade" id="delete{{ $gallery->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Gallary </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      <button id="delete" type="button" class="btn btn-danger" onclick="deleteForm('{{ $gallery->id }}')">Delete</button>
                      <form id="deleteform{{ $gallery->id }}"
                        action="{{ route('app.galleries.destroy',$gallery->id) }}" method="POST"
                        style="display: none;">
                        @csrf()
                        @method('DELETE')
                      </form>
                    </div> 
                  </div>
                </div>
              </div>
            </tr> 
            @endforeach
          </tbody>
        </table>
        <div class="mt-4">
      </div>
      </div>
    </div>
  </div>
</div>  
@endsection
@push('custom-scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready( function () {
    $('#ttt').DataTable();
} );
</script>
@endpush  