@extends('admin_dashboard/layouts')
@section('container')

<style>

</style>

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
        <h1 class="recent-Articles">All payment done user</h1>


    </div>

    <div class="container table-container">
        <table id="example1" class="table table-striped " cellspacing="0" width="100%">
            <thead class="thed1">
                <tr>
                    <th>ID</th>
                    <th>Name </th>
                    <th>Email</th>
                    <th>Plan Activate Date</th>
                    <th>Plan Expire Date</th>
                    <th>Amount </th>
                    <th>Plan Type</th>
                    <th>Plan  Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="body1">
                @php
                $i=1
                @endphp
                @foreach($payments as $key=>$value)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->payment_date}}</td>
                    <td>{{$value->plan_expire}}</td>
                    <td>{{ $value->amount . ' ' . $value->currency }}</td>
                    <td>{{$value->plan}}</td>
                    @if($value->plan_status == 1)
                    <td><a href="" class="btn btn-success">Activate</a></td>
                    @else
                    <td><a href="" class="btn btn-warning">Deactivate</a></td>
                    @endif

                    <td>
                        <a class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></span>
                    </td>
               
                </tr>
                @php 
                $i++
                @endphp
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
        $('#example1').DataTable({
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