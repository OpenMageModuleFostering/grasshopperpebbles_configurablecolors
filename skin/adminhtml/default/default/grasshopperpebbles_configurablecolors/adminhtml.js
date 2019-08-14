jQuery.noConflict();
jQuery(document).ready(function($) {
	var v, tr, row;
	$("#color_map").hide();
	v = $.parseJSON($("#configurablecolors_color_options_color_map").val());
	//v = {"color_map":[{"Color Name":"24","Color Type":"color_hex","Color Value":"#CCCCCC"}]};
	if (v) {
		v = v.color_map;
		if (v != '') {
			$.each(v, function(i, itm) {
				tr = $("<tr></tr>");
				$("<td></td>").append(itm['color_name']).appendTo($(tr));
				$("<td></td>").append(itm['color_type']).appendTo($(tr));
				$("<td></td>").append(itm['color_value']).appendTo($(tr));
				$("<td></td>").append(
				$("<a></a>").attr("class", "configurable-color-row").html("Delete")).appendTo($(tr));
				$(tr).appendTo($('#configurable-color-table tbody'));
			});
			/*rows = v.split("~");
			$.each(rows, function(i, itm) {
				tr = $("<tr></tr>");
				row = $(itm).split(";");
				$.each(row, function(j, td) {
					$("<td></td>").append($(td)).appendTo($("tr"));
					$("<td></td>").append(
						$("<a></a>").attr({"id": "configurable-color-row-"+j, "class": "configurable-color-row"}).html("Delete")).appendTo($("tr"));
				});
			});*/
		}
	}
		
	$(".configurable-color-row").click(function() {
		$(this).parent().parent().remove();
		buildColorMap();
	});
		
	$("#configurable-color-add").click(function(e) {
		v = $("#configurable-color-value").val();
		if ($.trim(v) != "") {
			$("<tr></tr>").append(
				$("<td></td>").html($("#configurable-color-option").val()), 
				$("<td></td>").html($("#configurable-color-type").val()),
				$("<td></td>").html(v), 
				$("<td></td>").html($("<a></a>").attr("class", "configurable-color-row").html("Delete"))
				).appendTo($("#configurable-color-table"));
			buildColorMap();
		}
		e.preventDefault();
	});
	
	function buildColorMap() {
		$("#configurablecolors_color_options_color_map").val("");
		
		var ar = [];
		var ln, cells, header;
		var ctype = '';
		var $headers = $("#configurable-color-table th");
		var $rows = $("#configurable-color-table tbody tr").each(function(i) {
			cells = $(this).find("td");
			ln = $(cells).length;
			ar[i] = {};
			$(cells).each(function(ci) {
				if (ci < ln-1) {
					header = $($headers[ci]).html().toLowerCase();
					header = header.replace(" ","_"); 
					if (header == 'color_type') ctype = $(this).html();
					ar[i][header] = $(this).html();
					if (header == 'color_value') ar[i][ctype] = $(this).html();
				}
			});    
		});
		
		var obj = {};
		obj.color_map = ar;
		$("#configurablecolors_color_options_color_map").val(JSON.stringify(obj));
	}
});