@extends('admin/layout')

@section('container')
<style>
    .api-text2 {
        color: red;
    }

    .api-text {
        color: green;
    }

    .container {
        position: relative;
        width: 300px;
        /* Adjust container width as needed */
        height: 200px;
        /* Adjust container height as needed */
        border: 1px solid #ccc;
        /* Just for visualization */
    }

    .check-icon {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: green;
        /* Green color */
        color: white;
        /* Text color */
        padding: 5px 10px;
        /* Adjust padding as needed */
        border-radius: 5px;
        /* Rounded corners */
    }

    .check-icon::before {
        content: '';
        position: absolute;
        top: 50%;
        left: -10px;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background-color: green;
        border-radius: 50%;
    }

    .check-icon::after {
        content: '';
        position: absolute;
        top: 50%;
        left: -5px;
        transform: translateY(-50%);
        width: 10px;
        height: 10px;
        border-bottom: 2px solid white;
        border-right: 2px solid white;
        transform: rotate(45deg);
    }

    .check-icon {
        display: none;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="top-text">Channels</div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <h4 class="text-center">Add a channel
                        </h4>
                        <p class="min-text">Channel is a messenger or social media account that you connect to Wazzup to communicate with clients.
                            Choose what you want to connect first:</p>
                        <div class="main-card my-5">

                            <div class="row d-flex justify-content-center">

                                <div class="col-sm-3 card channel-card">
                                    <div id="myBtn">
                                        <a href="#"><img class="img-size" src="https://companieslogo.com/img/orig/INDIAMART.NS-ecf147e0.png?t=1613453866"></a>
                                        <p class="text-center">INDIAMART</p>
                                    </div>

                                    <!-- The Modal -->
                                    <div id="myModal" class="modal">
                                        <!-- Modal content -->
                                        <div class="modal-content">
                                            <span class="close">&times;</span>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Indiamart API key</label>
                                                <input type="text" class="form-control" id="key" value="{{$key}}">
                                                <input type="hidden" id="id" value="{{Auth::user()->id}}">
                                                <button class="btn btn-success mt-2" id="submit-btn">Save</button>
                                               <button id="loder" class="btn btn-success mt-2" style="display: none;" disabled >Loading... <span id="spinner" class="spinner-border text-light" role="status" >
                                                </span></button>
                                               
                                            </div>
                                            <div class="api-text"></div>
                                            <div class="api-text2"></div>
                                            <ul>
                                                <li>Follow this link for indiamart api key</li>
                                                <span>https://help.indiamart.com/knowledge-base/lms-crm-integration-v2/#Generate-CRM-Key---stylled</span>

                                                <p>OR</p>
                                                <li>Go to Indiamart Dashboard</li>
                                                <li>Left menu lead manager->CRM Integration-> Generate new Key or copy</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3  card channel-card">
                                    <span class="check-icon">Connected</span>

                                    <div id="razorpay-btn">
                                        <span class="check-icon">Connected</span>

                                        <a href="#"><img class="img-size" src="https://gdm-catalog-fmapi-prod.imgix.net/ProductLogo/5e93226d-df32-40d4-9db9-1a6eb49ae6de.jpeg">
                                        </a>
                                        <p class="text-center">Razorpay</p>
                                    </div>
                                    <!-- Button trigger modal -->
                                    <div id="myModal1" class="modal">
                                        <!-- Modal content -->
                                        <div class="modal-content1">
                                            <span class="close">&times;</span>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Enter the URL of Bitrix24 in which you want to use Razorpay app.</label>
                                                <input type="text" class="form-control" id="url" value="" pattern="https?://.+" title="Please enter a valid URL starting with http:// or https://">
                                                <input type="hidden" id="id" value="{{Auth::user()->id}}">
                                                <button class="btn btn-success mt-2" id="razorpay-submit">Save</button>
                                            </div>
                                            <div id="flash-message" class="alert" style="display:none;"></div>
                                            <ul>
                                                <ol>Go to your bitrix24 account</ol>
                                                <ol>Copy browser bitrix24 URL & past input box</ol>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                                <a href="#">
                                    <div class="col-sm-3 card channel-card"><img class="img-size" src="https://signrequest.com/images/favicons/coast-icon-228x228.png" alt="load--">
                                </a>
                                <p class="text-center">SIGNREQUEST</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: 'razorpay-bitrix24-url',
            success: function(response) {
                // Set the retrieved URL in the input field
                $('#url').val(response.url);
                if (response.razorpay_api && response.url) {
                    $('.check-icon').show();
                } else {
                    $('.check-icon').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Handle error
            }
        });

        $("#submit-btn").click(function(e) {
            e.preventDefault();
            $('#submit-btn').hide();
            $('#loder').show();

            var key = $("#key").val();
            var id = $("#id").val();
            $.ajax({
                type: 'POST',
                url: "{{ url('ajax.post') }}",
                data: {
                    key: key,
                    id: id
                },
                success: function(data) {
                    console.log(data);
                     $('#loder').hide();
                     $('#submit-btn').show();

                        if (data == 1) {
                            $(".api-text").text('API key saved successfully!');
                        } else if (data == 2) {
                            $(".api-text").text('API key updated successfully!');
                        } else {
                            $(".api-text2").text('Your API key is not correct!');
                        }
                },
                error: function(error) {
                    $('#loder').hide();
                     $('#submit-btn').show();

                    console.log(error);
                }
            });
        });
        $('#razorpay-btn').click(function() {
            $('#myModal1').css('display', 'block');
        });

        // Function to close modal
        $('.close').click(function() {
            $('#myModal1').css('display', 'none');
        });

        // Function to handle form submission
        $('#razorpay-submit').click(function() {
            var url = $('#url').val();
            var id = $('#id').val();
            // Assuming you're sending AJAX request to save data
            $.ajax({
                type: 'POST',
                url: '{{url("razorpay")}}',
                data: {
                    url: url,
                    id: id
                },
                success: function(response) {
                    $('#flash-message').text(response.success).addClass('alert-success').show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error
                    $('#flash-message').text('An error occurred. Please try again.').addClass('alert-danger').show();
                }
            });
        });
    });
</script>