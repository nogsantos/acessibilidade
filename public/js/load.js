$(function()
{
    // main menu -> submenus
    $('#menu .collapse').on('show', function()
    {
        $(this).parents('.hasSubmenu:first').addClass('active');
    })
            .on('hidden', function()
    {
        $(this).parents('.hasSubmenu:first').removeClass('active');
    });

    // main menu visibility toggle
    $('.navbar.main .btn-navbar').click(function(event)
    {
        event.preventDefault();

        $('.container-fluid:first').toggleClass('menu-hidden');
        $('#menu').toggleClass('hidden-phone');

        if (typeof masonryGallery != 'undefined')
            masonryGallery();
    });


    $('body').on('keyup.uppercase.data-api', ':input[data-uppercase]', function(event) {
        var textBox = event.target;
        var start = textBox.selectionStart;
        var end = textBox.selectionEnd;
        textBox.value = textBox.value.toUpperCase()
        textBox.setSelectionRange(start, end);
    })

    $('body').on('focus.alphanum.data-api', ':input[data-uppercase]', function(event) {
        var $this = $(this)

        if ($this.data('alphanum.loaded') === true)
            return;

        var json = {};
        try {
            json = jQuery.parseJSON($this.data('alphanum'))
        } catch (e) {

        }

        var alphanumCfg = (jQuery.isPlainObject(json) ? json : {allowOtherCharSets: false, allowCaseless: false, allowLatin: true})

        $this.alphanum(alphanumCfg).data('alphanum.loaded', true);
    });

    $("body").on("mouseout mouseover keydown load focus", function() {

        // tooltips
        var tip = $('[data-toggle="tooltip"],[title]').filter(function(i) {
            return (!$(this).data("tooltip-on") ? $(this).data("tooltip-on", true).get(0) : null);
        });

        if (tip.length > 0)
            tip.each(function(idx, el) {
                if ($(".modal").has(el).length == 0)
                    $(el).tooltip();
            });

        /*
         * UniformJS: Sexy form elements
         */
        var uniformjs = $('.uniformjs').filter(function(i) {
            return (!$(this).data("uniformjs-on") ? $(this).data("uniformjs-on", true).get(0) : null);
        });

        if (uniformjs.length > 0) {
            uniformjs.data('uniformjs-on', true);
            uniformjs.find("select, input, button, textarea").uniform();
        }


        $("[data-ui-datepicker]").filter(function(i) {
            return (!$(this).data("ui-datepicker-on") ? $(this).data("ui-datepicker-on", true).get(0) : null);
        }).each(function(i, el) {
            try {
                var data = eval("(" + $(el).data('uiDatepicker') + ")");
                $(el).datepicker(data);
            } catch (e) {

            }
        });

        $("[data-price-format]").filter(function(i) {
            return (!$(this).data("price-format-on") ? $(this).data("price-format-on", true).get(0) : null);
        }).each(function(i, el) {
            var data = {prefix: 'R$ ', centsSeparator: ',', thousandsSeparator: '.'}
            try {
                data = $.extend(eval("(" + $(el).data('priceFormat') + ")"), data)
            } catch (e) {

            }

            $(el).priceFormat(data);
        });

        $("[data-ui-datetimepicker]").filter(function(i) {
            return (!$(this).data("ui-datetimepicker-on") ? $(this).data("ui-datetimepicker-on", true).get(0) : null);
        }).each(function(i, el) {
            try {
                var data = $(el).data('uiDatetimepicker');

                if (typeof data != "object")
                    data = eval("(" + data + ")");

                $(el).parent().datetimepicker($.extend({}, data, {language: 'pt-BR'}));
            } catch (e) {
                //console.log(e)
            }
        });

        /* Desabilita os campos, conforme a regra de negócio */
        $("[data-disable-inputs]").filter(function(i) {
            return (!$(this).data("disable-inputs-on") ? $(this).data("disable-inputs-on", true).get(0) : null);
        }).on("change", function(event) {

            var inputs = $(this).data("disable-inputs");
            var value = this.value.length > 0 ? "disabled" : null;
            var container = ($(this).data("container") ? $(this).data("container") : "body").replace("{this}", "#" + $(this).attr("id"))

            $(inputs, container).each(function(i, el) {
                $(el).attr("disabled", value).val("");
            })

        })

        $("[data-enable-inputs]").filter(function(i) {
            return (!$(this).data("enable-inputs-on") ? $(this).data("enable-inputs-on", true).get(0) : null);
        }).on("change", function(event) {
            var inputs = $(this).data("enable-inputs");
            var value = ($(this).is(":radio") ? this.value == 1 : this.value.length > 0);
            var container = ($(this).data("container") ? $(this).data("container") : "body").replace("{this}", "#" + $(this).attr("id"))

            $(inputs).each(function(i, el) {
                if (value == true)
                    $(el, container).removeAttr("disabled").trigger('enableInput');
                else
                    $(el, container).attr("disabled", "disabled").trigger('disableInput');
            })

        })

        /* Remove o valor do campo, conforme a regra de negócio */
        $("[data-empty-inputs]").filter(function(i) {
            return (!$(this).data("empty-inputs-on") ? $(this).data("empty-inputs-on", true).get(0) : null);
        }).on("change", function(event) {
            var inputs = $(this).data("empty-inputs");
            var value = this.value.length > 0 ? true : false;
            var container = ($(this).data("container") ? $(this).data("container") : "body").replace("{this}", "#" + $(this).attr("id"))

            if (value === true) {
                $(inputs, container).each(function(i, el) {
                    if ($(el).is(":radio")) {
                        $(el).removeAttr("checked")
                    }
                    else {
                        $(el).val("");
                    }
                })
            }

        })

        $("[data-uf-municipio]").filter(function(i) {
            return (!$(this).data("uf-municipio-on") ? $(this).data("uf-municipio-on", true).get(0) : null);
        }).on("change", function(event) {
            var valor = this.value;
            var combo = this;
            var configs = ($(this).data("data-uf-municipio-config") ? $(this).data("data-uf-municipio-config") : {value: 'id_municipio', label: 'nm_municipio'})
            var container = ($(this).data("container") ? $(this).data("container") : "body").replace("{this}", "#" + $(this).attr("id"))
            
            if (valor.length > 0) {
                $($(combo).data("uf-municipio"), container).empty();
                $("<option>Carregando...</option>").appendTo($($(combo).data("uf-municipio"), container));

                $.getJSON([baseUrl, moduleName, 'estado-municipio', 'get-municipios', 'sigl_estado', valor, 'format', 'json'].join("/"), function(ret) {
                    montaComboOptions(ret.municipios, $($(combo).data("uf-municipio"), container), configs)
                });
            } else
                $($($(combo).data("uf-municipio"), container)).empty();

            return false;
        })

        $("[data-empty-table-rows]").filter(function(i) {
            return (!$(this).data("empty-table-rows-on") ? $(this).data("empty-table-rows-on", true).get(0) : null);
        }).on("change", function() {
            var inputs = $(this).data("empty-table-rows");
            var container = ($(this).data("container") ? $(this).data("container") : "body").replace("{this}", "#" + $(this).attr("id"))

            $(inputs).each(function(i, tb) {
                $("tbody", $(tb, container)).empty();
            })

        })

        $("[data-drop-table-rows]").filter(function(i) {
            return (!$(this).data("drop-table-rows-on") ? $(this).data("drop-table-rows-on", true).get(0) : null);
        }).on("click", function(event) {
            event.preventDefault();

            var configs = $.extend({keepFirstRow: true}, ($(this).data("drop-table-rows") ? $(this).data("drop-table-rows") : {}))
            var container = ($(this).data("container") ? $(this).data("container") : "body").replace("{this}", "#" + $(this).attr("id"))

            var tb = $("table", container).has(this).last();
            var tr = $("tbody tr", tb);


            if (tr.length == 1 && configs.keepFirstRow == true)
            {
                $(":input", tr.has(this).last()).val("");
                $(":input", tr.has(this).last()).change()
                return;
            }

            tr.has(this).last().remove();
        })

        $("[data-th-bt-clone]").filter(function(i) {
            return (!$(this).data("th-bt-clone-on") ? $(this).data("th-bt-clone-on", true).get(0) : null);
        }).on("click", function(event) {
            event.preventDefault();

            var tb = $("table").has(this).last();
            var firstTr = $("tbody tr:first", tb);
            var inputs = $(":input:enabled", firstTr);

            if (inputs.length == 0)
                return false;

            if ($("form").has(this).last().data("validator") && !inputs.valid())
                return false;

            var newTr = firstTr.clone()
            var newInputs = newTr.find(":input")
            newTr.prependTo(tb.find("tbody"))

            newTr.find("*").each(function(i, el) {
                var nEl = $(el);

                nEl.removeData()
                if (nEl.attr("id") && nEl.attr("id").length > 0)
                    nEl.attr("id", nEl.attr("id").replace(/[0-9]+/g, '') + ($("[id^=" + nEl.attr("id").replace(/-?[0-9]+/g, '') + "]").length - 1))

                if (nEl.attr("name") && nEl.attr("name").length > 0) {
                    if (nEl.attr("name").substr(-4).indexOf("[]") >= 0)
                        nEl.attr("name", nEl.attr("name").substr(0, nEl.attr("name").length - 2) + '[1]')
                    else {
                        var novoNumero = (parseInt(nEl.attr("name").substr(-3).replace(/[^0-9]+/g, '')) + 1);
                        if (!isNaN(novoNumero))
                            nEl.attr("name", nEl.attr("name").substr(0, nEl.attr("name").length - 3) + "[" + novoNumero + "]")
                    }
                }

                if (nEl.data("original-title"))
                    nEl.attr("title", nEl.data("original-title")).removeData("original-title")

                if (nEl.is(":input")) {
                    if ($(el).is(":radio"))
                        $(el).removeAttr("checked");
                    else
                        $(el).val("");
                }
            })

            //newInputs.val("")
            newInputs.change();
        })
    })


    if ($('.widget-activity').length)
        $('.widget-activity .filters .glyphicons').click(function(event)
        {
            event.preventDefault();

            $('.widget-activity .filters .active').toggleClass('active');
            $(this).toggleClass('active');
        });

    $(window).resize(function()
    {
        if (!$('#menu').is(':visible') && !$('.container-fluid:first').is('menu-hidden'))
            $('.container-fluid:first').addClass('menu-hidden');
    });

    $(window).resize();

    $('#footer [data-toggle="layout"]').not('[data-layout="fixed"]').parent().removeClass('active');
    $('#footer [data-toggle="layout"][data-layout="fixed"]').parent().addClass('active');

    $('#footer [data-toggle="layout"]').click(function()
    {
        if ($(this).parent().is('.active'))
            return;

        $('#footer [data-toggle="layout"]').not(this).parent().removeClass('active');
        $(this).parent().addClass('active');

        if ($(this).attr('data-layout') == 'fixed')
            $('.container-fluid:first').addClass('fixed');
        else
            $('.container-fluid:first').removeClass('fixed');

        if (typeof masonryGallery != 'undefined')
            masonryGallery();

    });

    /* wysihtml5 */
    if ($('textarea.wysihtml5').size() > 0)
        $('textarea.wysihtml5').wysihtml5();

    /* DataTables */
    if ($('.dynamicTable').size() > 0)
    {
        $('.dynamicTable').dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            }
        });
    }

    /*
     * Helper function for JQueryUI Sliders Create event
     */
    function JQSliderCreate()
    {
        $(this)
                .removeClass('ui-corner-all ui-widget-content')
                .wrap('<span class="ui-slider-wrap"></span>')
                .find('.ui-slider-handle')
                .removeClass('ui-corner-all ui-state-default');
    }

    /*
     * JQueryUI Slider: Default slider
     */
    if ($('.slider-single').size() > 0)
    {
        $(".slider-single").slider({
            create: JQSliderCreate,
            value: 10,
            animate: true,
            start: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.disable();
            },
            stop: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.enable();
            }
        });
    }

    /*
     * JQueryUI Slider: Multiple Vertical Sliders
     */
    $(".sliders-vertical > span").each(function()
    {
        var value = parseInt($(this).text(), 10);
        $(this).empty().slider({
            create: JQSliderCreate,
            value: value,
            range: "min",
            animate: true,
            orientation: "vertical",
            start: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.disable();
            },
            stop: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.enable();
            }
        });
    });

    /*
     * JQueryUI Slider: Range Slider
     */
    if ($('.range-slider').size() > 0)
    {
        $(".range-slider .slider").slider({
            create: JQSliderCreate,
            range: true,
            min: 0,
            max: 500,
            values: [75, 300],
            slide: function(event, ui) {
                $(".range-slider .amount").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
            },
            start: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.disable();
            },
            stop: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.enable();
            }
        });
        $(".range-slider .amount").val("$" + $(".range-slider .slider").slider("values", 0) +
                " - $" + $(".range-slider .slider").slider("values", 1));
    }

    /*
     * JQueryUI Slider: Snap to Increments
     */
    if ($('.increments-slider').size() > 0)
    {
        $(".increments-slider .slider").slider({
            create: JQSliderCreate,
            value: 100,
            min: 0,
            max: 500,
            step: 50,
            slide: function(event, ui) {
                $(".increments-slider .amount").val("$" + ui.value);
            },
            start: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.disable();
            },
            stop: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.enable();
            }
        });
        $(".increments-slider .amount").val("$" + $(".increments-slider .slider").slider("value"));
    }

    /*
     * JQueryUI Slider: Vertical Range Slider
     */
    if ($('.vertical-range-slider').size() > 0)
    {
        $(".vertical-range-slider .slider").slider({
            create: JQSliderCreate,
            orientation: "vertical",
            range: true,
            min: 0,
            max: 500,
            values: [100, 400],
            slide: function(event, ui) {
                $(".vertical-range-slider .amount").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
            },
            start: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.disable();
            },
            stop: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.enable();
            }
        });
        $(".vertical-range-slider .amount").val("$" + $(".vertical-range-slider .slider").slider("values", 0) +
                " - $" + $(".vertical-range-slider .slider").slider("values", 1));
    }

    /*
     * JQueryUI Slider: Range fixed minimum
     */
    if ($('.slider-range-min').size() > 0)
    {
        $(".slider-range-min .slider").slider({
            create: JQSliderCreate,
            range: "min",
            value: 150,
            min: 1,
            max: 700,
            slide: function(event, ui) {
                $(".slider-range-min .amount").val("$" + ui.value);
            },
            start: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.disable();
            },
            stop: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.enable();
            }
        });
        $(".slider-range-min .amount").val("$" + $(".slider-range-min .slider").slider("value"));
    }

    /*
     * JQueryUI Slider: Range fixed maximum
     */
    if ($('.slider-range-max').size() > 0)
    {
        $(".slider-range-max .slider").slider({
            create: JQSliderCreate,
            range: "max",
            min: 1,
            max: 700,
            value: 150,
            slide: function(event, ui) {
                $(".slider-range-max .amount").val("$" + ui.value);
            },
            start: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.disable();
            },
            stop: function() {
                if (typeof mainYScroller != 'undefined')
                    mainYScroller.enable();
            }
        });
        $(".slider-range-max .amount").val("$" + $(".slider-range-max .slider").slider("value"));
    }

    /*
     * Boostrap Extended
     */
    // custom select for Boostrap using dropdowns
    $('.selectpicker').selectpicker();

    // bootstrap-toggle-buttons
    $('.toggle-button').toggleButtons();

    // colorpicker
    if ($('#colorpicker').size() > 0)
    {
        $('#colorpicker').farbtastic('#colorpickerColor');
    }
