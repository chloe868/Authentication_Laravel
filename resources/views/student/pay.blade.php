<link rel="stylesheet" href="{{url('css/form.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{url('css/addform.css')}}">

@extends('layouts.auth')

@section ('content')

<body class="bg">
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header"><b>Pay a counterpart</b></div>
                <div class="card-body">
                    <form method="post" action="{{route('stores',$student->id)}}">
                        {{csrf_field()}}
                        <br><br>
                        <div class="input-group form-group">
                            <i class="fa fa-calendar icon"></i>
                            <select class="form-control" name="month">
                                <option>---Choose Month---</option>
                                <option>January</option>
                                <option>February</option>
                                <option>March</option>
                                <option>April</option>
                                <option>May</option>
                                <option>June</option>
                                <option>July</option>
                                <option>August</option>
                                <option>September</option>
                                <option>October</option>
                                <option>November</option>
                                <option>December</option>
                            </select>
                        </div>
                        <div class="input-group form-group">

                            <i class="fa fa-calendar icon"></i>

                            <select class="form-control" name="year">

                                <option>---Choose Year---</option>
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                                <option>2026</option>
                                <option>2027</option>
                                <option>2028</option>
                                <option>2029</option>
                                <option>2030</option>
                            </select>
                        </div>
                        <div class="input-group form-group">

                            <i class="fa fa-money icon"></i>

                            <input type="number" name="amount" class="form-control" placeholder="Input Amount"
                                value="" />
                        </div>
                        <div class="input-group form-group">
                            <i class="fa fa-calendar icon"></i>

                            <input type="date" name="dateofpayment" class="form-control" placeholder="Date  "
                                value="" />
                        </div>
                        <button type="button" class="btn welcome_btn" data-toggle="modal" data-target="#myModal">
                            MESSAGE
                        </button>
                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                        <!-- <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary" large>  
      </div> -->


                    </form>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{route('mail')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" id="fname" name="first_name" placeholder=""
                                    value="{{ old('first_name') }}">
                                <span class="error">
                                    @if($errors->has('first_name'))
                                    {{ $errors->first('first_name') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="lname">Email</label>
                                <input type="text" id="lname" name="email" placeholder="" value="{{ old('email') }}">
                                <span class="error">
                                    @if($errors->has('email'))
                                    {{ $errors->first('email') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="lname">Message</label>
                                <textarea class="form-control" name="message" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">

                                <input class="btn btn-primary" type="submit" value="SEND">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </form>
                    </div>

                    <!-- Modal footer -->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    @endsection