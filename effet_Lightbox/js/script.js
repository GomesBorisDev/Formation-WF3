//appel jQuery
$(document).ready(function() {
    
    $(".flex").click(function(toto) {
        
        console.log(toto.target.getAttribute("src"));

        var srcImg = toto.target.getAttribute("src");
        
        $("#grandeImg").html(
        	"<figure><img src='" 
        	+ srcImg 
        	+ "' width='0'></figure>");
        $("#grandeImg").fadeIn("slow");
        $("#grandeImg img").animate({
        	width: "640px"
        });


        $("#grandeImg").on("click", function() {
        	$("#grandeImg img").animate({
        	width: "0px"});
            $("#grandeImg").fadeOut();
        })
    });  
// fin de jQuery
});






