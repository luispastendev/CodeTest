<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
<?php echo lang('Validation.titleContact') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!---Nav Bar --->
<nav>
    <div class="d-flex justify-content-evenly" id="div-nav">
        <div class="mr=0 container-fluid navbar " id="text-con">
            <span class="navbar-text">
                <?php echo lang('Validation.titleContact') ?>
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
                <li><a href="<?php echo base_url('/' . $locale . '/contact-list'); ?>"><?php echo lang('Validation.btn_contactList') ?></a>
                </li>
            </ul>
        </div>
</nav>
<!--Form--->
<section id="main-section">
    <div id="container-form">
        <h5><?php echo lang('Validation.tittle') ?></h5>
        <h6><?php echo lang('Validation.subTittle') ?></h6>
        <form methood="POST" renctype='multipart/form-data' id="contactform">
            <div class="row g-1 form-group">
                <div class="col-sm">
                    <input type="text" class="form-control icon name " placeholder=" <?php echo lang('Validation.namePlaceholder') ?>" aria-label="Name" name="name">
                    <span id="error_name" class="text-danger ms-2"></span>
                </div>
                <div class="col-sm">
                    <select data-bind='style: { width: 180, height: 37, fontSize: 14},optionsCaption: "<?php echo lang('Validation.ctypeParr') ?>", options: availableCtype' class="ctype" id="ctype"></select>
                    <script type="text/javascript">
                        var viewModel = {
                            availableCtype: ko.observableArray(['Contact Type 1', 'Contact Type 2',
                                'Contact Type 3'
                            ])
                        };
                        ko.applyBindings(viewModel);
                        viewModel.availableCtype.push('Contact Type 4');
                    </script>

                    <span id="error_ctype" class="text-danger ms-2"></span>
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control icon phone" placeholder=" <?php echo lang('Validation.phonePlaceholder') ?>" aria-label="Phone" name="phone" id="phone">
                    <span id="error_phone" class="text-danger ms-2"></span>
                </div>

                <div class="col-sm ">
                    <input type="text" class="form-control icon bday" id="datepicker" placeholder=" <?php echo lang('Validation.bdayPlaceholder') ?>" aria-label="bday" name="bday" max="2002-01-31">

                    <span id="error_bday" class="text-danger ms-2"></span>
                </div>
                <button type="button" class="btn btn-danger ajax-send"><?php echo lang('Validation.btn_send') ?></button>
            </div>
    </div>
    <br />

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

            if ($.trim($('.ctype').val()).length == 0) {
                error_ctype = '<?php echo lang('Validation.spanOp') ?>';
                $('#error_ctype').text(error_ctype);
            } else {
                error_ctype = '';
                $('#error_ctype').text(error_ctype);
            }

            if ($.trim($('.phone').val()).length == 0 || isNaN($('.phone').val())) {
                error_phone = '<?php echo lang('Validation.spanPhone') ?>';
                $('#error_phone').text(error_phone);
            } else {
                error_phone = '';
                $('#error_phone').text(error_phone);
            }
            if ($.trim($('.bday').val()).length == 0) {
                error_bday = '<?php echo lang('Validation.spanBday') ?>';
                $('#error_bday').text(error_bday);
            } else {
                error_bday = '';
                $('#error_bday').text(error_bday);
            }


            if (error_name != '' || error_ctype != '' || error_phone != '' || error_bday != '') {
                return false;
            } else {
                var data = {
                    'name': $('.name').val(),
                    'phone': $('.phone').val(),
                    'ctype': $('.ctype').val(),
                    'bday': $('.bday').val(),
                };
                $.ajax({
                    method: "POST",
                    url: "/TestCode/add",
                    data: data,
                    success: function(response) {
                        $('#contactform').find('input').val(''),
                            alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.status);
                        document.getElementById("contactform").reset();
                        quill.setText('');
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript" src="/TestCode/public/js/main.js"></script>
<!----Quill JS-->

<script>
    $(function() {
        $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            minDate: '-80Y',
            maxDate: new Date(2002, 01 - 1, 25),
            inline: true
        });
    });
</script>

<?= $this->endSection() ?>