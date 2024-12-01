<div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">
                    <li class="fa fa-user"></li> Add Record
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span class="">Note: Fields with (<span class="text-danger">*</span>) are required.</span>
                <div id="stepper" class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#test-l-1">
                            <button type="button" class="step-trigger" role="tab" aria-controls="test-l-1" id="stepperTrigger1">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Fullname</span>
                            </button>
                        </div>
                        <div class="step" data-target="#test-l-2">
                            <button type="button" class="step-trigger" role="tab" aria-controls="test-l-2" id="stepperTrigger2">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Personal Info</span>
                            </button>
                        </div>
                        <div class="step" data-target="#test-l-3">
                            <button type="button" class="step-trigger" role="tab" aria-controls="test-l-3" id="stepperTrigger3">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Address</span>
                            </button>
                        </div>
                        <div class="step" data-target="#test-l-4">
                            <button type="button" class="step-trigger" role="tab" aria-controls="test-l-4" id="stepperTrigger4">
                                <span class="bs-stepper-circle">4</span>
                                <span class="bs-stepper-label">Contact Info</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content pb-0 ">
                        <div id="test-l-1" class="content" role="tabpanel" aria-labelledby="stepperTrigger1">
                            <form id="form1" class="form-horizontal" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12 col-sm-7">
                                        <div class="form-group row">
                                            <label for="name" class="col-form-label col-12 col-sm-4">Given Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control col-12 col-sm-8" name="fname" id="fname" placeholder="Pangalan">
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-form-label col-12 col-sm-4">Middle Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control col-12 col-sm-8" name="mname" id="mname" placeholder="Gitnang Pangalan">
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-form-label col-12 col-sm-4">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control col-12 col-sm-8" name="lname" id="lname" placeholder="Apelyido">
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-form-label col-12 col-sm-4">Suffix</label>
                                            <input type="text" class="form-control col-12 col-sm-8" name="suffix" id="suffix" placeholder="ex: (Jr./Sr./I/II/III)">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-5">
                                        <div class="text-center image-upload">
                                            <label for="file">
                                                <img class="img-content" src="../images/upload_image.png"
                                                    style="cursor:pointer; width: 200px; height: auto;" />
                                            </label>
                                            <input id="file" type="file" accept=".png, .jpg" onchange="readURL(this);" name="file" hidden />
                                            <!-- <span class="text-muted">Upload image (512x512)</span> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between pl-0 pr-0 pb-0">
                                    <button class="btn btn-primary" type="button" onclick="nextStep(1)">NEXT</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                                </div>
                            </form>
                        </div>
                        <div id="test-l-2" class="content" role="tabpanel" aria-labelledby="stepperTrigger2">
                            <form id="form2">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Birth Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="bdate" id="bdate" placeholder="Pangalan">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Age <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="age" id="age" placeholder="Edad">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Place of Birth <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="placeofbirth" id="placeofbirth" placeholder="Lugar ng Kapanganakan">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Gender <span class="text-danger">*</span></label>
                                            <select class="custom-select" name="gender" id="gender">
                                                <option value="" selected hidden disabled>Pumili ng kasarian</option>
                                                <option value="LALAKE">LALAKE</option>
                                                <option value="BABAE">BABAE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Civil Status <span class="text-danger">*</span></label>
                                            <select class="custom-select" name="civilstatus" id="civilstatus">
                                                <option value="" selected hidden disabled>Pumili ng status</option>
                                                <option value="BALO">BALO (WIDOWED)</option>
                                                <option value="KASAL">KASAL (MARRIED)</option>
                                                <option value="LEGALLY SEPARATED">LEGALLY SEPARATED (LEGAL NA HIWALAY)</option>
                                                <option value="MAY KINAKASAMA">MAY KINAKASAMA (LIVE-IN)</option>
                                                <option value="SINGE">SINGLE (WALANG ASAWA)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Citizenship<span class="text-danger">*</span></label>
                                            <select class="custom-select" name="citizenship" id="citizenship">
                                                <option value="" selected hidden disabled>Pumili ng Citizenship</option>
                                                <option value="FILIPINO">FILIPINO</option>
                                                <option value="IBANG LAHI">IBANG LAHI</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Voter's Status<span class="text-danger">*</span></label>
                                            <select class="custom-select" name="voters_status" id="voters_status">
                                                <option value="" selected hidden disabled>Pumili ng Status</option>
                                                <option value="ACTIVE">ACTIVE</option>
                                                <option value="IN-ACTIVE">IN-ACTIVE</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Occupation <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Trabaho">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between pl-0 pr-0 pb-0">
                                    <div>
                                        <button class="btn btn-secondary" type="button" onclick="prevStep(2)">PREVIOUS</button>
                                        <button class="btn btn-primary" type="button" onclick="nextStep(2)">NEXT</button>
                                    </div>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                                </div>
                            </form>
                        </div>
                        <div id="test-l-3" class="content" role="tabpanel" aria-labelledby="stepperTrigger3">
                            <form id="form3" class="form-horizontal">
                                <div class="form-group row">
                                    <label for="region" class="col-form-label col-12 col-sm-3">Region <span class="text-danger">*</span></label>
                                    <select class="custom-select col-12 col-sm-9" name="region" id="region">
                                        <option value="" selected hidden disabled>Pumili ng Region</option>
                                        <option value="REG1">REG1</option>
                                        <option value="REG2">REG2</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="province" class="col-form-label col-12 col-sm-3">Province <span class="text-danger">*</span></label>
                                    <select class="custom-select col-12 col-sm-9" name="province" id="province">
                                        <option value="" selected hidden disabled>Pumili ng Province</option>
                                        <option value="PROV1">Prov1</option>
                                        <option value="PROV2">PROV2</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="city" class="col-form-label col-12 col-sm-3">City <span class="text-danger">*</span></label>
                                    <select class="custom-select col-12 col-sm-9" name="city" id="city">
                                        <option value="" selected hidden disabled>Pumili ng City</option>
                                        <option value="CITY1">CITY1</option>
                                        <option value="CITY2">CITY2</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="barangay" class="col-form-label col-12 col-sm-3">Barangay <span class="text-danger">*</span></label>
                                    <select class="custom-select col-12 col-sm-9" name="barangay" id="barangay">
                                        <option value="" selected hidden disabled>Pumili ng Barangay</option>
                                        <option value="BRGY1">BRGY1</option>
                                        <option value="BRGY2">BRGY2</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="street" class="col-form-label col-12 col-sm-3">House No. / Street <span class="text-danger">*</span></label>
                                    <textarea class="form-control col-12 col-sm-9" name="street" id="street" rows="2" placeholder="Numero ng bahay o street"></textarea>
                                </div>
                                <div class="modal-footer justify-content-between pl-0 pr-0 pb-0">
                                    <div>
                                        <button class="btn btn-secondary" type="button" onclick="prevStep(3)">PREVIOUS</button>
                                        <button class="btn btn-primary" type="button" onclick="nextStep(3)">NEXT</button>
                                    </div>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                                </div>
                            </form>
                        </div>
                        <div id="test-l-4" class="content" role="tabpanel" aria-labelledby="stepperTrigger4">
                            <form id="form4" class="form-horizontal">
                                <div class="form-group row">
                                    <label for="phone_no" class="col-form-label col-sm-3 col-12">Contact Number <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control col-sm-9 col-12" name="phone_no" id="phone_no" placeholder="Contact Number">
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-form-label col-sm-3 col-12">Email Address</label>
                                    <input type="email" class="form-control col-sm-9 col-12" name="email" id="email" placeholder="Email Address">
                                </div>
                                <div class="modal-footer justify-content-between pl-0 pr-0 pb-0">
                                    <div>
                                        <button class="btn btn-secondary" type="button" onclick="prevStep(4)">PREVIOUS</button>
                                        <button class="btn btn-success" type="submit" onclick="submitForm(event)">SUBMIT</button>
                                    </div>
                                    <input type="hidden" name="action" id="action">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>