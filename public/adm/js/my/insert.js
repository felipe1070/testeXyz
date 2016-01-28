$().ready(function(){
	
	
	
	var numero = 0;
	
	
	
	$("#new_help").click(function(){
		
		var help = $("#div_perguntas").clone();
		
		help.removeAttr("id");
		help.find("div").find("div").find(".hide_perguntas").val(numero);
		help.find("div").find("div").find(".verificar").addClass("verificacao");
		help.appendTo("#div_insert");
		numero++;
	});
	
	$(".btn_resposta").live("click",function(){
		
		var n = $(this).parent().siblings(".hide_perguntas").val();
		
		var resposta = $("#div_respostas").clone();
		resposta.removeAttr("id");
		resposta.find("div").find("div").find(".hide_respostas").val(n);
		resposta.find("div").find("div").find(".verificar").addClass("verificacao");
		resposta.appendTo($(this).parent().parent().parent());
		
	});
	
	$(".btn_remove").live("click", function(){
		
		$(this).parent().parent().parent().parent().remove();
		
	});
	
	$("form").submit(function(){
		
		var vali = true;
		
		$(".verificacao").each(function(){
			
			var string  = trim($(this).val());
			if(string.length == 0){
				vali = false;
			}
		});
		
		
		if(!vali){
			$("#ModalVeri").modal("show");
			return false;
		}
		
		
		
	});
	
	function trim(vlr) {

		while(vlr.indexOf(" ") != -1)
		 vlr = vlr.replace(" ", "");
		return vlr;
	}
	
	
});