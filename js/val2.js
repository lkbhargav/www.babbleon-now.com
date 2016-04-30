function numver()
{
    var pnu = document.rff.number.value;
    var nums = ["0","1","2","3","4","5","6","7","8","9"];
    var em = pnu.split("");
		
		var dot = 0;
		
		for (var j = 0; j < em.length; j++)
		{
			for (var i = 0; i < 10; i++) {
		    	if(em[j] == nums[i])
		    	{
		    		dot++;
		    	}
			}
		}
    
    if(dot == 10)
    {
        return true;
	}
	else
	{
        document.getElementById("error3").innerHTML = "Invalid Phone number";
        return false;
    }
}