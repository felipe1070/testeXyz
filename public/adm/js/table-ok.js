  jQuery(document).ready(function() {
    
	  
	  
	  
	  
	  
    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers",
      "oLanguage": {
          "sSearch": "Pesquisar",
          "sLengthMenu": "Quantidade _MENU_ ",
          "sZeroRecords": "Nenhum Registro encontrado",
          "sInfo": "Exibindo de _START_ a _END_ dos _TOTAL_ registros",
          "sInfoEmpty": "Exibindo de 0 a 0 de 0 registros",
          "sInfoFiltered": "(Filtrada a partir de _MAX_ registros totais)",
          "oPaginate": {
              "sFirst": "Primeira",
              "sLast": "Última",
              "sPrevious": "Anterior",
              "sNext": "Próxima"
          }
      }
    });
    
    
    
    $('.tel').focusout(function(){
	    var phone, element;
	    element = $(this);
	    element.unmask();
	    phone = element.val().replace(/\D/g, '');
	    if(phone.length > 10) {
	        element.mask("(99) 99999-999?9");
	    } else {
	        element.mask("(99) 9999-9999?9");
	    }
	}).trigger('focusout');

    
  });