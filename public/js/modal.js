(function ($) {
    $(document).ready(function ($) {
        var $body = $("body");

        // Modal, AJAX handling.
        $body
            .on("click", "[data-type=modal]", function (e) {
                e.preventDefault();

                var $target, $this = $(this),
                    href = $this.data("href") || $(this).attr("href");

                if ($this.data("target")) {
                    $target = $($this.data("target"));
                } else {
                    $target = $("#hd_modal");
                }

                $.ajax({
                    async: true,
                    type: 'GET',
                    url: href,
                    success: function (data) {
                        $target.find(".modal-content").html(data);
                        $target.modal();
                    }
                });
            })
            .on("click", "[data-type=ajax]", function (e) {
                e.preventDefault();
                var $this = $(this),
                    href = $this.data("href") || $this.attr("href"),
                    callback = $this.data("callback");

                $.ajax({
                    async: true,
                    type: 'GET',
                    dataType: "json",
                    url: href,
                    success: function (data) {
                        if (data.hide != undefined) {
                            $("#hd_modal").modal('hide');
                        }
                        if (data.status == 1) {

                            if (data.route) {
                                updateContent(data.route, data.selector);
                            }

                            if (data.reload) {
                                document.location.reload();
                            }
                        }
                    }
                });
            })
            .on("submit", "form.form-ajax", function (e) {
                e.preventDefault();
                var $this = $(this);

                $this.ajaxSubmit({
                    target: $this.data("target") || null,
                    success: function (data, status, $form) {
                        console.log(data);
                        if (typeof data == 'object') {
                            if (data.status == 1) {
                                 $("#hd_modal").modal('hide');

                                console.log(data);

                                if (data.route) {
                                    updateContent(data.route);
                                }

                                if (data.reload) {
                                    document.location.reload();
                                }
                            }
                        }
                    },
                    error: function (xhr, status, $form) {
                        var error = jQuery.parseJSON(xhr.responseText);

                        $.each(error, function(key, value) {
                            var $input = $this.find("input[name='"+key+"']");

                            if ($input.length) {
                                var $formGroup = $input.closest(".form-group");

                                if ($formGroup.length) {
                                    var $formField = $formGroup.children("div");

                                    if ($formField.length) {
                                        $formGroup.addClass("has-error");
                                        $formField.append('<span class="help-block"><strong>'+value+'</strong></span>');
                                    }
                                }
                            }
                        });
                    }
                });
            });
    });
})(jQuery);

/**
 * Update url
 * @param base
 * @param containerSelector
 */
function updateContent(base, containerSelector) {
    $.ajax({
        async: true,
        type: 'GET',
        url: base + document.location.search,
        success: function (data) {
            $(containerSelector || "#main-content").html(data);
        }
    });
}