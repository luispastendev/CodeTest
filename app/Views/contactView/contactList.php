<?= $this->extend('layout/main') ?>
<?= $this->section('cs') ?>
<!---DataTable CSS --->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<?= $this->endSection() ?>
<!---Title --->
<?= $this->section('title') ?>
<?php echo lang('Validation.btn_contactList') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!---Nav Bar --->
<nav>
    <div class="d-flex justify-content-evenly" id="div-nav">
        <div class="mr=0 container-fluid navbar " id="text-con">
            <span class="navbar-text">
                <?php echo lang('Validation.btn_contactList') ?>
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
                <li><a href="<?php echo base_url('/' . $locale . '/contact-us'); ?>"><?php echo lang('Validation.btn_AddContact') ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!---EDIT Modal --->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true" aria-labelledby="modalFormTitle">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo lang('Validation.modalTitleEdit') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="contact_id">
                <div class="form-group">
                    <label><?php echo lang('Validation.modalTitleEdit') ?></label> <span id="error_name" class="text-danger ms-2"></span>
                    <input type="text" id="name" class="form-control icon name" placeholder="Contact Name ..." aria-label="Name" name="name">
                </div>

                <div class="form-group">
                    <label><?php echo lang('Validation.phonePlaceholder') ?></label> <span id="error_phone" class="text-danger ms-2"></span>
                    <input type="text" class="form-control icon phone" placeholder=" Phone" aria-label="Phone" name="phone" id="phone">
                </div>
                <div class="form-group">
                    <p>Contact Type:<select data-bind='style: { width: 180, height: 37, fontSize: 14},optionsCaption: "<?php echo lang('Validation.ctypeParr') ?>", options: availableCtype' class="ctype" id="ctype"></select></p>
                    <script type="text/javascript">
                        var viewModel = {
                            availableCtype: ko.observableArray(['Contact Type 1', 'Contact Type 2', 'Contact Type 3'])
                        };
                        ko.applyBindings(viewModel);
                        viewModel.availableCtype.push('Contact Type 4');
                    </script>

                    <span id="error_ctype" class="text-danger ms-2"></span>
                </div>
                <div class="form-group">
                    <label> <?php echo lang('Validation.bdayPlaceholder') ?></label> <span id="error_bday" class="text-danger ms-2"></span>
                    <input type="text" class="form-control icon bday" id="datepicker" placeholder=" Birth Day" aria-label="bday" name="bday" max="2002-01-31">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <?php echo lang('Validation.btn_close') ?></button>
                <button type="button" class="btn btn-primary" id="btn_update">
                    <?php echo lang('Validation.btn_update') ?></button>
            </div>
        </div>
    </div>
</div>

<!---DELETE Modal --->
<div class="modal fade" id="modalFormDelete" tabindex="-1" aria-hidden="true" aria-labelledby="modalFormTitle">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo lang('Validation.modalTitleDelete') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="delete_contact_id">
                <h4><?php echo lang('Validation.modalBody') ?></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo lang('Validation.btn_close') ?></button>
                <button type="button" class="btn btn-danger" id="delete_btnModal"><?php echo lang('Validation.btn_yes') ?></button>
            </div>
        </div>
    </div>
</div>

<!---Table --->

<section id="main-section">
    <div id="container-table">
        <table class="display table  responsive nowrap table-striped table-bordered" id="table" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col"><?php echo lang('Validation.namePlaceholder') ?></th>
                    <th scope="col"><?php echo lang('Validation.ctypeCol') ?></th>
                    <th scope="col"><?php echo lang('Validation.phonePlaceholder') ?></th>
                    <th scope="col"><?php echo lang('Validation.bdayPlaceholder') ?></th>
                    <th scope="col"><?php echo lang('Validation.colAction') ?></th>
                </tr>
            </thead>
        </table>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "/TestCode/public/php/server_processing.php",
                "columnDefs": [{
                    'responsivePriority': 1,
                    'targets': 0,

                    'responsivePriority': 10001,
                    'targets': 4,

                    'responsivePriority': 2,
                    'targets': -2,
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<button type='button 'class='btn btn-info' id='btn_edit'><img src='/TestCode/public/img/pencil-square.svg'></button><button type='button' class='btn btn-danger' id='btn_delete'><img src='/TestCode/public/img/trash-fill.svg'></button>"
                }]
            });
        });
    </script>
</section>

<?= $this->endSection() ?>
<?= $this->section('language') ?>
<div class="btn-group dropend">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src='/TestCode/public/img/translate.svg'></button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <li><a href="<?php echo base_url('/en/contact-list'); ?>">English</a></li>
        <li><a href="<?php echo base_url('/es/contact-list'); ?>">Español</a></li>
        <li><a href="<?php echo base_url('/fr-FR/contact-list'); ?>">Français</a></li>
    </ul>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script type="text/javascript" src="/TestCode/public/js/main.js"></script>

<?= $this->endSection() ?>