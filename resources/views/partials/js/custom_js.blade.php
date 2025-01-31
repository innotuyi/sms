<script>
    function getLGA(state_id) {
        var url = '{{ route('get_lga', [':id']) }}';
        url = url.replace(':id', state_id);
        var lga = $('#lga_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function(resp) {
                //console.log(resp);
                lga.empty();
                $.each(resp, function(i, data) {
                    lga.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }

    function getClassSections(class_id, destination) {
        var url = '{{ route('get_class_sections', [':id']) }}';
        url = url.replace(':id', class_id);
        var section = destination ? $(destination) : $('#section_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function(resp) {
                //console.log(resp);
                section.empty();
                $.each(resp, function(i, data) {
                    section.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }

    function getClassSubjects(class_id) {
        var url = '{{ route('get_class_subjects', [':id']) }}';
        url = url.replace(':id', class_id);
        var section = $('#section_id');
        var subject = $('#subject_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function(resp) {
                console.log(resp);
                section.empty();
                subject.empty();
                $.each(resp.sections, function(i, data) {
                    section.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });
                $.each(resp.subjects, function(i, data) {
                    subject.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }


    {{-- Notifications --}}

    @if (session('pop_error'))
        pop({
            msg: '{{ session('pop_error') }}',
            type: 'error'
        });
    @endif

    @if (session('pop_warning'))
        pop({
            msg: '{{ session('pop_warning') }}',
            type: 'warning'
        });
    @endif

    @if (session('pop_success'))
        pop({
            msg: '{{ session('pop_success') }}',
            type: 'success',
            title: 'GREAT!!'
        });
    @endif

    @if (session('flash_info'))
        flash({
            msg: '{{ session('flash_info') }}',
            type: 'info'
        });
    @endif

    @if (session('flash_success'))
        flash({
            msg: '{{ session('flash_success') }}',
            type: 'success'
        });
    @endif

    @if (session('flash_warning'))
        flash({
            msg: '{{ session('flash_warning') }}',
            type: 'warning'
        });
    @endif

    @if (session('flash_error') || session('flash_danger'))
        flash({
            msg: '{{ session('flash_error') ?: session('flash_danger') }}',
            type: 'danger'
        });
    @endif

    {{-- End Notifications --}}

    function pop(data) {
        swal({
            title: data.title ? data.title : 'Oops...',
            text: data.msg,
            icon: data.type
        });
    }

    function flash(data) {
        new PNotify({
            text: data.msg,
            type: data.type,
            hide: data.type !== "danger"
        });
    }

    function confirmDelete(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this item!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(function(willDelete) {
            if (willDelete) {
                $('form#item-delete-' + id).submit();
            }
        });
    }

    function confirmReset(id) {
        swal({
            title: "Are you sure?",
            text: "This will reset this item to default state",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(function(willDelete) {
            if (willDelete) {
                $('form#item-reset-' + id).submit();
            }
        });
    }

    $('form#ajax-reg').on('submit', function(ev) {
        ev.preventDefault();
        submitForm($(this), 'store');
        $('#ajax-reg-t-0').get(0).click();
    });

    $('form.ajax-pay').on('submit', function(ev) {
        ev.preventDefault();
        submitForm($(this), 'store');

        //        Retrieve IDS
        var form_id = $(this).attr('id');
        var td_amt = $('td#amt-' + form_id);
        var td_amt_paid = $('td#amt_paid-' + form_id);
        var td_bal = $('td#bal-' + form_id);
        var input = $('#val-' + form_id);

        // Get Values
        var amt = parseInt(td_amt.data('amount'));
        var amt_paid = parseInt(td_amt_paid.data('amount'));
        var amt_input = parseInt(input.val());

        //        Update Values
        amt_paid = amt_paid + amt_input;
        var bal = amt - amt_paid;

        td_bal.text('' + bal);
        td_amt_paid.text('' + amt_paid).data('amount', '' + amt_paid);
        input.attr('max', bal);
        bal < 1 ? $('#' + form_id).fadeOut('slow').remove() : '';
    });

    $('form.ajax-store').on('submit', function(ev) {
        ev.preventDefault();
        submitForm($(this), 'store');
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });

    $('form.ajax-update').on('submit', function(ev) {
        ev.preventDefault();
        submitForm($(this));
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });

    $('.download-receipt').on('click', function(ev) {
        ev.preventDefault();
        $.get($(this).attr('href'));
        flash({
            msg: '{{ 'Download in Progress' }}',
            type: 'info'
        });
    });

    function reloadDiv(div) {
        var url = window.location.href;
        url = url + ' ' + div;
        $(div).load(url);
    }

    function submitForm(form, formType) {
        var btn = form.find('button[type=submit]');
        disableBtn(btn);


        var ajaxOptions = {
            url: form.attr('action'),
            type: 'POST',
            cache: false,
            processData: false,
            dataType: 'json',
            contentType: false,
            data: new FormData(form[0])
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp) {
            resp.ok && resp.msg ?
                flash({
                    msg: resp.msg,
                    type: 'success'
                }) :
                flash({
                    msg: resp.msg,
                    type: 'danger'
                });
            hideAjaxAlert();
            enableBtn(btn);
            formType == 'store' ? clearForm(form) : '';
            scrollTo('body');
            return resp;
        });
        req.fail(function(e) {  
            
            console.error(e);
            if (e.status == 422) {
                var errors = e.responseJSON.errors;
                displayAjaxErr(errors);
            }
            if (e.status == 500) {
                displayAjaxErr([e.status + ' ' + e.statusText +
                    'Please Check for Duplicate entry or Contact School Administrator/IT Personnel'
                ])
            }
            if (e.status == 404) {
                displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])
            }
            enableBtn(btn);
            return e.status;
        });
    }

    function disableBtn(btn) {
        var btnText = btn.data('text') ? btn.data('text') : 'Submitting';
        btn.prop('disabled', true).html('<i class="icon-spinner mr-2 spinner"></i>' + btnText);
    }

    function enableBtn(btn) {
        var btnText = btn.data('text') ? btn.data('text') : 'Submit Form';
        btn.prop('disabled', false).html(btnText + '<i class="icon-paperplane ml-2"></i>');
    }

    function displayAjaxErr(errors) {
        $('#ajax-alert').show().html(
            ' <div class="alert alert-danger border-0 alert-dismissible" id="ajax-msg"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>'
        );
        $.each(errors, function(k, v) {
            $('#ajax-msg').append('<span><i class="icon-arrow-right5"></i> ' + v + '</span><br/>');
        });
        scrollTo('body');
    }

    function scrollTo(el) {
        $('html, body').animate({
            scrollTop: $(el).offset().top
        }, 2000);
    }

    function hideAjaxAlert() {
        $('#ajax-alert').hide();
    }

    function clearForm(form) {
        form.find('.select, .select-search').val([]).select2({
            placeholder: 'Select...'
        });
        form[0].reset();
    }


    $(document).ready(function() {
        $('#province').change(function() {
            let province = $(this).val();
            fetchLocations('/locations/districts', {
                province
            }, '#district');
        });

        $('#district').change(function() {
            let province = $('#province').val();
            let district = $(this).val();
            fetchLocations('/locations/sectors', {
                province,
                district
            }, '#sector');
        });

        $('#sector').change(function() {
            let province = $('#province').val();
            let district = $('#district').val();
            let sector = $(this).val();
            fetchLocations('/locations/cells', {
                province,
                district,
                sector
            }, '#cell');
        });

        $('#cell').change(function() {
            let province = $('#province').val();
            let district = $('#district').val();
            let sector = $('#sector').val();
            let cell = $(this).val();
            fetchLocations('/locations/villages', {
                province,
                district,
                sector,
                cell
            }, '#village');
        });

        function fetchLocations(url, params, target) {
            $.get(url, params, function(response) {
                console.log("Response received:", response);

                if (response.status === "success") {
                    let options = '<option value="">Select</option>';
                    response.data.data.forEach(item => { // Adjusted for nested data
                        options += `<option value="${item}">${item}</option>`;
                    });
                    $(target).html(options).prop('disabled', false);
                    console.log(`${target} dropdown enabled`);
                } else {
                    alert('Failed to load districts');
                }
            }).fail(function() {
                alert('Error fetching data');
            });

        }

    });



    function togglePocketMoneyAmount() {
        var pocketMoneySelect = document.getElementById('pocket_money_to_go_home');
        var pocketMoneyAmountField = document.getElementById('pocket_money_amount_field');

        // If "Yes" is selected, show the amount field, otherwise hide it
        if (pocketMoneySelect.value === 'yes') {
            pocketMoneyAmountField.style.display = 'block';
        } else {
            pocketMoneyAmountField.style.display = 'none';
        }
    }

    // Run the function on page load to check the current selection
    window.onload = function() {
        togglePocketMoneyAmount();
    }

    $('#studentForm').on('show.bs.collapse', function () {
        $('.fa-chevron-down').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    }).on('hide.bs.collapse', function () {
        $('.fa-chevron-up').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    });

</script>
