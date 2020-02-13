<div class="section py-4 background-dark over-hide footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-6 text-center text-md-left mb-2 mb-md-0">
					<p>2019 © Pranjetto. All rights reserved.</p>
				</div>
				<div class="col-md-6 text-center text-md-right">
					<a href="#" class="social-footer-bottom">facebook</a>
				</div>
			</div>	
		</div>		
	</div>

<script src="{{asset('mainpage/js/jquery.min.js')}}"></script>
<script src="{{asset('mainpage/js/popper.min.js')}}"></script> 
<script src="{{asset('mainpage/js/bootstrap.min.js')}}"></script>
<script src="{{asset('mainpage/js/plugins.js')}}"></script>
<script src="{{asset('mainpage/js/flip-slider.js')}}"></script>  
<script src="{{asset('mainpage/js/reveal-home.js')}}"></script>  
<script src="{{asset('mainpage/js/custom.js')}}"></script>
<!-- Sweet Alert -->
<script src="{{asset('admin/sweetalert/sweetalert2.all.min.js')}}"></script>

<script
    src="https://www.paypal.com/sdk/js?client-id=AaWomyWApp2CSSRxaYDKxrQe8ND-aemP7gnAKJWjOAzNFnHg5giEoaIwtpO-2Z8tMGg4V3vTIXb1yRpv&disable-funding=credit,card"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>

<script>
	
