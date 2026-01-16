@extends('admin/layout')
@section('container')
@if(isset($dataUpdate))
{{$dataUpdate}}
@endif
<div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-header">
        <div class="row">
          <div class="col-8">
            <h4>Lead fields Mapping</h4>
          </div>
          <div class="col-4">
            @foreach($result as $val)
            @if($val->status == 1)
            <form action="{{ route('statusUpdate1', ['id' => $val->id, 'status' => 0]) }}" method="POST" style="display: inline;">
              @csrf
              @method('post')
              <button type="submit" class="btn btn-success">ON</button>
            </form>
            @elseif($val->status == 0)
            <form action="{{ route('statusUpdate1', ['id' => $val->id, 'status' => 1]) }}" method="POST" style="display: inline;">
              @csrf
              @method('post')
              <button type="submit" class="btn btn-danger">OFF</button>
            </form>
            @endif
            <p>From the button above you can connect lead or not connect</p>
            @endforeach

          </div>

        </div>

      </div>
       <div class="card-body">
                <form action="{{url('add_fields_lead')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bitrix24 Fields</label>
                                <input list="fields_list" class="form-control" name="bitrix" id="deal_fields">
                                <datalist id="fields_list">
                                    <option value="TITLE">TITLE</option>
                                    <option value="NAME">NAME</option>
                                    <option value="PHONE">PHONE</option>
                                    <option value="EMAIL">EMAIL</option>
                                </datalist>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">IndiaMart Fields</label>
                                <select class="form-control" name="indiamart">
                                    <option value="QUERY_TIME">Query Time</option>
                                    <option value="SENDER_NAME">Sender Name</option>
                                    <option value="SENDER_MOBILE"> Sender Phone</option>
                                    <option value="SENDER_EMAIL"> Sender Email</option>
                                    <option value="SENDER_EMAIL"> Sender Email</option>
                                    <option value="SUBJECT"> Lead Subject</option>
                                    <option value="SENDER_COMPANY">Sender Company Name</option>
                                    <option value="SENDER_ADDRESS">Sender Address</option>
                                    <option value="SENDER_CITY">Sender City</option>
                                    <option value="SENDER_STATE">Sender State</option>
                                    <option value="SENDER_PINCODE">Sender Pincode</option>
                                    <option value="QUERY_PRODUCT_NAME">Sender Query Product</option>
                                    <option value="QUERY_MESSAGE">Sender Query Message</option>
                                    <option value="QUERY_MCAT_NAME">Sender Query MCAT</option>
                                   <option value="SORCE_ID">Sorce ID</option>

                                </select>

                            </div>
                        </div>
                        <div class="col-4">

                        </div>
                        <button type="submit" class="btn btn-primary">Add Now</button>
                    </div>
                </form>
                <h4>Please check the fields you have mapped.</h4>
                <table class="table table-bordered mt-5">
          <tr>
            <th>IndiaMart fields</th>
            <th>Bitrix24 fields</th>
          </tr>
          @foreach($result as $val)
          <tr>
            <td>Query Time</td>
            <td>{{$val->query_time}}</td>
          </tr>
          <tr>
            <td>Sender Query MCAT</td>
            <td>{{$val->query_mcat_name}}</td>
          </tr>
          <tr>
            <td>Sender Query Message</td>
            <td>{{$val->query_msg}}</td>
          </tr>
          <tr>
            <td>Sender Query Product</td>
            <td>{{$val->query_product}}</td>
          </tr>
          <tr>
            <td>Sender Pincode</td>
            <td>{{$val->sender_pin}}</td>
          </tr>
          <tr>
            <td>Sender State</td>
            <td>{{$val->sender_state}}</td>
          </tr>
          <tr>
            <td>Sender City</td>
            <td>{{$val->sender_city}}</td>
          </tr>
          <tr>
            <td>Sender Address</td>
            <td>{{$val->sender_add}}</td>
          </tr>
          <tr>
            <td>Sender Company Name</td>
            <td>{{$val->sender_company}}</td>
          </tr>
          <tr>
            <td>Lead Subject</td>
            <td>{{$val->subject}}</td>
          </tr>
          <tr>
            <td>Sender Email</td>
            <td>{{$val->sender_email}}</td>
          </tr>
          <tr>
            <td> Sender Phone</td>
            <td>{{$val->sender_phone}}</td>
          </tr>
          <tr>
            <td>Sender Name</td>
            <td>{{$val->sender_name}}</td>
          </tr>
          <tr>
            <td>Sorce ID</td>
            <td>{{$val->sorce}}</td>
          </tr>
          
          @endforeach

        </table>

            </div>
        </div>
    </div>
</div>
@endsection