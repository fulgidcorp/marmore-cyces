<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Main Footer -->
<footer class="main-footer"> <strong>Copyright &copy; <?=date("Y")?>&nbsp;<a href="https://stagingmarmore.cyces.co/marmore/" target="_blank">Marmore MENA Intelligence</a></strong> All rights reserved. </footer>
<script type="text/javascript">
function validateNumbersOnly(e) 
{
	var unicode = e.charCode ? e.charCode : e.keyCode;
	
	if ((unicode == 8) || (unicode == 9) || (unicode > 47 && unicode < 58)||(unicode == 43)||(unicode == 45) ||(unicode == 188) ||(unicode == 189) ||(unicode == 32)) 
	{
		return true;
	}
	else 
	{
		//alert("This field accepts only Numbers");
		return false;
	}
}

</script>
