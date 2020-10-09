
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

	let flip = true ;
	$("#mobile-search-btn").on("click", function() {
		$( "#mobile-search-bar" ).animate({ 'marginTop': flip ? '3.2em' : "0", opacity: 0.5 }, 500);
		flip = ! flip ;
	});
});
