
$( document ).ready(function() {
	$( "#resourcetype" ).change(function() {
		let val = $("#resourcetype").val() ;

		if (val == "all")
		{
			$(".ressource-card ").show();
		}
		else
		{
			$(".ressource-card ").hide();
			$(".ressource-card[data-type="+val+"]").show();
		}

	});
});
