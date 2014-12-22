var config_url = $('#config_url').val();
var airline_id = $('#airline_id').val();

var booking_result = [], payment_result = [], flight_type_result = [];

//get the current month
var curr = new Date();
var day = curr.getDate();
var curr_month = curr.getMonth()+1;
var year = curr.getFullYear();
var first_month = parseInt(curr_month) - 11;
	
//get booking data for the last 12 months
for(r = parseInt(first_month); r <= parseInt(curr_month); r++)
{
	//approved
	url = config_url+"airline/account/get_bookings_in_month/"+r+"/"+airline_id;
	//alert(url);
	$.ajax({
		type:'POST',
		url: url,
		cache:false,
		contentType: false,
		processData: false,
		async: false,
		dataType: "json",
		success:function(data){
			
			var return_data = 
			{
				month: year+'-'+r,
				Approved: data.approved_bookings,
				Pending: data.pending_bookings,
				Disapproved: data.disapproved_bookings,
			}
			
			//add the data to the array
			booking_result.push(return_data);
			/*student.push([current_timestamp, data.student]);
			insurance.push([current_timestamp, data.insurance]);
			other.push([current_timestamp, data.other]);*/
		},
		error: function(xhr, status, error) {
			alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
		}
	});
}
	
//get payment data for the last 12 months
for(r = parseInt(first_month); r <= parseInt(curr_month); r++)
{
	//approved
	url = config_url+"airline/account/get_payments_in_month/"+r+"/"+airline_id;
	//alert(url);
	$.ajax({
		type:'POST',
		url: url,
		cache:false,
		contentType: false,
		processData: false,
		async: false,
		dataType: "json",
		success:function(data){
			
			var return_data = 
			{
				y: year+'-'+r,
				a: data.received_payments,
				b: data.pending_payments,
			}
			
			//add the data to the array
			payment_result.push(return_data);
			/*student.push([current_timestamp, data.student]);
			insurance.push([current_timestamp, data.insurance]);
			other.push([current_timestamp, data.other]);*/
		},
		error: function(xhr, status, error) {
			alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
		}
	});
}

//flight type data
url = config_url+"airline/account/get_flight_type_totals/"+airline_id;
//alert(url);
$.ajax({
	type:'POST',
	url: url,
	cache:false,
	contentType: false,
	processData: false,
	async: false,
	dataType: "json",
	success:function(data){
		
		flight_type_result = [{
            label: "Empty Leg",
            value: parseInt(data.empty_leg)
        }, {
            label: "Exclusive Charter",
            value: parseInt(data.exclusive_charter)
        }, {
            label: "Private Plane",
            value: parseInt(data.private_plane)
        }]
	},
	error: function(xhr, status, error) {
		alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
	}
});

$(function() {

    Morris.Area({
        element: 'morris-area-chart',
		data: booking_result,
		/*data: [
			{ year: '2008', value: 20 },
			{ year: '2009', value: 10 },
			{ year: '2010', value: 5 },
			{ year: '2011', value: 5 },
			{ year: '2012', value: 20 }
		],
        data: [{
            month: '2014-01',
            Approved: 2666,
            Pending: null,
            Disapproved: 2647
        }, {
            month: '2014-02',
            Approved: 2778,
            Pending: 2294,
            Disapproved: 2441
        }, {
            month: '2014-03',
            Approved: 4912,
            Pending: 1969,
            Disapproved: 2501
        }, {
            month: '2014-04',
            Approved: 3767,
            Pending: 3597,
            Disapproved: 5689
        }, {
            month: '2014-05',
            Approved: 6810,
            Pending: 1914,
            Disapproved: 2293
        }],*/
		
	  xLabelFormat: function (x) {
			  var IndexToMonth = [ "Jan", "Feb", "Mär", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
			  var month = IndexToMonth[ new Date(x).getMonth() ];
			  var year = new Date(x).getFullYear();
			  //return year + ' ' + month;
			  return month;
		  },
        xkey: 'month',
        ykeys: ['Approved', 'Pending', 'Disapproved'],
        labels: ['Approved', 'Pending', 'Disapproved'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });
	
    /*Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            Approved: 2666,
            Pending: null,
            Disapproved: 2647
        }, {
            period: '2010 Q2',
            Approved: 2778,
            Pending: 2294,
            Disapproved: 2441
        }, {
            period: '2010 Q3',
            Approved: 4912,
            Pending: 1969,
            Disapproved: 2501
        }, {
            period: '2010 Q4',
            Approved: 3767,
            Pending: 3597,
            Disapproved: 5689
        }, {
            period: '2011 Q1',
            Approved: 6810,
            Pending: 1914,
            Disapproved: 2293
        }, {
            period: '2011 Q2',
            Approved: 5670,
            Pending: 4293,
            Disapproved: 1881
        }, {
            period: '2011 Q3',
            Approved: 4820,
            Pending: 3795,
            Disapproved: 1588
        }, {
            period: '2011 Q4',
            Approved: 15073,
            Pending: 5967,
            Disapproved: 5175
        }, {
            period: '2012 Q1',
            Approved: 10687,
            Pending: 4460,
            Disapproved: 2028
        }, {
            period: '2012 Q2',
            Approved: 8432,
            Pending: 5713,
            Disapproved: 1791
        }],
        xkey: 'period',
        ykeys: ['Approved', 'Pending', 'Disapproved'],
        labels: ['Approved', 'Pending', 'Disapproved'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });*/

    Morris.Donut({
        element: 'morris-donut-chart',
        data: flight_type_result,
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
		data: payment_result,
        /*data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],*/
		
	  	/*xLabelFormat: function (x) {
			  var IndexToMonth = [ "Jan", "Feb", "Mär", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
			  var month = IndexToMonth[ new Date(x).getMonth() ];
			  var year = new Date(x).getFullYear();
			  //return year + ' ' + month;
			  return month;
		},*/
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Received', 'Pending'],
        hideHover: 'auto',
        resize: true
    });

});
