// <![CDATA[
jQuery(document).ready(function($)
{
	$("input#submit").click(function()
	{
		if ($("#author").attr("id"))
		{
			str_name = $("#author").val();

			if (!str_name)
			{
				return show_error("Informe seu nome...");
			}
			else
			{
				str_mail = $("#email").val();
			
				if (str_name.length < 3)
					return show_error("Informe seu email...");
			
				if (!RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/).test(str_mail))
					return show_error("Informe um email válido!");
			}
		}
		
		str = $("textarea").val();
		
		if (str.length < 5)
			return show_error("Digite seu comentário antes de enviar...");
			
		return true;
	});
	
	function show_error(str)
	{
		$("#commentform p.error").remove();
	
		$("#commentform").prepend('<p class="error"></p>');
		$("#commentform p.error").html(str);
		
		setTimeout(function()
		{
			$("#commentform p.error").fadeOut(500);
		}, 2000);
		
		return false;
	}
});
// ]]>