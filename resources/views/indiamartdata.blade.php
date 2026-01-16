@extends('admin/layout')

@section('container')
<style>
    .table-responsive {
        overflow-x: auto;
    }

    .table tbody {
        overflow-y: auto;
     max-height: 200px; /* Adjust this value as needed */

    }
    .w-5{
        display:none;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Api Data</h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Query Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>subject</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->query_id}}</td>
                                <td>{{$item->sender_name}}</td>
                                <td>{{$item->sender_email}}</td>
                                <td>{{$item->sender_phone}}</td>
                                <td>{{$item->subject}}</td>
                                <td>{{$item->sender_add}}</td>
                                <td>{{$item->sender_city}}</td>
                                <td>{{$item->sender_state}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $data->links() }} <!-- Add pagination links -->
            </div>
        </div>
    </div>
</div>
@endsection;

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        let userId = '{{Auth::user()->id}}';
        $.ajax({
            url: '{{url("show_data")}}', // The route defined in web.php
            type: 'GET',
            data: {userId: userId},
            success: function (data) {
                // Handle the retrieved data here
                console.log(data);
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    });
</script>
@endpush