$(function(){
		
		var room_id = $('#room_id').val();

		$.ajax({
			url: '{{route("disablecheckin")}}',
			type: 'GET',
			data: {
				room_id: room_id
			},
			dataType: 'HTML',
			success: function(response){

				if(response == 0){
					$('#startDate').datepicker({
						format: 'yyyy-mm-dd',
						autoclose: true,
						startDate: 'now'
					})
				}
				else{
					var DatesforDisable = [];
					
					var data = JSON.parse(response);

					var x = 0;
					
					for(x; x < data.length; x++){
						
						var y = data[x].split("-");
						DatesforDisable[x] = y[0] + "-" + y[1] + "-" + y[2];
					}

					$('#startDate').datepicker({
						format: 'yyyy-mm-dd',
						autoclose: true,
						startDate: 'now',
						datesDisabled: DatesforDisable
					})
				}
			}
		})	
	});

	$(function(){

		$('#start1').datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
			startDate: 'now'
			
		})
		
	});

	$('#start1').change(function(e){

		var start = $('#start1').val();
		
		$.ajax({
			url: '{{route("Addoneday")}}',
			type: 'GET',
			data: {
				start: start
			},
			dataType: 'HTML',
			success: function(response){
					var DatesforDisable = [];
					
					var data = JSON.parse(response);

					var x = 0;
					
					for(x; x < data.length; x++){
						
						var y = data[x].split("-");
						DatesforDisable[x] = y[0] + "-" + y[1] + "-" + y[2];
					}

				$('#end1').prop("disabled", false);
				$('#end1').datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true,
					startDate: 'now',
					datesDisabled: DatesforDisable
				})
			}
		})
	})

	$('#startDate').change(function(e){

		var room_id = $('#room_id').val();
		var check_in = $('#startDate').val();
		
		
		$.ajax({
            url: '{{route("disableforcheckout")}}',
            type: 'GET',
            data: {
                room_id: room_id,
                check_in: check_in
            },
            dataType: 'HTML',
            success: function(response){

				$('#endDate').prop("disabled", false);
				
				
				var DatesforDisable = [];
					
				var data = JSON.parse(response);

				var x = 0;
					
				for(x; x < data.length; x++){
						
					var y = data[x].split("-");
					DatesforDisable[x] = y[0] + "-" + y[1] + "-" + y[2];
				}
				
				$('#endDate').datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true,
					startDate: check_in,
					datesDisabled: DatesforDisable
				})
            }
        })
	})

	$('#no_of_persons').change(function(e){

		var capacity = $('#capacity').val();
		var cpcty = $('#no_of_persons').val();

		if(capacity == cpcty){
			$('#extra_mattress').prop("disabled", false);
		}
		else{
			$('#extra_mattress').prop("disabled", true);
		}
	})

	$('.roomonlinereserve').click(function(e){

		var persons = $('#no_of_persons').val();
		var room_id = $('#room_id').val();
		var fix_price = $('#fix_price').val();
		var quantity = $('#quantity').val();
		var start_date = $('#startDate').val();
		var end_date = $('#endDate').val();
		var extra_mattress = $('#extra_mattress').val();
		
		if(start_date == "" || end_date == "" || persons == 0 || quantity == 0 || extra_mattress < 0){
			alert("please fill out necessary details");
		}
		else{
			$.ajax({
                url: '{{route("GetRoomTotalPrice")}}',
                type: 'GET',
                data: {
                    room_id: room_id,
					fix_price: fix_price,
					quantity: quantity,
                    start_date: start_date,
                    end_date: end_date,
                    extra_mattress: extra_mattress
                },
                dataType: 'HTML',
                success: function(response){

                    document.getElementById("tot_price").innerHTML = "₱" + response;
                    document.getElementById("total_price").value = response;
                }
			});
			document.getElementById("totalperson").innerHTML = persons;
			document.getElementById("out_check").innerHTML = end_date;
			document.getElementById("in_check").innerHTML = start_date;
			document.getElementById("qty").innerHTML = quantity;
			document.getElementById("mattress_extra").innerHTML = extra_mattress;
			$('#exampleModal').modal('show')
		}
		
	});

	$('#sbmtOnlineReservation').click(function(e){

		var room_id = $('#room_id').val();
		var total_price = $('#total_price').val();
		var quantity = $('#quantity').val();
		var extra_mattress = $('#extra_mattress').val();
		var user_id = $('#user_id').val();
		var persons = $('#no_of_persons').val();
		var check_in = $('#startDate').val();
		var check_out = $('#endDate').val();
		var email = $('#email').val();
		
		$('#exampleModal').modal("hide");

		$.ajax({
			url: '{{route("NewOnlineRoomReservation")}}',
			type: 'GET',
			data: {
				room_id: room_id,
				total_price: total_price,
				user_id: user_id,
				quantity: quantity,
				extra_mattress: extra_mattress,
				persons: persons,
				check_in: check_in,
				check_out: check_out,
				email: email
			},
			dataType: 'HTML',
			success: function(response){

				Swal.fire({
                    title: "Success!",
                    text: "Please check your email for further instructions about your payment",
                    icon: 'success', 
                    type: "success"
                })
                .then(function(){
                    location.reload();
                });
			}
		})

	});
	paypal.Buttons({
    createOrder: function(data, actions) {
      var test = $('#total_price').val();
	  test = test * 0.5;
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: test,
			currency: 'PHP'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
		$('#exampleModal').modal("hide");
        var room_id = $('#room_id').val();
		var total_price = $('#total_price').val();
		var user_id = $('#user_id').val();
		var quantity = $('#quantity').val();
		var extra_mattress = $('#extra_mattress').val();
		var persons = $('#no_of_persons').val();
		var check_in = $('#startDate').val();
		var check_out = $('#endDate').val();
		var email = $('#email').val();
		
		$.ajax({
			url: '{{route("NewOnlineRoomReservationPaypal")}}',
			type: 'GET',
			data: {
				room_id: room_id,
				total_price: total_price,
				user_id: user_id,
				quantity: quantity,
				extra_mattress: extra_mattress,
				persons: persons,
				check_in: check_in,
				check_out: check_out,
				email: email
			},
			dataType: 'HTML',
			success: function(response){

				Swal.fire({
                    title: "Success!",
                    text: "Payment Successful!",
                    icon: 'success', 
                    type: "success"
                })
                .then(function(){
                    location.reload();
                });
			}
		})

      });
    }
  }).render('#paypal-button');

	
</script>

</body>
</html>