<html>
<head>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<style>
body {
    margin-top: 20px;
}
</style>
<body>
<div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>Pranjetto Hills Resort</strong>
                        <br>
                        
                        <br>
                        
                        <br>
                        
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: {{date("M d, Y")}}</em>
                    </p>
                    <p>
                        <em>Receipt #: {{$data->reservation_code}}</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>#</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9"><em>{{$data->category}}</em></h4></td>
                            <td class="col-md-1" style="text-align: center"> {{$data->quantity}} </td>
                            <td class="col-md-1 text-center">₱{{$data->total_price}}</td>
                            <td class="col-md-1 text-center">₱{{$data->total_price}}</td>
                        </tr>
            
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            
                            
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>₱{{$data->total_price}}</strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $( document ).ready(function() {
            window.print();
        });
    </script>
    </body>
    </html>