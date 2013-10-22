$(document).ready(function() {
	var ajax = {
		initAjax: function(action, data, callback) {
			$.ajax({
				url: "index.php?action="+action,
				type: "POST",
				data: data,
				success: function(data) {
					callback(data, 'success');
				},
				error: function(data) {
					callback(data, 'error');
				}
			})
		},

		eventAjax: function(element, event, ajaxOpt) {
			element.on(event, function() {
				ajax.initAjax(ajaxOpt.action, ajaxOpt.data, ajaxOpt.callback);
			});
		},

        ajaxOpt: function(action, data, callback) {
            ajaxData = {
                action: action,
                data: data,
                callback: callback
            }

            return ajaxData;
        }
	};

	$('.action-form').each(function() {
		ajax.eventAjax($(this), 'click', ajax.ajaxOpt('action', {'method': $(this).val()}, function(data, status) {
                switch (status) {
                    case 'success':
                        console.log(data);
                        break;
                    case 'error':
                        console.log(data);
                        break;
                }
            }
        ));
	});
});