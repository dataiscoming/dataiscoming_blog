function SendEvent(LINK, ELEMENT){
	// JS function to send information from a click to the the DB
	
	const event = 'hit';
	var link = LINK;
	var element = ELEMENT;
	var date = new Date();
	var day = date.getDate();
	var month = date.getMonth();
	var year = date.getFullYear();
	var hour = date.getHours();
	var minute = date.getMinutes();
	var second = date.getSeconds();
	var date2 = String(day)+':'+String(month+1)+':'+String(year);
	var time = String(hour)+':'+String(minute)+':'+String(second);
	var ID_session = /SESS\w*ID=([^;]+)/i.test(document.cookie) ? RegExp.$1 : false;
	
	// Log to test
	/*console.log('PHP click1:'.concat(ID_session));
	console.log('PHP click1:'.concat(link));	
	console.log('PHP click1:'.concat(event));
	console.log('PHP click1:'+date2);
	console.log('PHP click1:'+time);
	console.log('PHP click1:'.concat(element));*/
		
	$.post(
		'save_click.php', // URL to send the data
		{// data to send
		id_session : ID_session,
		event : event,
		date : date2,
		time : time,
		link : link, 
		element_event : element
		},
		return_string, // name of the result function
		'text' // Format of data received
		);

	//var strWindowFeatures = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
	
		function return_string(data_result){
			if(data_result.substring(0, 7) == "	Succes" & LINK != "https://github.com/dataiscoming"){
				alert('1'+data_result);
				window.location.replace(LINK);
			} else if(data_result.substring(0, 7) == "	Succes" & LINK == "https://github.com/dataiscoming"){
				alert('2'+data_result);
				//window.open(LINK,"CNN_WindowName", strWindowFeatures); //other solution
			} else if(data_result.substring(0, 7) == " Failed"){
				alert('2'+data_result)
				console.log(data_result);
			}
		}	
}