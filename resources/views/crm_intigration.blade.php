@extends('admin/layout')

@section('container')
<style>
    .api-text2 {
        color: red;
    }

    .api-text {
        color: green;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="top-text">Intigration with CRM</div>
        <div class="one">
            <a href="{{url('deal_fields')}}"><button class="square-grad">Deal fields mapping</button></a>
            <a href="{{url('lead_fields')}}"><button class="square-grad">Lead fields mapping</button></a>

        </div>
    </div>
</div>
</div>
<h4></h4>
<div class="row">
    <div class="col-12">
        <div class="card widgets1">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 widgets" id="myBtn">
                        <div class="card">
                            <div id="">
                                <div class="form-group text-right connected">
                                    <label class="container">Connected
                                        <input type="checkbox" checked="checked" disabled="disabled">
                                        <span class="checkmark"></span>
                                    </label>

                                </div>
                                <img src="https://logowik.com/content/uploads/images/bitrix241512.jpg">
                                <div id="myModal" class="modal">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Enter Bitrix24 URL</label>
                                            <input type="url" id="key" class="form-control" placeholder="https://my.bitrix24.com/"  value="">

                                            <input type="hidden" id="id" value="{{Auth::user()->id}}">
                                            <button class="btn btn-success mt-2" id="submit-btn">Save</button>
                                        </div>
                                        <div class="api-text"></div>
                                        <div class="api-text2"></div>
                                        <ul>
                                            <li>Enter that bitrix24  URL here</li>
                                            <li>Here enter the URL of bitrix24 in which you Installed intro indiamart app</li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 widgets"></div>
                    <div class="col-3 widgets"></div>
                    <div class="col-2 widgets"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection;
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
    type: 'GET',
    url: "{{ url('url-get') }}",
    success: function(data) {
        if (data.status == 'error') {
            $(".api-text2").text(data.message);
        } else {
            // Display success message
            $("#key").val(data.key);
            if(data.key){
              $('.connected').show();
            }
        }
    },
    error: function(error) {
        console.log(error);
    }
});



        $(document).on('click', '.close', function() {
            $('.modal').hide();
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#submit-btn").click(function(e) {
            e.preventDefault();

            var key = $("#key").val();

            $.ajax({
                type: 'POST',
                url: "{{ url('url.post') }}",
                data: {
                    key: key,
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == 'error') {
                        $(".api-text2").text(data.message);
                    } else {
                        // Display error message
                        $(".api-text").text('URL Added successfully.');

                    }

                    // $(".api-text").text(data); 
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>