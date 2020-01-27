document.getElementById('otherInformation').style.display = 'none';
var flag=1;
function displayOtherInformation()
{ 	
	if( flag )
	{
		document.getElementById('otherInformation').style.display = '';
		flag=0;
	}
	else
	{
		document.getElementById('otherInformation').style.display = 'none';
		flag=1;
	}
}