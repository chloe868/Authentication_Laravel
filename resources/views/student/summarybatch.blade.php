@extends('layouts.auth')
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    * {
        box-sizing: border-box;
    }

    #myInput {
        background-image: url('/css/searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 20%;
        margin-left: 5%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;

    }

    #myTable {
        border-collapse: collapse;
        width: 90%;
        margin-left: 5%;
        border: 1px solid #ddd;
        font-size: 18px;
    }

    #myTable th {
        background-color: #ff9933
    }

    #myTable th,
    #myTable td {
        text-align: left;
        padding: 12px;
    }
    }

    .title {
        margin-bottom: 5%;
    }

    #myTable tr {
        border-bottom: 1px solid #ddd;
    }

    #myTable tr.header,
    #myTable tr:hover {
        background-color: #ffb061;
    }
    </style>
</head>

<body>
    <div style="margin-top:4%">
        <div class="title">
            <br><br>
            <center>
                <h1>Passarelles Numeriques Philippines Scholars</h1>
            </center>
        </div>
    </div>

    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

    <table id="myTable">
      <thead>
        <tr class="header">
            <th>Name of the student</th>
            <th>Batch</th>
            <th>Email</th>
            <th>Send</th>
            <th>Action</th>

        </tr>
  </thead>
        <tbody>
            @foreach($students as $scholars)
            <tr>
                <td>{{$scholars->first_name}} {{$scholars->middle_name}} {{$scholars->last_name}}</td>
                <td>{{$scholars->batch}}</td>
                <td>{{$scholars->email}}</td>
                <td><button type="button" class="btn welcome_btn" data-toggle="modal" data-target="#myModal">
                        MESSAGE
                    </button></td>

                
            </tr>

            @endforeach






        </tbody>
        <div>
            <h2 style="margin-top:-3%;float:right;margin-right:10%">Total: {{$student}} pesos</h2>
            <h2 style="margin-top:-3%;float:right;margin-right:20%">Batch {{$scholars->batch}}</h2>
        </div>
    </table>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title">Send Message</h4>
                    </center>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

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


    <script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    </script>

</body>

</html>