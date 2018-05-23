
function rendertableClicks()
{
	$.ajax({
		type: "POST",
		url: "/click/list",
		data: {
			_csrf: yii.getCsrfToken(),
		},
		
		success: function(response) {
			var options = {
				valueNames: [ 'id', 'ua', 'ip', 'ref', 'param1', 'param2'],
				item: '<tr><td class="id"></td><td class="ua"></td><td class="ip"></td><td class="ref"><td class="param1"></td><td class="param2"></td></tr>'
			};
			
			var userList = new List('clicks', options, response);
		}
	});
}

rendertableClicks();