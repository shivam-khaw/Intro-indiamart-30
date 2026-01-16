@extends('admin_dashboard/layouts')
@section('container')

<style>

</style>
<div class="box-container">

<div class="box box1">
    <a href="{{url('admin/dashboard/indiamart')}}">
        <div class="text">
            <h2 class="topic-heading">{{$userCount}}</h2>
            <h2 class="topic">Total Users</h2>
        </div>
    </a>
    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(31).png" alt="Views">
</div>
<a href="{{url('admin/payment-done')}}">
<div class="box box2" id="box2">
    <div class="text">
        <h2 class="topic-heading">{{$paymenDone}}</h2>
        <h2 class="topic">Subscription done users</h2>
    </div>

    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210185029/13.png" alt="likes">
</div>
</a>
<a href="{{url('admin/payment-failed')}}">
<div class="box box3">
    <div class="text">
        <h2 class="topic-heading">{{$faild}}</h2>
        <h2 class="topic">Subscription Failed Users</h2>
    </div>

    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRKijnxvfRldKm19gRHjFL3rSQzS7_hMpQlQJqC0iqxUIM7l9-wKT5TrYnso2eKH4MII84&usqp=CAU" alt="comments">
</div>
</a>
<a href="{{url('admin/payment-free')}}">
<div class="box box4">
    <div class="text">
        <h2 class="topic-heading">{{$free}}</h2>
        <h2 class="topic"> Subscription Free users</h2>
    </div>

    <img src="data:image/png;base64,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" alt="published">
</div>
</a>
</div>

<div class="report-container">

    @if(session('success'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('success') }}

    </div>
    @endif

    <!-- Display error message if it exists -->
    @if(session('error'))
    <div class="alert alert-danger text-center" role="alert">
        {{ session('error') }}
    </div>
    @endif
   

    <div class="report-header">
        <h1 class="recent-Articles">All users</h1>
        <a href="{{url('admin/register')}}" class="btn btn-primary text-end">ADD NEW EMPLOYEE <i class="fa fa-plus"></i></a>

    </div>

    <div class="container table-container">
        
        <table id="example" class="table table-striped " cellspacing="0" width="100%">
            <thead class="thed1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>pHONE</th>
                    <th>Status</th>
                    <th>Api Key</th>
                    <th>Bitrix URL</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="body1">
                @foreach($result as $key=>$value)
                <tr>
                    <td>1</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->phone}}</td>
                    @if($value->status == 1)
                    <td><a href="{{url('admin/statusupdate', ['id' => $value->id, 'status' => 0]) }}" class="btn btn-success">Activate</a></td>
                    @else
                    <td><a href="{{url('admin/statusupdate', ['id' => $value->id, 'status' => 1]) }}" class="btn btn-warning">Deactivate</a></td>
                    @endif

                    <td>{{$value->api_key}}</td>
                    <td>{{$value->bitrix_url}}</td>
                    <td>
                        <a href="{{url('admin/user_delete', ['id' => $value->id]) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></span>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
<script>
    $(document).ready(function() {

        //Only needed for the filename of export files.
        //Normally set in the title tag of your page.
        document.title = 'Simple DataTable';
        // DataTable initialisation
        $('#example').DataTable({
            "dom": '<"dt-buttons"Bf><"clear">lirtp',
            "paging": true,
            "autoWidth": true,
            "buttons": [
                'colvis',
                'copyHtml5',
                'csvHtml5',
                'excelHtml5',
                'pdfHtml5',
                'print'
            ],
            fixedHeader: true
        });

    });
</script>

@endsection