//    // datepicker
//    if ($('#datepicker').length)
//    {
//        $("#datepicker").datepicker({
//            showOtherMonths: true
//        });
//    }
//    if ($('#datepicker-inline').length)
//    {
//        $('#datepicker-inline').datepicker({
//            inline: true,
//            showOtherMonths: true
//        });
//    }

    // bookings daterange
    if ($('#dateRangeFrom').length && $('#dateRangeTo').length)
    {
        $("#dateRangeFrom").datepicker({
            defaultDate: "+1w",
            changeMonth: false,
            numberOfMonths: 2,
            onClose: function(selectedDate) {
                $("#dateRangeTo").datepicker("option", "minDate", selectedDate);
            }
        }).datepicker("option", "maxDate", $('#dateRangeTo').val());

        $("#dateRangeTo").datepicker({
            defaultDate: "+1w",
            changeMonth: false,
            numberOfMonths: 2,
            onClose: function(selectedDate) {
                $("#dateRangeFrom").datepicker("option", "maxDate", selectedDate);
            }
        }).datepicker("option", "minDate", $('#dateRangeFrom').val());
    }

    $('.checkboxs thead :checkbox').change(function() {
        if ($(this).is(':checked'))
        {
            $('.checkboxs tbody :checkbox').prop('checked', true).parent().addClass('checked');
            $('.checkboxs tbody tr.selectable').addClass('selected');
            $('.checkboxs_actions').show();
        }
        else
        {
            $('.checkboxs tbody :checkbox').prop('checked', false).parent().removeClass('checked');
            $('.checkboxs tbody tr.selectable').removeClass('selected');
            $('.checkboxs_actions').hide();
        }
    });

    $('.checkboxs tbody').on('click', 'tr.selectable', function(e) {
        var c = $(this).find(':checkbox');
        var s = $(e.srcElement);

        if (e.srcElement.nodeName == 'INPUT')
        {
            if (c.is(':checked'))
                $(this).addClass('selected');
            else
                $(this).removeClass('selected');
        }
        else if (e.srcElement.nodeName != 'TD' && e.srcElement.nodeName != 'TR' && e.srcElement.nodeName != 'DIV')
        {
            return true;
        }
        else
        {
            if (c.is(':checked'))
            {
                c.prop('checked', false).parent().removeClass('checked');
                $(this).removeClass('selected');
            }
            else
            {
                c.prop('checked', true).parent().addClass('checked');
                $(this).addClass('selected');
            }
        }
        if ($('.checkboxs tr.selectable :checked').size() == $('.checkboxs tr.selectable :checkbox').size())
            $('.checkboxs thead :checkbox').prop('checked', true).parent().addClass('checked');
        else
            $('.checkboxs thead :checkbox').prop('checked', false).parent().removeClass('checked');

        if ($('.checkboxs tr.selectable :checked').size() >= 1)
            $('.checkboxs_actions').show();
        else
            $('.checkboxs_actions').hide();
    });

    if ($('.checkboxs tbody :checked').size() == $('.checkboxs tbody :checkbox').size() && $('.checkboxs tbody :checked').length)
        $('.checkboxs thead :checkbox').prop('checked', true).parent().addClass('checked');

    if ($('.checkboxs tbody :checked').length)
        $('.checkboxs_actions').show();

    $('.radioboxs tbody tr.selectable').click(function(e) {
        var c = $(this).find(':radio');
        if (e.srcElement.nodeName == 'INPUT')
        {
            if (c.is(':checked'))
                $(this).addClass('selected');
            else
                $(this).removeClass('selected');
        }
        else if (e.srcElement.nodeName != 'TD' && e.srcElement.nodeName != 'TR')
        {
            return true;
        }
        else
        {
            if (c.is(':checked'))
            {
                c.attr('checked', false);
                $(this).removeClass('selected');
            }
            else
            {
                c.attr('checked', true);
                $('.radioboxs tbody tr.selectable').removeClass('selected');
                $(this).addClass('selected');
            }
        }
    });

    // sortable tables
    if ($(".js-table-sortable").length)
    {
        $(".js-table-sortable").sortable(
                {
                    placeholder: "ui-state-highlight",
                    items: "tbody tr",
                    handle: ".js-sortable-handle",
                    forcePlaceholderSize: true,
                    helper: function(e, ui)
                    {
                        ui.children().each(function() {
                            $(this).width($(this).width());
                        });
                        return ui;
                    },
                    start: function(event, ui)
                    {
                        if (typeof mainYScroller != 'undefined')
                            mainYScroller.disable();
                        ui.placeholder.html('<td colspan="' + $(this).find('tbody tr:first td').size() + '">&nbsp;</td>');
                    },
                    stop: function() {
                        if (typeof mainYScroller != 'undefined')
                            mainYScroller.enable();
                    }
                });
    }
});