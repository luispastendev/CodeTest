<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
<?php echo lang('Validation.titleReserv') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!---Nav Bar --->
<nav>
    <div class="d-flex justify-content-evenly" id="div-nav">
        <div class="mr=0 container-fluid navbar " id="text-con">
            <span class="navbar-text">
                <?php echo lang('Validation.titleReserv') ?>
            </span>
        </div>

        <div class="container-fluid navbar navbar-light" id="text-nav">
            <span class="navbar-text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.
            </span>
        </div>

        <div class="container-fluid" id="btn-nav">
            <ul>
                <li><a href="<?php echo base_url('/' . $locale . '/reservation-list'); ?>"><?php echo lang('Validation.btn_reservList') ?></a>
                </li>
            </ul>
        </div>
</nav>
<!--Form--->
<section id="main-section">
    <div id="container-form">
        <form methood="POST" renctype='multipart/form-data' id="reservationForm">
            <div class="row g-1 form-group">
                <div class="col-sm">
                    <input type="text" class="form-control icon name " placeholder=" <?php echo lang('Validation.fullnamePlaceholder') ?>" aria-label="Name" name="name">
                    <span id="error_name" class="text-danger ms-2"></span>
                </div>
                <div class="col-sm">
                    <select data-bind='style: { width: 180, height: 37, fontSize: 14},optionsCaption: "<?php echo lang('Validation.rtypeParr') ?>", options: availableCtype' class="rtype" id="rtype"></select>
                    <script type="text/javascript">
                        var viewModel = {
                            availableCtype: ko.observableArray(['Reservation Type 1', 'Reservation Type 2',
                                'Reservation Type 3'
                            ])
                        };
                        ko.applyBindings(viewModel);
                        viewModel.availableCtype.push('Reservation Type 4');
                    </script>

                    <span id="error_rtype" class="text-danger ms-2"></span>
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control icon phone" placeholder=" <?php echo lang('Validation.phonePlaceholder') ?>" aria-label="Phone" name="phone" id="phone">
                    <span id="error_phone" class="text-danger ms-2"></span>
                </div>

                <div class="col-sm ">
                    <input type="text" class="form-control icon rdate" id="datepicker" placeholder=" <?php echo lang('Validation.rdatePlaceholder') ?>" aria-label="rdate" name="rdate">
                    <span id="error_rdate" class="text-danger ms-2"></span>
                </div>
            </div>
    </div>
    <div id="container-form" class="form-group">
        <h6><?php echo lang('Validation.descriptionCol') ?></h6>
        <div class="form-floating " id="editor">
            <input type="text" class="form-control icon description" id="description" aria-label="description" name="description">
        </div>
        <span id="error_description" class="text-danger ms-2"></span>
        <br />
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-danger ajax-send"><?php echo lang('Validation.btn_send') ?></button>
        </div>
        </form>
    </div>

</section>
<?= $this->section('language') ?>
<div class="btn-group dropend">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src='/TestCode/public/img/translate.svg'></button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <li><a href="<?php echo base_url('/en/contact-us'); ?>">English</a></li>
        <li><a href="<?php echo base_url('/es/contact-us'); ?>">Español</a></li>
        <li><a href="<?php echo base_url('/fr-FR/contact-us'); ?>">Français</a></li>
    </ul>
</div>
<?= $this->endSection() ?>
<?= $this->endSection() ?>
<?= $this->section('js') ?>

<script>
    $(document).ready(function() {
        $(document).on('click', '.ajax-send', function() {
            if ($.trim($('.name').val()).length == 0) {
                error_name = '<?php echo lang('Validation.spanName') ?>';
                $('#error_name').text(error_name);
            } else {
                error_name = '';
                $('#error_name').text(error_name);
            }

            if ($.trim($('.rtype').val()).length == 0) {
                error_rtype = '<?php echo lang('Validation.spanOp') ?>';
                $('#error_rtype').text(error_rtype);
            } else {
                error_rtype = '';
                $('#error_rtype').text(error_rtype);
            }

            if ($.trim($('.phone').val()).length == 0 || isNaN($('.phone').val())) {
                error_phone = '<?php echo lang('Validation.spanPhone') ?>';
                $('#error_phone').text(error_phone);
            } else {
                error_phone = '';
                $('#error_phone').text(error_phone);
            }
            if ($.trim($('.rdate').val()).length == 0) {
                error_rdate = '<?php echo lang('Validation.spanRdate') ?>';
                $('#error_rdate').text(error_rdate);
            } else {
                error_rdate = '';
                $('#error_rdate').text(error_rdate);
            }

            if (quill.getLength() == 1) {
                error_description = '<?php echo lang('Validation.spanQuery') ?>';
                $('#error_description').text(error_description);
            } else {
                error_description = '';
                $('#error_description').text(error_description);
            }

            if (error_name != '' || error_rtype != '' || error_phone != '' || error_rdate != '' ||
                error_description != '') {
                return false;
            } else {
                var data = {
                    'name': $('.name').val(),
                    'phone': $('.phone').val(),
                    'rtype': $('.rtype').val(),
                    'rdate': $('.rdate').val(),
                    'description': quill.getText()
                };
                $.ajax({
                    method: "POST",
                    url: "/TestCode/new",
                    data: data,
                    success: function(response) {
                        $('#reservationForm').find('input').val(''),
                            alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.status);
                        document.getElementById("reservationForm").reset();
                        quill.setText('');
                    }
                });
            }
        });
    });
</script>
<!----Quill JS-->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Quill editor -->
<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
</script>

<script>
    $(function() {
        $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            minDate: '0',
            inline: true
        });
    });
</script>
<script type="text/javascript" src="/TestCode/public/js/reservation.js"></script>
<?= $this->endSection() ?>