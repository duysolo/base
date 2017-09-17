document.createElement('section');
var duration = '450', easing = 'easeOutExpo';
hljs.initHighlightingOnLoad();

$(document).ready(function () {
    $('#tree_1').jstree({
        "core" : {
            "themes" : {
                "responsive": false
            }
        },
        "types" : {
            "default" : {
                "icon" : "fa fa-folder icon-state-warning icon-lg"
            },
            "file" : {
                "icon" : "fa fa-file icon-state-warning icon-lg"
            }
        },
        "plugins": ["types"]
    });

    // handle link clicks in tree nodes(support target="_blank" as well)
    $('#tree_1').on('select_node.jstree', function(e,data) {
        var link = $('#' + data.selected).find('a');
        if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
            if (link.attr("target") == "_blank") {
                link.attr("href").target = "_blank";
            }
            document.location.href = link.attr("href");
            return false;
        }
    });
});