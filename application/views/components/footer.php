       </div>
       <script>
            function validate(event){
                var input = event.target;
                input.value = input.value.replace(/[^a-zA-Z ]+/g, '').replace(/\s{2,}/g, ' ');
            }
            function validateSpecial(event){
                var input = event.target;
                input.value = input.value.replace(/[^a-zA-Z , .]/g, '');
            }
            function validateNmbr(event){
                var input = event.target;
                input.value = input.value.replace(/[^0-9]/g, '');
            }
            function validateWithPoint(event){
                var input = event.target;
                input.value = input.value.replace(/[^0-9.]/g, '');
            }
            function validateMix(event){
                var input = event.target;
                input.value = input.value.replace(/[^0-9 . a-zA-Z]/g, '');
            }
            function validateDecimal(event){
                var input = event.target;
                input.value = input.value.replace(/[^0-9.]|(\..*\.)/g, (_, match) => match ? '' : '.');
            }
            function validateX(event){
                var input = event.target;
                input.value = input.value.replace(/[^0-9 X]/g, '');
            }
            function validateDate(event){
                var input = event.target;
                input.value = input.value.replace(/[^0-9-]/g, '');
            }
            function validateProject(event){
                var input = event.target;
                input.value = input.value.replace(/[^a-zA-Z (,.) ]+/g, '').replace(/\s{2,}/g, ' ');
            }
            function validateEmail(event){
                var input = event.target;
                input.value = input.value.replace(/[^a-z0-9@.]/g, '');
                let atCount = (input.value.match(/@/g) || []).length;
                let dotCount = (input.value.match(/\./g) || []).length;
                if(atCount > 1){ input.value = input.value.replace(/@/, ''); }
                if(dotCount > 1){ input.value = input.value.replace(/\./, ''); }
            }
            
            $('#paymentMode').change(function(){
                var mode = $(this).val();
                if(mode == 'Cash'){
                    $('#refBank').slideUp();
                }else{
                    $('#refBank').slideDown();
                }
            });
        </script>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="editCanvas" aria-labelledby="">
            <div class="offcanvas-header" style="border-bottom:1px solid #EBEBEB;">
                <div class="row">
                    <div class="col-12">
                        <h5 class="offcanvas-title" id="canvasTitle"></h5>
                        <p id="notShow">Last Update: <span id="lastUpdate" class="text-danger"></span></p>
                    </div>
                </div>
            </div>
            <div class="offcanvas-body" id="canvasBody"></div>
        </div>
        <div class="modal fade" id="addNewBank" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Bank Details</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <div class="input-groupicon">
                                        <input id="bankName" id="bankName" type="text" placeholder="Enter Bank Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Branch Code</label>
                                    <div class="input-groupicon">
                                        <input id="branchCode" name="branchCode" type="text" placeholder="Enter Branch Code">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <label>Branch Location</label>
                                    <div class="input-groupicon">
                                        <input id="branchAddress" id="branchAddress" type="text" placeholder="Enter Branch Location">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <a class="btn form-control btn-submit me-2 addBank">Add New Bank</a>
                            </div>
                            <div class="col-12 mt-2">
                                <strong>Instruction: </strong>Please fill in the following details accurately.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('.addBank').on('click', function(){
                var bankName = $('#bankName').val();
                var branchCode = $('#branchCode').val();
                var branchAddress = $('#branchAddress').val();
                if(bankName!=="" && branchCode!=="" && branchAddress!==""){
                    swal({
                        title: "Are you sure?",
                        text: "You want to add the bank!",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Yes, add it!",
                        cancelButtonClass: "btn-primary",
                        cancelButtonText: "No, cancel!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if(isConfirm){
                            $.ajax({
                                url: "<?php echo base_url("dashboard/addBank"); ?>",
                                type: "POST",
                                data: {
                                    bankName: bankName,
                                    branchCode: branchCode,
                                    branchAddr: branchAddress
                                },
                                cache: false,
                                success: function(dataResult){
                                    if(dataResult==true){
                                        swal({
                                            title: "Congratulation!", 
                                            text: "Bank has been added successfully.", 
                                            type: "success"
                                            },function(){
                                                $('#addNewBank').modal('hide');
                                                getBanks();
                                            }
                                        );
                                    }else{
                                        swal("Ops!", "Something went wrong.", "error");
                                    }
                                }
                            });
                        }else{
                            swal.close();
                        }
                    });
                }else{
                    swal("Sorry!", "Please fill all the field.", "info");
                }
            });
            function getBanks() {
                $.ajax({
                    url: "<?php echo base_url('dashboard/fetchBank'); ?>",
                    method: 'POST',
                    dataType: 'JSON',
                    success: function(res) {
                        $('#bank_name').empty();
                        $.each(res, function(index, data) {
                            $('#bank_name').append('<option value="' + data.bankId + '">' + data.bankName + '</option>');
                        });
                    }
                });
            }
            
        window.setInterval('conn()', 5000);
        status="ON";
        function conn(){
            if(!navigator.onLine){ 
                var status="OFF"; 
            }
            if(status!="OFF"){ 
                // swal.close(); 
            }else{
              swal("Connection Error", "Please stop working. You have lost your internet connection.", "error");
            }
        }
        </script>
        <script src="<?= base_url('assets/js/feather.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/jquery.slimscroll.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

        <script src="<?= base_url('assets/plugins/select2/js/select2.min.js'); ?>"></script>
        <script src="<?= base_url('assets/plugins/owlcarousel/owl.carousel.min.js'); ?>"></script>
        

        <script src="<?= base_url('assets/plugins/apexchart/apexcharts.min.js'); ?>"></script>
        <script src="<?= base_url('assets/plugins/apexchart/chart-data.js'); ?>"></script>
        <script src="<?= base_url('assets/js/script.js'); ?>"></script>
        
        <script src="<?= base_url('assets/js/moment.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-datetimepicker.min.js'); ?>"></script>
    </body>
</html>