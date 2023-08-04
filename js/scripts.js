jQuery(document).ready(function ($) {
    if ($("#keyword").length > 0) {
        search();
    }
    if ($("#btn-search").length > 0) {
        $("#btn-search").on('click', function () {
            search(jQuery("#keyword").val(), 1);
        });
    }

    $('#view').on('click', '.pagination a', function (e) {
        e.preventDefault()
        const data = new URLSearchParams($(this).data('searchpagination'));
        search(data.get('keyword'), data.get('page'));
    });
});
function search(keyword = "", page = 1) {
    $(this).html("SEARCHING...").attr("disabled", "disabled");
    jQuery.ajax({
        url: 'includes/search.php',
        type: 'POST',
        data: {keyword: keyword ?? jQuery("#keyword").val(), page: page},
        dataType: "json",
        beforeSend: function (e) {
            if (e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function (response) {
            jQuery("#btn-search").html("SEARCH").removeAttr("disabled");
            jQuery("#view").html("");
            jQuery("#view").html(response.result);
            jQuery("#view button.sendPoke").unbind('click');
            jQuery("#view button.sendPoke").bind('click', function () {
                sendPoke(jQuery(this).data('poketo'));
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.responseText);
        }
    });
}

function sendPoke(to_uid) {
    jQuery.ajax({
        type: "POST",
        url: 'includes/ajax.php?action=sendpoke',
        data: {
            to_uid: to_uid
        },
        dataType: 'json',
        success: function (data) {
            if (data.status === true) {
                search();
            } else {
                // fail
            }
        },
        error: function () {
            // fail
        }
    });
}

